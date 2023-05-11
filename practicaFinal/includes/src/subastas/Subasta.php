<?php
namespace es\ucm\fdi\aw\subastas;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\MagicProperties;
use DateTime;

class Subasta
{
    use MagicProperties;

    public static function actualizaestadoSubastas(){
        $app=Aplicacion::getInstance();
        $idusuario=$app->idUsuario();
        $conn = $app->getConexionBd();
        $query =" ";
        $query = sprintf("SELECT * FROM subastas S ");
        $rs = $conn->query($query);
        $result = false;
        $estado="";
        $PrecioActual="";

        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                $subasta = Subasta::creaObjeto($fila);
                $subastas[] = $subasta; // Agregamos la subasta al array
                $estado=$subasta->obtenerEstadoSubasta($subasta->getfechainicio(),$subasta->getfechafin());
                if ($subasta->getTipoSubasta()=="Holandesa"){
                    $cont=0;
                    $fecha_actual = date('M d, Y H:i:s');
                    $fecha_nuevo_precio ="";
                    $fecha_inicial= new DateTime($subasta->getFechaInicio());

                    if ($subasta->getIdGanador()!=null){
                        $estado="cerrada";
                    }

                    if($subasta->getPrecioInicial()>$subasta->getPrecioActual()){//comprueba si los precios han cambiado con respecto al inicial lo que significa que no es la primera vez que baja de precio
                        $PrecioActual=$subasta->getPrecioActual();//usamos la variable para apollarnos 

                        while ($PrecioActual<$subasta->getPrecioInicial()){//si precio inicial es mayor al actual entra al bucle es para calcular cuantas veces bajo el precio 
                            $cont=$cont+1;//aumenta el contador
                            $PrecioActual=$PrecioActual+$subasta->getIntervaloprecio();//actualiza la variable para el bucle 
                        }
                        $fecha_nuevo_precio = date('M d, Y H:i:s', strtotime($fecha_inicial->format('M d, Y H:i:s'). ' + '. $subasta->getIntervalotiempo().'*'.$cont.' days'));
                    }else {
                        $cont=1;
                        $fecha_nuevo_precio = date('M d, Y H:i:s', strtotime($fecha_inicial->format('M d, Y H:i:s'). ' + '. $subasta->getIntervalotiempo().' days'));
                    }
                    if ($fecha_actual>$fecha_nuevo_precio){
                        $PrecioActual=$subasta->getPrecioActual()-$subasta->getIntervaloprecio();
                    }
                }else{
                    $PrecioActual=$subasta->getPrecioActual();
                }                     

                $query = sprintf("UPDATE subastas S SET 
                precio_actual = %f,
                estado = '%s'
                WHERE S.id_subasta = %d",
                $PrecioActual,
                $estado,
                $subasta->idSubasta
            );
                $conn->query($query);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
       
    }
                                       
    public static function crea($idusuario, $titulo, $descripcion, $fechainicio, $fechafin, $precioinicial, $precioactual, $categoria, $estadoproducto,$tiposubasta,$intervalotiempo,$intervaloprecio)
    {
        $subasta = new subasta($idusuario, $titulo, $descripcion, $fechainicio, $fechafin, $precioinicial, $precioactual, $categoria, $estadoproducto,$tiposubasta,$intervalotiempo,$intervaloprecio);
        return $subasta->guarda();
    }
    public static function actualizaSubasta($idSubasta,$idusuario, $titulo, $descripcion, $fechainicio, $fechafin, $precioinicial, $precioactual, $categoria, $estadoproducto,$idganador=null,$estado=null)
    {
        $subasta = new subasta($idusuario, $titulo, $descripcion, $fechainicio, $fechafin, $precioinicial, $precioactual, $categoria, $estadoproducto,$idSubasta,$idganador,$estado);
        return $subasta->guarda();
    }
    public static function buscaSubasta($tituloSubasta)
    {
        $app=Aplicacion::getInstance();
        $conn = $app->getConexionBd();
        $query = sprintf("SELECT * FROM subastas S WHERE S.titulo LIKE '%%%s%%'", $conn->real_escape_string($tituloSubasta));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = Subasta::creaObjeto($fila);}          
                $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
       
