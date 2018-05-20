<?php
$municipios=$_Persona->Municipios();
$profesiones=$_Persona->Profesiones();
$marcas=$_Persona->Marcas();

?>
<form method="post" >


<table>
    <tr>
        <th>Cedula</th>
        <td><input type="number" placeholder="Cedula" required min="0" name="cedula" title="Solo Numeros" maxlength="80" pattern="[0-9]{6,8}"> </td>
    </tr>
    <tr>
        <th>Nombre</th>
        <td><input type="text" name="nombre" required pattern="[A-Z a-z]{3,80}" placeholder="Nombre"> </td>
    </tr>
    <tr>
        <th>Fecha de nacimiento</th>
        <td><input type="date" name="nacimiento" required  min="<?php echo date("Y-m-d", strtotime ( '-100 year' , strtotime ( date("Y-m-d") ) ) ); ?>" max="<?php echo date("Y-m-d", strtotime ( '-17 year' , strtotime ( date("Y-m-d") ) ) ); ?>"> </td>
    </tr>
    <tr>
        <th>Sexo</th>
        <td>
            <input type="radio" value="m" name="sexo" >Masculino
            <br>
            <input type="radio" value="f" name="sexo" >Femenino
        </td>
    </tr>
    <tr>
        <th>Telefono</th>
        <td>
            <input type="number" placeholder=" Telefono" name="telf"  pattern="[0-9]{11}" >
        </td>
    </tr>
    <tr>
        <th>
            Municipio
        </th>
        <td>
            <select name="munic" >
                <?php foreach($municipios as $m){ ?>
                    <option value="<?php echo $m['codemuni']; ?>"><?php echo $m['descmuni']; ?></option>
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
                    <option value="<?php echo $p['codeprof']; ?>"><?php echo $p['descprof']; ?></option>
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
                    <option value="<?php echo $m['codemarc']; ?>"><?php echo $m['descmarc']; ?></option>
                <?php } ?>
            
            </select>
        </td>
    </tr>
    <tr id="modelo">
    
    </tr>
    <tr>
        <th>
            Direccion:
        </th>
        <td>
            <textarea maxlength="255" placeholder="Direccion " name="direcc" required pattern="[A-Z a-z 0-9]{3,80}" ></textarea>
        </td>
    </tr>
    <tr>
        <th colspan="2">
            <input type="submit" value=" Guardar">
            <input type="reset" value="Limpiar">
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
        $.post("app/agregarp_async.php?type=agregar",$(this).serialize(),function(e){
            console.log(e);
            response=JSON.parse(e);
            
            if(response['resp']== 2){
               var r = confirm(response['mensj']);
                if (r == true) {
                    location.href = '<?php echo DOMAIN_ROOT ?>?view=editp&type=editar&id='+response['cedula'];
                } else {
                    alert("Proceso cancelado");
                }
           }else if(response['resp']==1){
               alert(response['mensj']);
           }
            
        });
        return false;
    })
})
</script>