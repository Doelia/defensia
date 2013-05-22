<?php

function noCharSpeciaux($s)
{
	return preg_match("#^[a-zA-Z0-9]+$#", $s);
}

