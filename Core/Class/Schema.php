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

  function addField($type,$format,$required,$pattern){

	    if (!isset($field)){
         $field = array();
     }

 	$field["type"]=$type;
	$field["format"]=$format;
	$field["required"]=$required;
	$field["pattern"]=$pattern;

	return $field;


 }



}

?>