<?php


class TemplatePage
{
	function TemplatePage(){

	}


	function header($title){
?>
		<!DOCTYPE html>
		<html>
			<head>
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

			</head>
<?php
	}

	function banner(){

?>
		<header>
			<table width="100%">
				<tr>
					<td colspan="1">NABU</td>
				</tr>
				<tr>
					<td class="slogan" colspan="1">Innovative seed for give life to your ideas</td>
					<td class="banderas"  colspan="1">
						<img src="../../Images/col-flag.png" >
						<img src="../../Images/bra-flag.png" >
						<img src="../../Images/uk-flag.png" >
					</td>
				</tr>
			</table>
		</header>
		<br><br><br><br>

<?php
	}

	function body(){
?>
		<body>

<?php
	}
	function tail() {

?>

			</body>
		</html>

<?php
	}
}
?>
