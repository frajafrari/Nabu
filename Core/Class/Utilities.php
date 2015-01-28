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
	    $type='schema';
		$this->db=$this->cx->conectar();
		$this->result = $this->db->Execute("SELECT a.nb_title_fld, a.nb_description_fld, a.nb_type_fld FROM nb_schema_tbl a WHERE  a.nb_id_page_fld = '$id'");
		$row=$this->result->FetchRow();

		$json = new Schema($row[0],$row[1],$row[2]);

		$this->result = $this->db->Execute("SELECT distinct a.nb_id_pr_schema_fld FROM  nb_forms_tbl a , nb_config_frmwrk_tbl b WHERE a.nb_config_frmwrk_id_fld = b.nb_config_frmwrk_id_fld and  b.nb_config_type_fld='$type' and a.nb_id_page_fld = '$id'");

		while ($row = $this->result->FetchRow()){
			$campo=$json->addField($id,$type,$this->db,$row[0]);
			$json->addProperties($row[0],$campo);
		}

		$this->db=$this->cx->desconectar();

		return $json;
	}

	function getOption($id){
		$id=strtolower($id);
		$type='options';

		$this->db=$this->cx->conectar();

			$this->result = $this->db->Execute("SELECT nb_renderForm_fld FROM nb_options_tbl a WHERE  a.nb_id_page_fld = '$id'");
			$row=$this->result->FetchRow();

			$json = new Options($row[0]);

			$this->result = $this->db->Execute("SELECT a.nb_action_fld , a.nb_method_fld, a.nb_enctype_fld FROM  nb_options_form_tbl a WHERE a.nb_id_opt_form_fld='form' AND a.nb_id_page_fld = '$id'");
			$row=$this->result->FetchRow();

			$attributes=$json->addElement($row[0],$row[1],$row[2]);
			$json->addForm("attributes",$attributes);

			$this->result = $this->db->Execute("SELECT a.nb_id_opt_form_fld,a.nb_value_fld,a.nb_title_fld FROM nb_options_buttons_tbl a WHERE a.nb_id_page_fld = '$id'");

			$button = array();
			while ($row = $this->result->FetchRow()){
				$button[$row[0]] = array("value"=> $row[1],"title"=> $row[2]);
			}
			$json->addForm("buttons",$button);

			$this->result = $this->db->Execute("SELECT distinct a.nb_id_pr_schema_fld FROM nb_forms_tbl a , nb_config_frmwrk_tbl b WHERE a.nb_config_frmwrk_id_fld = b.nb_config_frmwrk_id_fld and  b.nb_config_type_fld='$type' and a.nb_id_page_fld = '$id'");

			while ($row = $this->result->FetchRow()){
				$campo=$json->addField($id,$type,$this->db,$row[0]);
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

	  <div id="contenido">
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
	  </div>
<?php
	}
}
?>


