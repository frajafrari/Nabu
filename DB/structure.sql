# Host: localhost  (Version: 5.6.16)
# Date: 2015-01-28 16:19:44
# Generator: MySQL-Front 5.3  (Build 4.133)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "nb_config_fields_tbl"
#

DROP TABLE IF EXISTS `nb_config_fields_tbl`;
CREATE TABLE `nb_config_fields_tbl` (
  `nb_config_id_field_fld` int(11) NOT NULL AUTO_INCREMENT,
  `nb_description_fld` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nb_config_id_field_fld`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

#
# Structure for table "nb_config_frmwrk_tbl"
#

DROP TABLE IF EXISTS `nb_config_frmwrk_tbl`;
CREATE TABLE `nb_config_frmwrk_tbl` (
  `nb_config_frmwrk_id_fld` int(11) NOT NULL AUTO_INCREMENT,
  `nb_config_type_fld` varchar(255) NOT NULL DEFAULT '',
  `nb_property_fld` varchar(255) NOT NULL DEFAULT '',
  `nb_type_fld` varchar(255) DEFAULT NULL,
  `nb_default_fld` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nb_config_frmwrk_id_fld`,`nb_config_type_fld`,`nb_property_fld`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

#
# Structure for table "nb_forms_tbl"
#

DROP TABLE IF EXISTS `nb_forms_tbl`;
CREATE TABLE `nb_forms_tbl` (
  `nb_id_page_fld` varchar(255) NOT NULL DEFAULT '0',
  `nb_id_pr_schema_fld` varchar(255) NOT NULL DEFAULT '0',
  `nb_config_id_field_fld` int(11) NOT NULL DEFAULT '0',
  `nb_config_frmwrk_id_fld` int(11) NOT NULL DEFAULT '0',
  `nb_schem_value_fld` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nb_id_page_fld`,`nb_id_pr_schema_fld`,`nb_config_id_field_fld`,`nb_config_frmwrk_id_fld`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Structure for table "nb_options_buttons_tbl"
#

DROP TABLE IF EXISTS `nb_options_buttons_tbl`;
CREATE TABLE `nb_options_buttons_tbl` (
  `nb_id_page_fld` varchar(255) NOT NULL DEFAULT '',
  `nb_id_opt_form_fld` varchar(255) NOT NULL DEFAULT '',
  `nb_id_op_fo_but_fld` varchar(255) NOT NULL DEFAULT '',
  `nb_value_fld` varchar(255) DEFAULT NULL,
  `nb_title_fld` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nb_id_page_fld`,`nb_id_opt_form_fld`,`nb_id_op_fo_but_fld`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Structure for table "nb_options_form_tbl"
#

DROP TABLE IF EXISTS `nb_options_form_tbl`;
CREATE TABLE `nb_options_form_tbl` (
  `nb_id_page_fld` varchar(255) NOT NULL DEFAULT '',
  `nb_id_opt_form_fld` varchar(255) NOT NULL DEFAULT '',
  `nb_property_fld` varchar(255) NOT NULL DEFAULT '',
  `nb_action_fld` varchar(255) DEFAULT NULL,
  `nb_method_fld` varchar(255) DEFAULT NULL,
  `nb_enctype_fld` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nb_id_page_fld`,`nb_id_opt_form_fld`,`nb_property_fld`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Structure for table "nb_options_tbl"
#

DROP TABLE IF EXISTS `nb_options_tbl`;
CREATE TABLE `nb_options_tbl` (
  `nb_id_page_fld` varchar(255) NOT NULL DEFAULT '',
  `nb_renderForm_fld` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nb_id_page_fld`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Structure for table "nb_schema_tbl"
#

DROP TABLE IF EXISTS `nb_schema_tbl`;
CREATE TABLE `nb_schema_tbl` (
  `nb_id_page_fld` varchar(255) NOT NULL DEFAULT '0',
  `nb_title_fld` varchar(255) DEFAULT NULL,
  `nb_description_fld` varchar(255) DEFAULT NULL,
  `nb_type_fld` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nb_id_page_fld`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
