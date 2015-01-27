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

   function addField($label,$type,$dataSource){

   	    if (!isset($field)){
            $field = array();
        }

    	$field["label"]=$label;
   		$field["type"]=$type;
   		$field["dataSource"]=$dataSource;

   		return $field;
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