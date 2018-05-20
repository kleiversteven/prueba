<?php
require("../core/config_var.php");


        $_Persona->update_persona($_POST['cedula'],$_POST['nombre'],$_POST['munic'],$_POST['direcc'],$_POST['telf']);
        $_Persona->update_profesion($_POST['cedula'],$_POST['profesion']);      
        $_Persona->update_vehiculo($_POST['cedula'],$_POST['marcas'],$_POST['modelo']);