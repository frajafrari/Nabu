<?php

class Options{
	var $renderForm;

   function Options($renderForm){
      $this->renderForm = $renderForm;
   }

   function addButton($buttonId,$value,$title){

         if (!isset($this->buttons)){
           $this->buttons = array();
         }
        $this->buttons[$buttonId] = array("value"=> $value,"title"=> $title);
   }

   function addForm($fieldId,$value){

      if (!isset($this->form)){
         $this->form = array();
      }

      	if ($fieldId== "attributes")
      		$this->form[$fieldId] = $value;
		else{
			if ($fieldId== "buttons")
				$this->form[$fieldId] = $this->buttons;
		}
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