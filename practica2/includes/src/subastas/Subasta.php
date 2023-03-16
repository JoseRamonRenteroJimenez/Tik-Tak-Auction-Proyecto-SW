<?php
namespace es\ucm\fdi\aw\subastas;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\MagicProperties;

class Subasta
{
    use MagicProperties;

   
    
    public static function crea($id_usuario, $titulo, $descripcion, $fecha_inicio, $fecha_fin, $precio_inicial, $precio_actual, $imagen, $categoria, $estadoproducto)
    {
        $subasta = new subasta($id_usuario, $titulo, $descripcion, $fecha_inicio, $fecha_fin, $precio_inicial, $precio_actual, $imagen, $categoria, $estadoproducto);
        return $subasta->guarda();
    }

    public static function buscaSubasta($tituloSubasta)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Subastas S WHERE S.titulo LIKE %'%s'%", $conn->real_escape_string($tituloSubasta));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Subasta( $fila['id_usuario'],  $fila['titulo'],  $fila['descripcion'],  $fila['fecha_inicio'],  $fila['fecha_fin'],  $fila['precio_inicial'],  $fila['precio_actual'], $fila['id_ganador'], $fila['estado'],$fila['imagen'],$fila['categoria'],$fila['estadoproducto']);            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

   /* public static function buscaPorId($idUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Usuarios WHERE id=%d", $idUsuario);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'],$fila['email'], $fila['id']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }*/
    function obtenerEstadoSubasta($fechaInicio, $fechaFin) {
        $fechaActual = date('Y-m-d H:i:s');
        
        if ($fechaInicio > $fechaActual) {
            return 'borrador';
        } else if ($fechaInicio <= $fechaActual && $fechaActual <= $fechaFin) {
            return 'activa';
        } else {
            return 'cerrada';
        }
    }
    private static function inserta($subasta)
    {
        echo($subasta->id_usuario.",".$subasta->titulo .",".$subasta->descripcion .",".$subasta->fecha_inicio.",". $subasta->fecha_fin .",".$subasta->precio_inicial.",". $subasta->precio_actual.",". $subasta->id_ganador .",".$subasta->estado .",".$subasta->imagen .",".$subasta->categoria.",". $subasta->estadoproducto.",". $subasta->obtenerEstadoSubasta($subasta->fecha_inicio,$subasta->fecha_fin));
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        
        $query=sprintf("INSERT INTO Subastas(id_usuario, titulo, descripcion, fecha_inicio, fecha_fin, precio_inicial, precio_actual, id_ganador, estado, imagen, categoria, estadoproducto) VALUES ('%d', '%s', '%s', '%s','%s', '%f', '%f', NULL,'%s','%s', '%s', '%s')"
            , $subasta->id_usuario
            , $conn->real_escape_string($subasta->titulo)
            , $conn->real_escape_string($subasta->descripcion)
            , $conn->real_escape_string($subasta->fecha_inicio)
            , $conn->real_escape_string($subasta->fecha_fin)
            , $subasta->precio_inicial
            , $subasta->precio_actual
            , $conn->real_escape_string($subasta->obtenerEstadoSubasta($subasta->fecha_inicio,$subasta->fecha_fin))
            , $conn->real_escape_string($subasta->imagen)
            , $conn->real_escape_string($subasta->categoria)
            , $conn->real_escape_string($subasta->estadoproducto)
            
        );
        if ( $conn->query($query) ) {
            $subasta->id_subasta = $conn->insert_id;
            $result = $subasta;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
   
    
    private static function actualiza($subasta)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("UPDATE subastas S SET 
        titulo = '%s',
        descripcion = '%s',
        fecha_inicio = '%s',
        fecha_fin = '%s',
        precio_inicial = %f,
        precio_actual = %f,
        id_ganador = %d,
        estado = '%s',
        imagen = '%s',
        categoria = '%s',
        estadoproducto = '%s'
        WHERE S.id_subasta = %d",
        $conn->real_escape_string($subasta->titulo),
        $conn->real_escape_string($subasta->descripcion),
        $conn->real_escape_string($subasta->fecha_inicio),
        $conn->real_escape_string($subasta->fecha_fin),
        $subasta->precio_inicial,
        $subasta->precio_actual,
        $subasta->id_ganador,
        $conn->real_escape_string($subasta->estado),
        $conn->real_escape_string($subasta->imagen),
        $conn->real_escape_string($subasta->categoria),
        $conn->real_escape_string($subasta->estadoproducto),
        $subasta->id
    );
        if ( $conn->query($query) ) {
            $result = $subasta;
            
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        
        return $result;
    }
   
      
    private static function borra($subasta)
    {
        return self::borraPorId($subasta->id);
    }
    
    private static function borraPorId($idSubasta)
    {
        if (!$idSubasta) {
            return false;
        } 
       
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM Subastas S WHERE S.id = %d"
            , $idSubasta
        );
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

   

    private $id_subasta;

    private $id_usuario;

    private $titulo;

    private $descripcion;

    private $fecha_inicio;
    
    private  $fecha_fin;

    private $precio_inicial;

    private $precio_actual;

    private $id_ganador;

    private $estado;

    private $imagen;

    private $categoria;

    private $estadoproducto;

    private function __construct($id_usuario, $titulo, $descripcion, $fecha_inicio, $fecha_fin, $precio_inicial, $precio_actual,$imagen, $categoria, $estadoproducto,$id_subasta = null,$id_ganador = null, $estado = null)
    {
        $this->id_subasta = $id_subasta;
        $this->id_usuario = $id_usuario;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->precio_inicial = $precio_inicial;
        $this->precio_actual = $precio_actual;
        $this->id_ganador = $id_ganador;
        $this->estado = $estado;
        $this->imagen = $imagen;
        $this->categoria = $categoria;
        $this->estadoproducto = $estadoproducto;
    }
   public function getIdSubasta() {
        return $this->id_subasta;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFechaInicio() {
        return $this->fecha_inicio;
    }
    public function getFechaFin() {
        return $this->fecha_fin;
    }
    public function getPrecioInicial() {
        return $this->precio_inicial;
    }

    public function getPrecioActual() {
        return $this->precio_actual;
    }

    public function getIdGanador() {
        return $this->id_ganador;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getEstadoProducto() {
        return $this->estadoproducto;
    }

    public function guarda()
    {
        if ($this->id_subasta !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }
    
    public function borrate()
    {
        if ($this->id_subasta !== null) {
            return self::borra($this);
        }
        return false;
    }
}
