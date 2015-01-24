<?php

include "../../Class/Conexion.php";
include "../../Class/Schema.php";
include "../../Class/Options.php";

class Utilities
{
	var $cx;
	var	$db;
	var $result;


	function Utilities(){
		$this->cx=new Conexion();
	}

	function getSchema($id){

	    $id=strtolower($id);
		$this->db=$this->cx->conectar();
		$this->result = $this->db->Execute("SELECT a.cc_title, a.cc_description, a.cc_type FROM cc_schema a WHERE  a.cc_id_page = '$id'");
		$row=$this->result->FetchRow();

		$json = new Schema($row[0],$row[1],$row[2]);

		$this->result = $this->db->Execute("SELECT b.cc_id_pr_schema,b.cc_type,b.cc_format,b.cc_required,b.cc_pattern FROM cc_schema a, cc_schm_properties b WHERE  a.cc_id_page = b.cc_id_page AND a.cc_id_page = '$id'");

		while ($row = $this->result->FetchRow()){

			$campo=$json->addField($row[1],$row[2],$row[3],$row[4]);
			$json->addProperties($row[0],$campo);
		}

		$this->db=$this->cx->desconectar();

		return $json;
	}

	function getOption($id){
		$id=strtolower($id);

		$this->db=$this->cx->conectar();

			$this->result = $this->db->Execute("SELECT cc_renderForm FROM cc_options a WHERE  a.cc_id_page = '$id'");
			$row=$this->result->FetchRow();

			$json = new Options($row[0]);

			$this->result = $this->db->Execute("SELECT a.cc_action , a.cc_method, a.cc_enctype FROM  cc_options_form a WHERE a.cc_id_opt_form='form' AND a.cc_id_page = '$id'");
			$row=$this->result->FetchRow();

			$attributes=$json->addElement($row[0],$row[1],$row[2]);
			$json->addForm("attributes",$attributes);

			$this->result = $this->db->Execute("SELECT a.cc_id_opt_form,a.cc_value,a.cc_title FROM cc_options_buttons a WHERE a.cc_id_page = '$id'");


			while ($row = $this->result->FetchRow()){
				$boton = $json->addButton($row[0],$row[1],$row[2]);
				$json->addForm("buttons",$boton);
			}

			$this->result = $this->db->Execute("SELECT a.cc_property, a.cc_label, a.cc_type, a.cc_dataSource FROM  cc_options_form a WHERE a.cc_id_opt_form ='fields' AND a.cc_id_page = '$id'");

			while ($row = $this->result->FetchRow()){

				$campo=$json->addField($row[1],$row[2],$row[3]);
				$json->addFields($row[0],$campo);
			}

		$this->db=$this->cx->desconectar();

		return $json;

	}

	function forms($style,$imprimirJsons,$schema,$options,$data){

		if ($imprimirJsons) {
			echo '*******************************************************options******************************************************* <br/>';
			print_r(json_encode($options));
			echo ' <br/>*******************************************************schema******************************************************* <br/>';
			print_r(json_encode($schema));
			echo '<br/>*******************************************************data******************************************************* <br/>';
			print_r(json_encode($data));
		}
?>

	  <div class=<?php echo $style ?> >
			<div id="field1"></div>
				<script type="text/javascript" id="field1-script">
					$(function() {
						Alpaca.setDefaultLocale("es_ES");
						$("#field1").alpaca({
							"optionsSource":<?php print_r(json_encode($options));?>,
							"schema":<?php print_r(json_encode($schema));?>,
							"dataSource":<?php print_r(json_encode($data));?>,
							 "view": "bootstrap-create-horizontal"
						});
					});
				</script>
		</div>
<?php
	}
}
?>


