<?php
error_reporting(0);
ini_set(display_errors, 0);
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
$document_root = '';
$cwd = getcwd();
$arrDirectoryHierarchy = explode(DIRECTORY_SEPARATOR, $cwd);
for($i=0, $limit=count($arrDirectoryHierarchy); $i<$limit; $i++){
	if($arrDirectoryHierarchy[$i]=='app' ){
		break;
	} else{
		$document_root .= $arrDirectoryHierarchy[$i].DIRECTORY_SEPARATOR;
	}
}

define ( 'COREROOT', $document_root."core/" );
define ( 'APPROOT', $document_root."app/" );

define ( 'DOMAIN_ROOT', 'http://' . $_SERVER ['SERVER_NAME'] . '/prueba/' );

require(COREROOT."class/consultas.class.php");
require(COREROOT."class/Persona.class.php");
$conex=new Consultas;
$conex= $conex->_connectDB();
$_Persona= new Persona;
