<?php
namespace es\ucm\fdi\aw\valoracion;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\MagicProperties;

class Valoracion
{
    use MagicProperties;

   
    
    public static function crea($idusuario, $idsubasta, $idproducto, $puntuacion, $comentario,$idvendedor)
    {
        $valoracion = new valoracion($idusuario,$idsubasta,$puntuacion, $comentario,$idvendedor,  $idproducto);
        return $valoracion->guarda();
    }
    public static function actualizaSubasta($idvaloracion,$idusuario, $idsubasta, $idproducto, $puntuacion, $comentario,$idvendedor)
    {
        $valoracion = new valoracion($idusuario,$idsubasta,$puntuacion, $comentario,$idvendedor, $idproducto,$idvaloracion);
        return $valoracion->guarda();
    }
    
    public static function buscaPorId($idvaloracion)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM valoraciones V WHERE V.id_valoracion='%d' ", $idvaloracion );
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Valoracion( $fila['id_usuario'],  $fila['id_subasta'],  $fila['id_producto'],  $fila['puntuacion'],  $fila['comentario'],$fila['id_vendedor'],$fila['id_valoracion']);            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
       
        return $result;
    }


    public static function listarValoraciones($busqueda,$buscar=null)
    {
        $app=Aplicacion::getInstance();
        $idusuario=$app->idUsuario();
        $conn = $app->getConexionBd();
        $query =" ";

        if($busqueda=='usuario'){
            //listado general todas las valoraciones
            $query = sprintf("SELECT * FROM valoraciones V WHERE V.id_usuario= '%d'",  $idusuario);

           }else if($busqueda=='producto'){
        //listado de subsatas que tengo en estado borrador
        $query = sprintf("SELECT * FROM valoraciones V WHERE V.id_producto= '%d'",  $conn->real_escape_string($buscar));       
        }else if($busqueda=='vendedor'){
            $query = sprintf("SELECT * FROM valoraciones V WHERE V.id_vendedor= '%d'",  $conn->real_escape_string($buscar));
        }
        $rs = $conn->query($query);
        $valoraciones = array(); 
        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                $valoracion = new Valoracion(
                    $fila['id_usuario'],
                    $fila['id_subasta'],
                    $fila['id_producto'],
                    $fila['puntuacion'],
                    $fila['comentario'],
                    $fila['id_vendedor'],
                );
                $valoraciones[] = $valoracion; 
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $valoraciones; 
    }

    private static function inserta($valoracion)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        
        $query=sprintf("INSERT INTO subastas(id_usuario, id_subasta, id_producto,puntuacion,comentario,id_vendedor) VALUES ('%d', '%d', '%d', '%s','%s', '%d')"
            , $valoracion->idusuario
            , $valoracion->idsubasta
            , $valoracion->idproducto
            , $conn->real_escape_string($valoracion->puntuacion)
            , $conn->real_escape_string($valoracion->comentario)
            , $valoracion->idvendedor       
        );
        if ( $conn->query($query) ) {
            $valoracion->idvaloracion = $conn->insert_id;
            $result = $valoracion;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
   
    
    private static function actualiza($valoracion)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("UPDATE valoraciones V SET 
        puntuacion = '%s',
        comentario = %s,
        WHERE V.id_valoracion = %d",
        $conn->real_escape_string($valoracion->puntuacion),
        $conn->real_escape_string($valoracion->comentario),
        $valoracion->idvaloracion
    );
        if ( $conn->query($query) ) {
            $result = $valoracion;
            
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        
        return $result;
    }
   
      
    private static function borra($valoracion)
    {
        return self::borraPorId($valoracion->idvaloracion);
    }
    
    private static function borraPorId($idvaloracion)
    {
        if (!$idvaloracion) {
            return false;
        } 
       
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM valoraciones WHERE id_valoracion = %d" , $idvaloracion);
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

   
    private $idvaloracion;

    private $idusuario;

    private $idsubasta;

    private $idproducto;

    private $puntuacion;

    private $comentario;

    private $idvendedor;
    //Las valoraciones siempre estan relacionadas con un usuario
    private function __construct($idusuario,$idsubasta,$puntuacion, $comentario,$idvendedor,$idproducto=null,$idvaloracion = null)
    {
        $this->idvaloracion = $idvaloracion;
        $this->idusuario = $idusuario;
        $this->idsubasta = $idsubasta;
        $this->idsubasta = $idsubasta;
        $this->puntuacion = $puntuacion;
        $this->comentario = $comentario;
        $this->idvendedor = $idvendedor;
    }

    public function getIdValoracion() {
        return $this->idvaloracion;
    }
   public function getIdSubasta() {
        return $this->idsubasta;
    }

    public function getIdUsuario() {
        return $this->idusuario;
    }

    public function getIdProducto() {
        return $this->idproducto;
    }

    public function getPuntuacion() {
        return $this->puntuacion;
    }

    public function getComentario() {
        return $this->comentario;
    }


    public function guarda()
    {
        if ($this->idvaloracion !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }
    
    public function borrate()
    {
        if ($this->idvaloracion !== null) {
            return self::borra($this);
        }
        return false;
    }
}
