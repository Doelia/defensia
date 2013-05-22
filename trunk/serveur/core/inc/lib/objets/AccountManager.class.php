<?php


class AccountManager
{
	protected static $qSelect = "SELECT *, NOW() < dateEndVip as vip FROM s_data_accounts";

	/**
	 * Pré resuis : Le compte existe (voir méthoe exists())
	 * 
	 * 
	 */
	protected static function get_fetch($idOrName)
	{
		Sql::connect();

		if (is_numeric($idOrName))
			return Sql::query(self::$qSelect." WHERE ID='$idOrName'")->fetch();
		else
			return Sql::query(self::$qSelect." WHERE name='$idOrName'")->fetch();
	}

	public static function get($idOrName)
	{
		return new Account(self::get_fetch($idOrName));
	}

	/**
	 * 	Retourne un objet Account si le login est correct, false sinon
	 * 
	 */
	public static function getLogin($login, $pass)
	{
		Sql::connect();

		$q = Sql::query(self::$qSelect." WHERE name='$login' AND pass='".self::cryptMdp($pass)."'");

		if (!$q->rowCount())
			return null;

		return new Account($q->fetch());
	}


	/**
	 * 
	 * Retourne true si le compte existe, false sinon
	 * Toujours utiliser avant un get de profil
	 * 
	 */
	public static function exists($idOrName)
	{
		Sql::connect();
		$idOrName = sec($idOrName);
		
		if (is_numeric($idOrName)) // Avec ID
			return Sql::colomn(Sql::query(self::$qSelect." WHERE ID='$idOrName' LIMIT 1"));
			
		// Avec name
		return Sql::colomn(Sql::query(self::$qSelect." WHERE name='$idOrName' LIMIT 1"));
	}

	/**
	 * 
	 * reetourne true si le joueur est inscris, false sinon
	 * 
	 * 
	 */
	public static function estEnregistre($name)
	{
		Sql::connect();

		$q = Sql::query("SELECT isInscris FROM s_data_accounts WHERE name='$name' LIMIT 1");
		if (!$q->rowCount())
			return false;
		else
		{
			$l = $q->fetch();
			return $l[0];
		}
	}

	/**
	 * 
	 * Crée une ligne profil dans la table, sans l'inscrire
	 * 
	 */
	public static function createProfil($name)
	{
		Sql::connect();
		Sql::query("INSERT INTO s_data_accounts (lang, name, dateRecord, dateEndVip) VALUES ('".Langue::getLangue()."', '$name', NOW(), NOW())");
		Sql::query("INSERT INTO hg_data_profils (`hg_data_profils`.`id_account`) VALUES ((SELECT ID FROM s_data_accounts p ORDER BY ID DESC LIMIT 1))");
	}


	/**
	 * 
	 * 	Définit un mot de passe et un mail a un profil
	 * 	Pré requis : Le profil existe (voir createProfil())
	 * 
	 */
	public static function inscrire($name, $mdp, $mail)
	{
		Sql::query("UPDATE s_data_accounts SET pass='".self::cryptMdp($mdp)."',isInscris=1,mail='$mail' WHERE name='$name'");
	}


	public static function update($p)
	{
		if ($p->updateNecessaire())
		{
			Sql::query("UPDATE s_data_accounts SET
				lang='".$p->lang()."',
				pass='".$p->pass()."',
				pb='".$p->pb()."',
				isAdmin='".$p->isAdmin()."',
				option_ip='".$p->option_ip()."',
				recevoirMails=".$p->recevoirMails()."
				WHERE ID=".$p->ID()
			);
		}
	}

	public static function doVip(Account $p, $nbrJours=31)
	{
		Sql::query("UPDATE s_data_accounts SET
			dateEndVip=DATE_ADD(".($p->isVip()?"dateEndVip":"NOW()").", INTERVAL $nbrJours DAY)
			WHERE ID=".$p->ID()
		);
		Sql::query("INSERT INTO s_data_achatVIP (idProfil, date, ip, duree) VALUES ('".$p->ID()."', NOW(), '".$_SERVER['REMOTE_ADDR']."', '$nbrJours') ");
		self::update($p);
	}

