<?php
namespace es\ucm\fdi\aw\usuarios;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\MagicProperties;

class Usuario
{
    use MagicProperties;

    public const ADMIN_ROLE = 1;

    public const USER_ROLE = 2;

<<<<<<< HEAD
<<<<<<< HEAD
=======
    public const BUSSINES_ROLE = 3;

>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
    public const BUSSINES_ROLE = 3;

>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
    public static function login($nombreUsuario, $password)
    {
        $usuario = self::buscaUsuario($nombreUsuario);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return self::cargaRoles($usuario);
        }
        return false;
    }
    
<<<<<<< HEAD
<<<<<<< HEAD
    public static function crea($nombreUsuario, $password, $nombre, $rol)
    {
        $user = new Usuario($nombreUsuario, self::hashPassword($password), $nombre);
=======
    public static function crea($nombreUsuario, $password, $nombre,$email, $rol)
    {
        $user = new Usuario($nombreUsuario, self::hashPassword($password), $nombre,$email);
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
    public static function crea($nombreUsuario, $password, $nombre,$email, $rol)
    {
        $user = new Usuario($nombreUsuario, self::hashPassword($password), $nombre,$email);
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
        $user->añadeRol($rol);
        return $user->guarda();
    }

    public static function buscaUsuario($nombreUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
<<<<<<< HEAD
<<<<<<< HEAD
        $query = sprintf("SELECT * FROM Usuarios U WHERE U.nombreUsuario='%s'", $conn->real_escape_string($nombreUsuario));
=======
        $query = sprintf("SELECT * FROM usuarios U WHERE U.nombreUsuario='%s'", $conn->real_escape_string($nombreUsuario));
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
        $query = sprintf("SELECT * FROM usuarios U WHERE U.nombreUsuario='%s'", $conn->real_escape_string($nombreUsuario));
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
<<<<<<< HEAD
<<<<<<< HEAD
                $result = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'], $fila['id']);
=======
                $result = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'],$fila['email'], $fila['id_usuario']);
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
                $result = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'],$fila['email'], $fila['id_usuario']);
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public static function buscaPorId($idUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
<<<<<<< HEAD
<<<<<<< HEAD
        $query = sprintf("SELECT * FROM Usuarios WHERE id=%d", $idUsuario);
=======
        $query = sprintf("SELECT * FROM usuarios WHERE id=%d", $idUsuario);
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
        $query = sprintf("SELECT * FROM usuarios WHERE id=%d", $idUsuario);
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
<<<<<<< HEAD
<<<<<<< HEAD
                $result = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'], $fila['id']);
=======
                $result = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'],$fila['email'], $fila['id']);
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
                $result = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'],$fila['email'], $fila['id']);
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
    
    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private static function cargaRoles($usuario)
    {
        $roles=[];
            
        $conn = Aplicacion::getInstance()->getConexionBd();
<<<<<<< HEAD
<<<<<<< HEAD
        $query = sprintf("SELECT RU.rol FROM RolesUsuario RU WHERE RU.usuario=%d"
=======
        $query = sprintf("SELECT RU.rol FROM rolesusuario RU WHERE RU.usuario=%d"
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
        $query = sprintf("SELECT RU.rol FROM rolesusuario RU WHERE RU.usuario=%d"
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
            , $usuario->id
        );
        $rs = $conn->query($query);
        if ($rs) {
            $roles = $rs->fetch_all(MYSQLI_ASSOC);
            $rs->free();

            $usuario->roles = [];
            foreach($roles as $rol) {
                $usuario->roles[] = $rol['rol'];
            }
            return $usuario;

        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return false;
    }
   
    private static function inserta($usuario)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
<<<<<<< HEAD
<<<<<<< HEAD
        $query=sprintf("INSERT INTO Usuarios(nombreUsuario, nombre, password) VALUES ('%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
=======
=======
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
        $query=sprintf("INSERT INTO usuarios(nombreUsuario,nombre, email, password, fecha_registro) VALUES ('%s', '%s', '%s', '%s', NOW())"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->email)
<<<<<<< HEAD
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
            , $conn->real_escape_string($usuario->password)
        );
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
            $result = self::insertaRoles($usuario);
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
   
    private static function insertaRoles($usuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        foreach($usuario->roles as $rol) {
<<<<<<< HEAD
<<<<<<< HEAD
            $query = sprintf("INSERT INTO RolesUsuario(usuario, rol) VALUES (%d, %d)"
=======
            $query = sprintf("INSERT INTO rolesusuario(usuario, rol) VALUES (%d, %d)"
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
            $query = sprintf("INSERT INTO rolesusuario(usuario, rol) VALUES (%d, %d)"
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
                , $usuario->id
                , $rol
            );
            if ( ! $conn->query($query) ) {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
                return false;
            }
        }
        return $usuario;
    }
    
    private static function actualiza($usuario)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
<<<<<<< HEAD
<<<<<<< HEAD
        $query=sprintf("UPDATE Usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s' WHERE U.id=%d"
=======
        $query=sprintf("UPDATE usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s' WHERE U.id=%d"
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
        $query=sprintf("UPDATE usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s' WHERE U.id=%d"
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $usuario->id
        );
        if ( $conn->query($query) ) {
            $result = self::borraRoles($usuario);
            if ($result) {
                $result = self::insertaRoles($usuario);
            }
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        
        return $result;
    }
   
    private static function borraRoles($usuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
<<<<<<< HEAD
<<<<<<< HEAD
        $query = sprintf("DELETE FROM RolesUsuario RU WHERE RU.usuario = %d"
=======
        $query = sprintf("DELETE FROM rolesusuario RU WHERE RU.usuario = %d"
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
        $query = sprintf("DELETE FROM rolesusuario RU WHERE RU.usuario = %d"
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
            , $usuario->id
        );
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return $usuario;
    }
    
    private static function borra($usuario)
    {
        return self::borraPorId($usuario->id);
    }
    
    private static function borraPorId($idUsuario)
    {
        if (!$idUsuario) {
            return false;
        } 
        /* Los roles se borran en cascada por la FK
         * $result = self::borraRoles($usuario) !== false;
         */
        $conn = Aplicacion::getInstance()->getConexionBd();
<<<<<<< HEAD
<<<<<<< HEAD
        $query = sprintf("DELETE FROM Usuarios U WHERE U.id = %d"
=======
        $query = sprintf("DELETE FROM usuarios U WHERE U.id = %d"
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
        $query = sprintf("DELETE FROM usuarios U WHERE U.id = %d"
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
            , $idUsuario
        );
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    private $id;

    private $nombreUsuario;

    private $password;

    private $nombre;

<<<<<<< HEAD
<<<<<<< HEAD
    private $roles;

    private function __construct($nombreUsuario, $password, $nombre, $id = null, $roles = [])
=======
=======
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
    private $email;

    private $roles;

    private function __construct($nombreUsuario, $password, $nombre,$email, $id = null, $roles = [])
<<<<<<< HEAD
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
    {
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->nombre = $nombre;
<<<<<<< HEAD
<<<<<<< HEAD
=======
        $this->email = $email;
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
        $this->email = $email;
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
        $this->roles = $roles;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function añadeRol($role)
    {
        $this->roles[] = $role;
    }
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f
    public function getEmail()
    {
        return $this->email;
    }
<<<<<<< HEAD
>>>>>>> 0184f75da5a1c12fd62c9d877ff1ca3ca932e3f3
=======
>>>>>>> f8be654fffe5619bde51139daa8c1208168a212f

    public function getRoles()
    {
        return $this->roles;
    }

    public function tieneRol($role)
    {
        if ($this->roles == null) {
            self::cargaRoles($this);
        }
        return array_search($role, $this->roles) !== false;
    }

    public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }
    
    public function guarda()
    {
        if ($this->id !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }
    
    public function borrate()
    {
        if ($this->id !== null) {
            return self::borra($this);
        }
        return false;
    }
}
