<?
$_dbname = '' ;
$_dbuser = '' ;
$_dbpass = '' ;
$_install_dir = '/var/virtual_www/htdocs/admin/restricted/facturation/' ;

ini_set('include_path', ini_get('include_path').':'.$_install_dir.'PEAR:'.$_install_dir.'biblio') ;

chdir($_SERVER['DOCUMENT_ROOT'].'/facturation/src/Model/common/') ;

require_once('common.php5') ;

chdir('../..') ;

//require_once('testdroit.php') ;
?>
