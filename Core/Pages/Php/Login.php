<?php

	include "../../Class/TemplatePage.php";
	include "../../Class/Utilities.php";
    include "../../Class/NodoArbolDHTML.php";

	if ( isset ( $_SESSION['role'] ))
		session_destroy();

	session_start();

	$objTemplate = new TemplatePage();
	$objUtilities = new Utilities();

	$objTemplate->TemplatePage();
	$objUtilities->Utilities();


	$objTemplate->header('Login de Usuario');

	$objTemplate->body();


	$objTemplate->banner();

	$json = new NodoArbolDHTML("Ingreso a Nabu", "Ingreso a Nabu","object");

	$campo1=$json->addField("string","","true","^[a-zA-Z0-9_]+$");
	$campo2=$json->addField("string","password","true","^[a-zA-Z0-9_]+$");

	$json->addProperties("Campo1",$campo1);
	$json->addProperties("Campo2",$campo2);
	$style='forms';

	echo "<div align='center'>";
		$objUtilities->forms($style,$json);
	echo "</div>";


	//Esto es una prueba
	//La idea que tengo es q con el nombre de la pagina sea el identificador para la generacion de campos

	echo $archivo_actual = basename($_SERVER['PHP_SELF']);;


	$objTemplate->tail();

?>