<?php
$personas=$_Persona->get_personas();
?>

<table>
    <thead>
        <tr>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Sexo</th>
            <th>Municipio</th>
            <th>Direccion</th>
            <th>Profesion</th>
            <th>Vehiculo</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($personas as $p){ ?>
        <tr>
            <td><?php echo $p['cedupers']; ?></td>
            <td><?php echo $p['nombpers']; ?></td>
            <td><?php echo $p['edad']; ?></td>
            <td><?php echo $p['sexo']; ?></td>
            <td><?php echo $p['descmuni']; ?></td>
            <td><?php echo $p['direpers']; ?></td>
            <td><?php echo $p['descprof']; ?></td>
            <td><?php echo $p['descmarc'] ; ?>  / <?php echo $p['descmode'] ; ?> - <?php echo $p['aniomode'] ; ?></td>
            <td><a href="<?php echo DOMAIN_ROOT ?>?view=editp&type=editar&id=<?php echo $p['cedupers'] ?>"><button>Editar</button></a></td>
            <td><button onclick="eliminar(<?php echo $p['cedupers'] ?>,this)">Eliminar</button></td>
            <td></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<script>
function eliminar(cedu,pos){
    
    var r = confirm("Desea eliminar esta persona");
                if (r == true) {
                    $.post('app/listarp_async.php?type=eliminar','cedula='+cedu,function(e){
                        alert("Persona eliminada");
                        $(pos).parents('tr').fadeOut(500);
                        return e;
                    });                     
                } else {
                     alert("Proceso cancelado");
                }
    
}
</script>