<?php

	include "../../Class/TemplatePage.php";
	include "../../Class/Utilities.php";


	if ( isset ( $_SESSION['role'] ))
		session_destroy();

	session_start();

	$objTemplate = new TemplatePage();
	$objUtilities = new Utilities();

	$objTemplate->TemplatePage();
	$objUtilities->Utilities();


	$objTemplate->header('Login de Usuario');
	$idPage = basename($_SERVER['PHP_SELF']);

	$objTemplate->body();
	$objTemplate->banner();


	$style='forms';
	$schema=$objUtilities->getSchema($idPage);
	$options=$objUtilities->getOption($idPage);
	$data='';
    $imprimirJsons=true;

	echo "<div align='center'>";
		$objUtilities->forms($style,$imprimirJsons,$schema,$options,$data);
	echo "</div>";


	$objTemplate->tail();

?>