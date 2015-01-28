<?php

class Schema{
	var $title;
	var $description;
	var $type;
	var $properties;

   function Schema($title,$description,$type){
      $this->title = $title;
      $this->description = $description;
      $this->type = $type;
   }

   function addProperties($fieldId,$value){

      if (!isset($this->properties)){
         $this->properties = array();
      }

      $this->properties[$fieldId] = $value;
   }

  function addField($id,$type,$db,$field){

	 if (!isset($fields)){
         $fields = array();
     }

		$result = $db->Execute("SELECT b.nb_property_fld,a.nb_schem_value_fld FROM nb_forms_tbl a , nb_config_frmwrk_tbl b WHERE a.nb_config_frmwrk_id_fld = b.nb_config_frmwrk_id_fld and b.nb_config_type_fld='$type' and a.nb_id_page_fld = '$id' and a.nb_id_pr_schema_fld ='$field'");

		while ($row = $result->FetchRow()){
				$fields[$row[0]]=$row[1];
		}

	return $fields;

 }



}

?>