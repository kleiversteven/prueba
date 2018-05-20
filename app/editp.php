<?php

if($_GET['type'] == 'editar'){
   $persona= $_Persona->get_personas($_GET['id']);
    $pers=$persona[0];
    $municipios=$_Persona->Municipios();
    $profesiones=$_Persona->Profesiones();
    $marcas=$_Persona->Marcas();
?>
<form method="post" >


<table>
    <tr>
        <th>Cedula</th>
        <td><input type="number" readonly value="<?php echo $pers['cedupers'] ?>" placeholder="Cedula" required min="0" name="cedula" title="Solo Numeros" maxlength="80" pattern="[0-9]{6,8}"> </td>
    </tr>
    <tr>
        <th>Nombre</th>
        <td><input type="text" value="<?php echo $pers['nombpers'] ?>" name="nombre" required pattern="[A-Z a-z]{3,80}" placeholder="Nombre"> </td>
    </tr>
    <tr>
        <th>Telefono</th>
        <td>
            <input type="number" value="<?php echo $pers['telepers'] ?>" placeholder=" Telefono" name="telf"  pattern="[0-9]{11}" >
        </td>
    </tr>
    <tr>
        <th>
            Municipio
        </th>
        <td>
            <select name="munic" >
                <?php foreach($municipios as $m){ ?>
                    <option value="<?php echo $m['codemuni']; ?>" <?php if($pers['codemuni'] == $m['codemuni']) ?> selected   ><?php echo $m['descmuni']; ?></option>
                <?php } ?>
            
            </select>
        </td>
    </tr>
    <tr>
        <th>
            Profesion
        </th>
        <td>
            <select name="profesion" >   
                <?php foreach($profesiones as $p){ ?>
                    <option value="<?php echo $p['codeprof']; ?>" <?php if($pers['codeprof'] == $p['codeprof']) ?> selected><?php echo $p['descprof']; ?></option>
                <?php } ?>
            
            </select>
        </td>
    </tr>
    <tr>
        <th>
            Marcas
        </th>
        <td>
            <select name="marcas" onchange="cargarmodelo(this.value)" >
                <option value="">Marca del carro</option>
                <?php foreach($marcas as $m){ ?>
                    <option value="<?php echo $m['codemarc']; ?>" <?php if($pers['codemarc'] == $m['codemarc']){ ?> selected <?php } ?>  ><?php echo $m['descmarc']; ?></option>
                <?php } ?>
            
            </select>
        </td>
    </tr>
    <tr id="modelo">
        <?php
            $modelo=$_Persona->Modelo($pers['codemarc']);
        ?>
        <th>Modelo</th>
        <td>
            <select name="modelo">
                <?php foreach($modelo as $m){ ?>
                    <option value="<?php echo $m['codemode'] ?>" <?php if($pers['codemode'] == $m['codemode']){ ?> selected <?php } ?>> <?php echo $m['descmode'] ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <th>
            Direccion:
        </th>
        <td>
            <textarea maxlength="255" placeholder="Direccion " name="direcc" required pattern="[A-Z a-z 0-9]{3,80}" ><?php echo $pers['direpers']; ?></textarea>
        </td>
    </tr>
    <tr>
        <th colspan="2">
            <input type="submit" value=" Actualizar">
        </th>
    </tr>
</table>

</form>
<script>
function cargarmodelo(marca){
    $.post("app/agregarp_async.php?type=modelo&marca="+marca,function(e){
       $('#modelo').html(e);
    });
}
    $(function(){
        $('form').submit(function(){
             $.post("app/editp_async.php?type=agregar",$(this).serialize(),function(e){
                console.log(e);
                  location.href = "<?php echo DOMAIN_ROOT ?>?view=listarp";
            });
            return false;
        })
    })
</script>
<?php
}