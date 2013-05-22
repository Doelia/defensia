<?php

function listUnDir($dirname) {
	global $filesAInclure;
	global $i;
	$dir = opendir($dirname);
	while ($file = readdir($dir))
	{
		if ($file != '..' && $file != '.' && $file != 'index.php' && $file != 'chaineInc.php')
		{
			if (substr($file, -4) == '.php')
			{
				$filesAInclure[] = $dirname.'/'.$file;
			}
			elseif (is_dir($dirname.'/'.$file))
			{
				$newDirname = $dirname.'/'.$file;
				listUnDir($newDirname);
			}
		}
	}

	closedir($dir);
}

function getRep($base)
{
	$dirname = substr($base, 0, -10);
	return $dirname;
}


