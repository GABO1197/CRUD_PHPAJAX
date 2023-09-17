<?php 
    require '../../modelo/modelo_usuario.php';

    $MU= new modelo_usuario();
    $idusuario= htmlspecialchars($_POST['idusuario'],ENT_QUOTES,'UTF-8');
    $usuario= htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
    $sexo= htmlspecialchars($_POST['sexo'],ENT_QUOTES,'UTF-8');
    $rol= htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8');
    $consulta =$MU->Modificar_Datos_Usuario($idusuario,$usuario,$sexo,$rol);
    // $data =json_encode($consulta);
    echo $consulta;
   
?>