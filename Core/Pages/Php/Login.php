<?php

	include "../../Class/TemplatePage.php";
	include "../../Class/Utilities.php";


	if ( isset ( $_SESSION['role'] ))
		session_destroy();

	session_start();
	$idPage = basename($_SERVER['PHP_SELF']);

	$objTemplate = new TemplatePage($idPage);
	$objUtilities = new Utilities();

	$objTemplate->TemplatePage($idPage);
	$objUtilities->Utilities();

	$title='Login de Usuario';
	$style='forms';
	$imprimirJsons=false;

	$objTemplate->header($title);
	$objTemplate->banner();
	$objTemplate->body();

	$schema=$objUtilities->getSchema($idPage);
	$options=$objUtilities->getOption($idPage);
	$data='';

	echo "<div align='center'>";
		$objUtilities->forms($style,$imprimirJsons,$schema,$options,$data);
	echo "</div>";


	$objTemplate->tail();


?>