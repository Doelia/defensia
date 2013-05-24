<?php

/*

        @author 
                Doelia - www.doelia.fr
        @creation date
                20.04.2012

*/

class Sql
{
        public static $_nbrQuery = 0;
        public static $_nbrQuery_surExt = 0;
        public static $connexions = array();
        public static $active = null;
        
        /* Getters */
        
        public static function isConnect() {
                return $this->_connected;
        }
        
        /* Méthodes */

        public static function connect()
        {
                /*
                        Voir config.php pour la configuration de la connexion
                        
                        Passe en actif la connexion $connexions[$bd] si elle existe
                        Si elle n'existe pas, elle est ajoutée au tableau $connexions[''] avec comme clef '$bd'
                */

                if (self::$active == null)
                {
                        $server = SQL_SERVER;
                        $login  = SQL_LOGIN;
                        $mdp    = SQL_PASS;
                        $db             = SQL_DB;
                        $port   = SQL_PORT;
                        
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; // Exeption SQL en cas d'erreur
                        self::$active = new PDO("mysql:host=$server;dbname=$db;port=$port", $login, $mdp, $pdo_options);
                }
        
        }
        
        private static function getBaseConnecte()
        {
                /*
                        @retour
                                Le nom de la base ŕ laquelle on est connecté
                */
                
                foreach (self::$connexions as $k => $v)
                        if ($v == self::$active)
                                return $k;
        
        }
        
        private static function toLogs($s)
        {
                /*
                        @action
                                Enregistre dans le fichier /logs/<date du jour >-errors_sql.txt la ligne $s précédée de l'heure
                */
                
                $fichierErreur = './logs/'.date('Y-m-d').'-errors_sql.txt';
                $logs = fopen($fichierErreur, 'a+');
                fputs($logs, date('r')." [".$_SERVER["REMOTE_ADDR"]."] $s\n");
                fclose($logs);
        }
        
        public static function query($query, $echo=DISP_SQL, $force=false)
        {
                /*
                        @retour
                                Le résultat de la $query si connecté,
                                NULL sinon
                                
                        @param
                                string $query   La requette SQL ŕ executer
                                bool $echo      Si true, affiche la requette
                                bool $force     Si true, force le passage de la query pour se servir du résultat (si erreur ou non)
                                
                        @action
                                Erreur fatale lancée en cas d'echec (affiche de l'erreur + query tentée)
                        
                */
                
                if (self::$active != null)
                {
                        try
                        {
                                $r = self::$active->query($query);
                                self::$_nbrQuery++;
                                
                                if (self::getBaseConnecte() == 'other')
                                {
                                        self::$_nbrQuery_surExt++;
                                        //sleep(1);
                                }
                                
                                if ($echo) echo '<div class="sql">'.$query.'</div>';
                                
                                return $r;
                        }
                        catch (Exception $e)
                        {
                                if (!$force)
                                {
                                        $erreur = $e->getMessage();
                                
                                        if (DISP_ERRORS || $echo)
                                                echo "<br />$erreur<br />Requete: $query";
                                        else
                                                echo "<br />Erreur SQL";
                                        
                                        self::toLogs("$erreur\n@$query");
                                        
                                        exit();
                                }
                                else return NULL;
                        }
                }
                else
                        throw new Exception("Tentative de query sans ętre connecté ($query)<br />");
                        return NULL;
        }
        
        public static function colomn($q, $force=false)
        {
                /*
                        @retour
                                Le premier attribut de la premičre ligne de la query donnée
                        @param
                                $force   Si on veut forcer le passage du fetch pour se servir d'un non résultat
                */
                
                if (!isset($q) || !$q)
                {
                        $msg = "mysql fetch row échoué";
                        if (DISP_ERRORS)
                                echo $msg;
                        self::toLogs($msg);
                        if (!$force)
                                exit();
                        else
                                return NULL;
                }
                else
                {
                        $r = $q->fetch();
                        return $r[0];
                }
        }
        
        private static function close()
        {
                /*
                        @action
                                Ferme la connexion active
                */
        }

}