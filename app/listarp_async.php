<?php
require("../core/config_var.php");
if($_GET['type']=='eliminar'){
    $cedu=$_POST['cedula'];
    $_Persona->delete_persona($cedu);
   // echo $cedu;
}