<?php 
    require '../../modelo/modelo_usuario.php';

    $MU= new modelo_usuario();
    $idusuario= htmlspecialchars($_POST['idusuario'],ENT_QUOTES,'UTF-8');
    $estatus= htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
    $consulta =$MU->Modificar_Estatus_Usuario($idusuario,$estatus);
    // $data =json_encode($consulta);
    echo $consulta;
   
?>