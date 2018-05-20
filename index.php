<?php
require("core/config_var.php");

require(COREROOT."common/top.php");
?>
    <!-- Main content -->

    <?php
        if($_GET['view']=='index' || empty($_GET['view']) ){
            include(APPROOT."inicio.php");
        }else{
            if(file_exists(APPROOT.$_GET['view'].".php")){
                include(APPROOT.$_GET['view'].".php");
            }else{
                include(APPROOT."404.php");
            }
        }
    ?>

<?php
require(COREROOT."common/footer.php");
?>