<?php
	include("../../Framework/adodb/adodb5/adodb.inc.php");

	class Conexion
	{
		var $db;
		var $host;
		var $user;
		var $password;
		var $database;

		function Conexion()
		{
			$this->host="localhost";
			$this->user="root";
			$this->password="";
			$this->database="nabu";
		}

		function conectar()
		{
			$this->db = ADONewConnection('mysql');
			$this->db->debug =false;
			$this->db->execute("SET NAMES utf8");
			$this->db->NLS_DATE_FORMAT =  'RRRR-MM-DD HH24:MI:SS';
			$this->db->maxblobsize = 10485760; //Tamaño de los campos blob aumentado a 10 MB
			$this->db->Connect($this->host,$this->user, $this->password ,$this->database);
			return $this->db;
		}

		function desconectar()
		{
			$this->db->Disconnect();
		}
	}
?>