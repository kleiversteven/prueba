<?php
require("../core/config_var.php");
if($_GET['type']=='modelo'){
    $modelo=$_Persona->Modelo($_GET['marca']);
    
    ?>
    <th>Modelo</th>
    <td>
        <select name="modelo">
            <?php foreach($modelo as $m){ ?>
                <option value="<?php echo $m['codemode'] ?>" > <?php echo $m['descmode'] ?></option>
            <?php } ?>
        </select>
    </td>
    <?php
}
if($_GET['type']=="agregar"){
    
    $persona = $_Persona->buscar_persona($_POST['cedula']);
    if(empty($persona)){
        $_Persona->insert_persona($_POST['cedula'],$_POST['nombre'],$_POST['nacimiento'],$_POST['munic'],$_POST['direcc'],$_POST['telf'],$_POST['sexo']);
        $_Persona->add_profesion($_POST['cedula'],$_POST['profesion']);      
        $_Persona->add_vehiculo($_POST['cedula'],$_POST['marcas'],$_POST['modelo']);
        $resp=array("resp"=>1,"mensj"=> "Exito al registrar usuario");
    }else{
        $resp=array("resp"=>2,"mensj"=> "El usuario ".$persona[0]['nombpers']." ya se encuentra registrado", "cedula"=>$_POST['cedula']." \n Quiere editarlo?");
    }
    echo json_encode($resp);
    
}
?>