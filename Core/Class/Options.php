<?php

class Options{
	var $renderForm;
	var $form;
	var $fields;

   function Options($renderForm){
      $this->renderForm = $renderForm;
   }

   function addForm($fieldId,$value){

      if (!isset($this->form)){
         $this->form = array();
      }
      	$this->form[$fieldId] = $value;
	}

    function addFields($fieldId,$value){

         if (!isset($this->fields)){
            $this->fields = array();
         }

         $this->fields[$fieldId] = $value;
   }

   function addField($id,$type,$db,$field){

		if (!isset($fields)){
			$fields = array();
		}

		$result = $db->Execute("SELECT b.nb_property_fld,a.nb_schem_value_fld FROM nb_forms_tbl a , nb_config_frmwrk_tbl b WHERE  a.nb_config_frmwrk_id_fld = b.nb_config_frmwrk_id_fld and b.nb_config_type_fld='$type' and a.nb_id_page_fld = '$id' and a.nb_id_pr_schema_fld ='$field'");

		while ($row = $result->FetchRow()){
			$fields[$row[0]]=$row[1];
		}

		return $fields;

   }

  function addElement($action,$method,$enctype){

	    if (!isset($form)){
         $form = array();
     }

 	$form["action"]=$action;
	$form["method"]=$method;
	$form["enctype"]=$enctype;

	return $form;
 }



}

?>