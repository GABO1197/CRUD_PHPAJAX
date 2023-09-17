<?php
    class modelo_usuario{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
        function VerificarUsuario($usuario,$contra){
            $sql ="CALL SP_VERIFICAR_USUARIO('$usuario')";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					if(password_verify($contra, $consulta_VU["usu_contrasena"]))
                    {
                        $arreglo[] = $consulta_VU;
                    }
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }
        // PARA FOTO POR SEXO
        function TraerDatos($usuario){
            $sql ="CALL SP_VERIFICAR_USUARIO('$usuario')";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[]=$consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }
        // 
        function listar_usuario(){
            $sql = "CALL SP_LISTAR_USUARIO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;

				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }
        // cambiar contraseña
       
        function  Modificar_Contra_Usuario($idusuario,$contranu){
            $sql = "CALL SP_MODIFICAR_CONTRA_USUARIO('$idusuario','$contranu')";
			if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
            }
            else{
                return 0;
            }

        }
        // /////////////

        function listar_combo_rol(){
            $sql = "CALL SP_COMBO_ROL()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    $arreglo[]=$consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }

        function RegistrarUsuario($usuario,$contra,$sexo,$rol){
            $sql = "CALL SP_REGISTRAR_USUARIO('$usuario','$contra','$sexo','$rol')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				if($row = mysqli_fetch_array($consulta)) {
                    return $id=trim($row[0]);
				}
				
				$this->conexion->cerrar();
			}
        }
        
        function Modificar_Estatus_Usuario($idusuario,$estatus){
            $sql = "CALL SP_MODIFICAR_ESTATUS_USUARIO('$idusuario','$estatus')";
			// $arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
            }
            else{
                return 0;
            }

        }
        
        function Modificar_Datos_Usuario($idusuario,$usunombre,$sexo,$rol){
            $sql = "CALL SP_MODIFICAR_DATOS_USUARIO('$idusuario','$usunombre','$sexo','$rol')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
            }
            else{
                return 0;
            }

        }
        

       
    
}

?>