	/**
	 * Donne des points à un joueur et ajoute dans l'historique
	 * 
	 */
	public static function buyPoints(Account $p)
	{
		Sql::query("INSERT INTO s_data_achatPoints (idProfil, date, ip, n) VALUES ('".$p->ID()."', NOW(), '".$_SERVER['REMOTE_ADDR']."', '60') ");
		$p->addPb(60);
		self::update($p);
	}

	public static function mdpValide($mdp)
	{
		return preg_match("#^[a-zA-Z0-9-]{3,16}$#", $mdp);
	}
	
	public static function mailValide($mail)
	{
		return preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail);
	}

	public static function cryptMdp($mdp)
	{
		return md5('ab'.$mdp.$mdp.$mdp);
	}

	public static function valideIp($ip)
	{
		// TODO
		return true;
	}

	/** IP **/
	public static function getListIpAccepted(Account $a)
	{
		return Sql::query("SELECT ip,date FROM s_data_accounts_ipaccepted WHERE idAccount='".$a->ID()."'");
	}

	public static function deleteIpAccepted(Account $a, $ip)
	{
		if (self::valideIp($ip))
			Sql::query("DELETE FROM s_data_accounts_ipaccepted WHERE idAccount='".$a->ID()."' AND ip='$ip'");
	}

	public static function addIpAccepted(Account $a, $ip)
	{
		if (self::valideIp($ip))
			Sql::query("INSERT INTO s_data_accounts_ipaccepted (idAccount, ip, date) VALUES ('".$a->ID()."','$ip', NOW()) ", false, true);
	}

	public static function testRegenMdp($key)
	{
		$key = sec($key);
		$q = Sql::query("SELECT idAccount FROM s_data_regenPwd WHERE keyy='$key' AND validated='0' AND dateEnd > NOW() ORDER BY dateEnd DESC LIMIT 1");
		if ($q->rowCount())
		{
			$l = $q->fetch();
			Sql::query("UPDATE s_data_regenPwd SET validated=1 WHERE keyy='$key'");
			return $l['idAccount'];
		}
		else
			return 0;
	}

	public static function sendMailRegenPwd($name, $email)
	{
		$q = Sql::query("SELECT ID FROM s_data_accounts WHERE name='$name' AND mail='$email' AND mail != '' AND isInscris=1 LIMIT 1");
		if ($q->rowCount())
		{
			$l = $q->fetch();

			$keymail = ChaineAleatoire(40);
			Sql::query("DELETE FROM s_data_regenPwd WHERE idAccount='".$l['ID']."'");
			Sql::query("INSERT INTO s_data_regenPwd (idAccount,keyy,validated,dateEnd) VALUES ('".$l['ID']."', '$keymail', 0, DATE_ADD(NOW(), INTERVAL 1 DAY))");

			$link = 'http://'.WEB.BASE."?regenpwd=$keymail";

			try {
				$mail = new PHPMailer(true); //New instance, with exceptions enabled

				$body             = "Vous avez demandé une génération de nouveau mot de passe.<br><br>Cliquez dés à présent sur ce lien pour continuer la procédure : $link<b><br>Ignorez ce mail si vous n'avez pas demandé cela.";
				$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

				$mail->IsSendmail();  // tell the class to use Sendmail
				$mail->AddReplyTo("support@survivia.net","SURVIVIA");
				$mail->From       = "support@survivia.net";
				$mail->FromName   = "SURVIVIA";

				$to = $email;

				$mail->AddAddress($to);
				$mail->Subject  = "SURVIVIA : Votre demande de nouveau mot de passe";
				$mail->MsgHTML($body);
				$mail->IsHTML(true); 

				$mail->Send();

				return true;

			} catch (phpmailerException $e) {
				echo $e->errorMessage();
			}
		}
		return false;
	}
}