        return $result;
    }
    public static function buscaPorId($idSubasta)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM subastas S WHERE S.id_subasta='%d' ", $idSubasta );
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result =Subasta::creaObjeto($fila);} 
                $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
       
        return $result;
    }
    public static function creaObjeto($fila){
        return new Subasta( $fila['id_usuario'],$fila['titulo'], $fila['descripcion'],$fila['fecha_inicio'],$fila['fecha_fin'],$fila['precio_inicial'],$fila['precio_actual'],$fila['categoria'],$fila['estadoproducto'], $fila['tipo_subasta'],$fila['intervalo_tiempo'],$fila['intervalo_precio'],$fila['id_subasta'], $fila['id_ganador'],$fila['estado']); 
    }

    public static function listarSubastas($busqueda,$buscar=null)
    {
        $app=Aplicacion::getInstance();
        $idusuario=$app->idUsuario();
        $conn = $app->getConexionBd();
        $query =" ";
        if($busqueda=='ventas'){
            //listado general todas las subastas
            $query = sprintf("SELECT * FROM subastas S WHERE S.id_usuario= '%d'",  $idusuario);

           }else if($busqueda=='borrador'){
        //listado de subsatas que tengo en estado borrador
            $query = sprintf("SELECT * FROM subastas S WHERE S.estado= '%s'AND S.id_usuario= '%d'", $conn->real_escape_string($busqueda), $idusuario);

        }else if($busqueda=='programado'){
          //listado de subastas que tengo en estado programadas
          $query = sprintf("SELECT * FROM subastas S WHERE S.estado= '%s'AND S.id_usuario= '%d'", $conn->real_escape_string($busqueda), $idusuario);

        }else if($busqueda=='activa'){
            //listado de subastas activas
            $query = sprintf("SELECT * FROM subastas S WHERE S.estado= '%s' AND S.id_usuario= '%d'", $conn->real_escape_string($busqueda), $idusuario);
            
        }else if($busqueda=='cerrada'){
            //listado de subastas cerradas 
            $query = sprintf("SELECT * FROM subastas S WHERE S.estado= '%s' AND S.id_usuario= '%d'", $conn->real_escape_string($busqueda), $idusuario);

        }else if($busqueda=='busquedaTitulo'){
            //listado de subastas buscadas por un titulo
            $query = sprintf("SELECT * FROM subastas S WHERE S.titulo LIKE '%%%s%%'", $conn->real_escape_string($buscar));

        }else if($busqueda=='categoria'){
            //listado de subastas por categoria
            $query = sprintf("SELECT * FROM subastas S  WHERE S.categoria= '%s'", $conn->real_escape_string($buscar));

        }else if($busqueda=='compras'){
            //listado de subastas cerradas 
            
            $query = sprintf("SELECT * FROM subastas S WHERE S.id_ganador= '%s'", $conn->real_escape_string($idusuario));
        }else{
            $query = sprintf("SELECT * FROM subastas");
            //$query = sprintf("SELECT * FROM Subastas WHERE Subastas.titulo LIKE %'%s'%",$conn->real_escape_string($busqueda));
        }
       // $query = sprintf("SELECT * FROM Subastas", $conn->real_escape_string($tituloSubasta));
        $rs = $conn->query($query);
        $subastas = array(); // Creamos un array vacío para almacenar las subastas
        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                $subasta = Subasta::creaObjeto($fila);
                $subastas[] = $subasta; // Agregamos la subasta al array
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $subastas; // Devolvemos el array de subastas
    }

   
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
      //  echo($subasta->id_usuario.",".$subasta->titulo .",".$subasta->descripcion .",".$subasta->fecha_inicio.",". $subasta->fecha_fin .",".$subasta->precio_inicial.",". $subasta->precio_actual.",". $subasta->id_ganador .",".$subasta->estado .",".$subasta->categoria.",". $subasta->estadoproducto.",". $subasta->obtenerEstadoSubasta($subasta->fecha_inicio,$subasta->fecha_fin));
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
                                            
        $query=sprintf("INSERT INTO subastas(id_usuario, titulo, descripcion, fecha_inicio, fecha_fin, precio_inicial, precio_actual, id_ganador, estado, categoria, estadoproducto, tipo_subasta, intervalo_tiempo, intervalo_precio) 
        VALUES ('%d', '%s', '%s', '%s','%s', '%f', '%f', NULL,'%s', '%s', '%s', '%s', '%s', '%f')"
        , $subasta->idusuario
        , $conn->real_escape_string($subasta->titulo)
        , $conn->real_escape_string($subasta->descripcion)
        , $conn->real_escape_string($subasta->fechainicio)
        , $conn->real_escape_string($subasta->fechafin)
        , $subasta->precioinicial
        , $subasta->precioactual
        , $conn->real_escape_string($subasta->obtenerEstadoSubasta($subasta->fechainicio,$subasta->fechafin))
        , $conn->real_escape_string($subasta->categoria)
        , $conn->real_escape_string($subasta->estadoproducto)
        , $conn->real_escape_string($subasta->tiposubasta)
        , $conn->real_escape_string($subasta->intervalotiempo)
        , $subasta->intervaloprecio
    );
        if ( $conn->query($query) ) {
            $subasta->idsubasta = $conn->insert_id;
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
        categoria = '%s',
        estadoproducto = '%s',
        WHERE S.id_subasta = %d",
        $conn->real_escape_string($subasta->titulo),
        $conn->real_escape_string($subasta->descripcion),
        $conn->real_escape_string($subasta->fechainicio),
        $conn->real_escape_string($subasta->fechafin),
        $subasta->precioinicial,
        $subasta->precioactual,
        $subasta->idganador,
        $conn->real_escape_string($subasta->obtenerEstadoSubasta($subasta->fechainicio,$subasta->fechafin)),
        $conn->real_escape_string($subasta->categoria),
        $conn->real_escape_string($subasta->estadoproducto),
        $subasta->idSubasta
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
        return self::borraPorId($subasta->idSubasta);
    }
    
    private static function borraPorId($idSubasta)
    {
        if (!$idSubasta) {
            return false;
        } 
        Imagen::borraPorIdSubasta($idSubasta);
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM subastas WHERE id_subasta = %d" , $idSubasta);
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public static function numeroSubastas()
    {
        $app=Aplicacion::getInstance();
        $conn = $app->getConexionBd();
        $query = sprintf("SELECT COUNT(*) FROM subastas");
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $row = $rs->fetch_row();
            $result = $row[0];
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
       if($result<7){
        return $result;
       }else{
        return 7;
       }
        
    }

    private $idsubasta;

    private $idusuario;

    private $titulo;

    private $descripcion;

    private $fechainicio;
    
    private  $fechafin;

    private $precioinicial;

    private $precioactual;

    private $idganador;

    private $estado;

    private $categoria;

    private $estadoproducto;

    private $tiposubasta;

    private $intervaloprecio;

    private $intervalotiempo;
    private function __construct($idusuario, $titulo, $descripcion, $fechainicio, $fechafin, $precioinicial, $precioactual, $categoria, $estadoproducto,$tiposubasta,$intervalotiempo=null,$intervaloprecio=null,$idsubasta = null,$idganador = null, $estado = null)
    {
        $this->idsubasta = $idsubasta;
        $this->idusuario = $idusuario;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->fechainicio = $fechainicio;
        $this->fechafin = $fechafin;
        $this->precioinicial = $precioinicial;
        $this->precioactual = $precioactual;
        $this->idganador = $idganador;
        $this->estado = $estado;
        $this->categoria = $categoria;
        $this->tiposubasta = $tiposubasta;
        $this->estadoproducto = $estadoproducto;
        $this->intervalotiempo = $intervalotiempo;
        $this->intervaloprecio = $intervaloprecio;
    }
    public function getIntervalotiempo() {
        return $this->intervalotiempo;
    }

    public function getIntervaloprecio() {
        return $this->intervaloprecio;
    }
   public function getIdSubasta() {
        return $this->idsubasta;
    }

    public function getIdUsuario() {
        return $this->idusuario;
    }
    public function getTipoSubasta() {
        return $this->tiposubasta;
    }
    public function getTitulo() {
        return $this->titulo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFechaInicio() {
        return $this->fechainicio;
    }
    public function getFechaFin() {
        return $this->fechafin;
    }
    public function getPrecioInicial() {
        return $this->precioinicial;
    }

    public function getPrecioActual() {
        return $this->precioactual;
    }

    public function getIdGanador() {
        return $this->idganador;
    }

    public function getEstado() {
        return $this->estado;
    }


    public function getCategoria() {
        return $this->categoria;
    }
    public function getCategoriaNombre() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT nombre FROM categorias where id= %d",
        $this->categoria
    );
           
        return  $conn->query($query)->fetch_assoc()['nombre'];
    }

    public function getEstadoProducto() {
        return $this->estadoproducto;
    }

    public function guarda()
    {
        if ($this->idsubasta !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }
    
    public function borrate()
    {
        if ($this->idsubasta !== null) {
            return self::borra($this);
        }
        return false;
    }
}
