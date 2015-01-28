# Host: localhost  (Version: 5.6.16)
# Date: 2015-01-28 16:20:11
# Generator: MySQL-Front 5.3  (Build 4.133)

/*!40101 SET NAMES utf8 */;

#
# Data for table "nb_config_fields_tbl"
#

INSERT INTO `nb_config_fields_tbl` (`nb_config_id_field_fld`,`nb_description_fld`) VALUES (1,'Any'),(2,'Array'),(3,'Checkbox'),(4,'File'),(5,'Hidden'),(6,'Number'),(7,'Object'),(8,'Radio'),(9,'Select'),(10,'Text Area'),(11,'Text'),(12,'Address'),(13,'Color'),(14,'CK Editor'),(15,'Country'),(16,'Currency'),(17,'Date'),(18,'Date Time'),(19,'Editor'),(20,'Email'),(21,'Grid'),(22,'Image'),(23,'Integer'),(24,'IPV4'),(25,'JSON'),(26,'Lower Case'),(27,'Map'),(28,'Password'),(29,'Personal Name'),(30,'Phone'),(31,'Search'),(32,'State'),(33,'Table'),(34,'Tag'),(35,'Time'),(36,'Upload'),(37,'Upper Case'),(38,'URL'),(39,'Zip Code');

#
# Data for table "nb_config_frmwrk_tbl"
#

INSERT INTO `nb_config_frmwrk_tbl` (`nb_config_frmwrk_id_fld`,`nb_config_type_fld`,`nb_property_fld`,`nb_type_fld`,`nb_default_fld`) VALUES (1,'schema','default','any',NULL),(2,'schema','dependencies','array',NULL),(3,'schema','description','string',NULL),(4,'schema','disallow','array',NULL),(5,'schema','enum','array',NULL),(6,'schema','format','string',NULL),(7,'schema','maxLength','number',NULL),(8,'schema','minLength','number',NULL),(9,'schema','pattern','string',NULL),(10,'schema','readonly','boolean',NULL),(11,'schema','required','boolean',NULL),(12,'schema','title','string',NULL),(13,'schema','type','string','string'),(14,'options','allowOptionalEmpty',NULL,NULL),(15,'options','data','object',NULL),(16,'options','disabled','boolean',NULL),(17,'options','fieldClass','string',NULL),(18,'options','focus','checkbox','true'),(19,'options','form','object',NULL),(20,'options','helper','hidden','boolean'),(21,'options','hideInitValidationError','boolean',NULL),(22,'options','id','string',NULL),(23,'options','inputType','string',NULL),(24,'options','label','string',NULL),(25,'options','maskString','string',NULL),(26,'options','name','string',NULL),(27,'options','optionLabels','array',NULL),(28,'options','placeholder','string',NULL),(29,'options','readonly','boolean',NULL),(30,'options','showMessages','boolean','true'),(31,'options','size','number','40'),(32,'options','type','string','text'),(33,'options','typeahead',NULL,NULL),(34,'options','validate','boolean','true'),(35,'options','view','string',NULL);

#
# Data for table "nb_forms_tbl"
#

INSERT INTO `nb_forms_tbl` (`nb_id_page_fld`,`nb_id_pr_schema_fld`,`nb_config_id_field_fld`,`nb_config_frmwrk_id_fld`,`nb_schem_value_fld`) VALUES ('login.php','Campo1',11,9,'^[a-zA-Z0-9_]+$'),('login.php','Campo1',11,11,'true'),('login.php','Campo1',11,13,'string'),('login.php','Campo1',11,24,'Login'),('login.php','Campo2',11,6,'password'),('login.php','Campo2',11,9,'^[a-zA-Z0-9_]+$'),('login.php','Campo2',11,11,'true'),('login.php','Campo2',11,13,'string'),('login.php','Campo2',11,24,'Password');

#
# Data for table "nb_options_buttons_tbl"
#

INSERT INTO `nb_options_buttons_tbl` (`nb_id_page_fld`,`nb_id_opt_form_fld`,`nb_id_op_fo_but_fld`,`nb_value_fld`,`nb_title_fld`) VALUES ('login.php','reset','2','Limpiar','Limpiar'),('login.php','submit','1','Aceptar','Aceptar');

#
# Data for table "nb_options_form_tbl"
#

INSERT INTO `nb_options_form_tbl` (`nb_id_page_fld`,`nb_id_opt_form_fld`,`nb_property_fld`,`nb_action_fld`,`nb_method_fld`,`nb_enctype_fld`) VALUES ('login.php','form','attributes','../../Events/validateUser.php','post','multipart/form-data');

#
# Data for table "nb_options_tbl"
#

INSERT INTO `nb_options_tbl` (`nb_id_page_fld`,`nb_renderForm_fld`) VALUES ('login.php','true');

#
# Data for table "nb_schema_tbl"
#

INSERT INTO `nb_schema_tbl` (`nb_id_page_fld`,`nb_title_fld`,`nb_description_fld`,`nb_type_fld`) VALUES ('login.php','Ingreso a Nabu','Ingrese los datos solicitados','object');
