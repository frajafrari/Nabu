<?php

include "../../Class/Menu.php";


class TemplatePage
{
	var $menu;
	var $id_page;
	function TemplatePage($id_page){

		$this->id_page=$id_page;
	}


	function header($title){
?>
		<!DOCTYPE html>
		<html>
			<head>

				<meta charset="utf-8" />
				<meta name="author" content="nabu" />


				<title><?php echo $title ?></title>

				<!-- Propias -->
				<link href="../../Styles/nabu.css" rel=stylesheet type=text/css>
				<link rel="icon" type="image/x-icon" href="../../Images/logo.ico" />

				<!-- dependencies (jquery, handlebars and bootstrap) -->
				<script type="text/javascript" src="../../Framework/jquery/dist/jquery.min.js"></script>
				<script type="text/javascript" src="../../Framework/handlebars/handlebars.min.js"></script>
				<link type="text/css" href="../../Framework/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
				<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>


				<!-- alpaca -->
				<link type="text/css" href="../../Framework/alpaca/dist/alpaca/bootstrap/alpaca.min.css" rel="stylesheet"/>
				<script type="text/javascript" src="../../Framework/alpaca/dist/alpaca/bootstrap/alpaca.min.js"></script>

				<!-- Menu -->
			    <script src="../../Framework/mmenu/src/js/jquery.mmenu.min.js" type="text/javascript"></script>
   				<link href="../../Framework/mmenu/src/css/jquery.mmenu.all.css" type="text/css" rel="stylesheet" />
				<link type="text/css" rel="stylesheet" href="../../Styles/menuNabu.css" />


				<script type="text/javascript">
					$(function() {
						$('nav#menu').mmenu();
					});
				</script>


			</head>
<?php
	}

	function banner(){

?>
<div class="Menuheader"><a href="#menu"></a></div>

<div class="content">
	<header>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="1">&nbsp&nbsp&nbsp&nbsp&nbsp&nbspNABU</td>
				</tr>
				<tr>
					<td class="slogan">&nbsp&nbspInnovative seed for give life to your ideas</td>
					<td class="banderas"  colspan="1">
						<img src="../../Images/col-flag.png" >
						<img src="../../Images/uk-flag.png" >
					</td>
				</tr>
			</table>
		</header>


		<br><br><br><br>



<?php
		$this->menu = new Menu($this->id_page);
	}

	function body(){
?>
		<body>
<?php
	}


	function tail() {



?>
				</div>
			</body>
		</html>

<?php
	}
}
?>
