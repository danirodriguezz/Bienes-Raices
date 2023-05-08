<?php
    declare(strict_types = 1);
    namespace App;

class Propiedad {
    // Base de datos
    protected static $db;
    protected static $columnasDB = ["id", "vendedor_id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", 
    "estacionamiento","creado"];

    //Errores
    protected static $errores = [];

    public $id;
    public $vendedor_id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;

    public static function setDb($database) {
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? NULL;
        $this->vendedor_id = $args["vendedor_id"] ?? "";
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->estacionamiento = $args["estacionamiento"] ?? "";
        $this->creado = date("Y/m/d");
    }

    public function guardar() : bool{
        if(!is_null($this->id)) {
            //Actualizando
            return $this->actualizar();
        } else {
            //Creando un nuevo registro
            return $this->crear();
        }
    }

    //Crear un registro
    public function crear() :bool {
        //Sanitizar los datos
        $datos = $this->sanitizarDatos();
        $string = join(", ",array_values($datos));
        //  Insertar en la base de datos
        $query = "INSERT INTO propiedades (";
        $query .= join(", ", array_keys($datos));
        $query .= " ) VALUES( '" ;
        $query .= join("', '",array_values($datos));
        $query .= "' ) ";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    //Actualizar un registro
    public function actualizar() : void{
        $datos = $this->sanitizarDatos();
        $valores = [];
        foreach($datos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }
        $query = "UPDATE propiedades SET "; 
        $query .= join(", ", $valores); 
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";
        
        $resultado = self::$db->query($query);
        if ($resultado) {
            header("Location: http://localhost/Bienes_raices/admin?resultado=2");
            exit();
        }
    }

    public function eliminar() {
        $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        
        if($resultado) {
            $this->borrarImagen();
            header("Location: /Bienes_raices/admin/?resultado=3");
        }
    }

    //Esta funcion unicamente identifica  los atributos de la base de datos
    public function atributos() :array {
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna == "id") continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos() :array {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Subida de archivos 
    public function setImagen($imagen) {
        //Eliminar la imagen previa 
        if(!is_null( $this->id )) {
            //Comprobar si existe el archivo
            $this->borrarImagen();
        }
        // Asignar al atributp imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar archivo
    public function borrarImagen() {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo) {
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
    }

    //Validacion de errores
    public static function getErrores() :array {
        return self::$errores;
    }

    public function validarErrores() :array {
        if(!$this->titulo) {
            self::$errores[] = "El titulo es obligatorio";
        }
        if(!$this->precio || $this->precio > 99999999 ) {
            self::$errores[] = "El apartado de precio esta mal introducido";
        }
        if(strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripción es obligatorio y debe tener al menos 50 caracteres";
        }
        if(!$this->habitaciones) {
            self::$errores[] ="Debe introducir mínimo 1 habitación";
        }
        if(!$this->wc) {
            self::$errores[] = "El wc es obligatorio";
        }
        if(!$this->estacionamiento) {
            self::$errores[] = "El estacionamiento es obligatorio";
        }
        if(!$this->vendedor_id) {
            self::$errores[] = "Eliga un vendedor";
        }
        if(!$this->imagen) {
            self::$errores[] = "Es obligatorio las imagenes";
        }
        
        return self::$errores;
    }

    // Lista todos los registros
    public static function  all() :array {
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Buscar un registro por su id 
    public static function find($id) : object{
        $query = "SELECT * FROM propiedades WHERE id = {$id};";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado) ;
    }

    public static function consultarSQL($query) :array {
        //Consultar la base de datos 
        $resultado = self::$db->query($query);
        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }
        // Liberar la memoria
        $resultado->free();
        // Retornar los resultados
        return $array;
    }

    public static function crearObjeto($registro) :object {
        $objeto = new self;
        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = [] ) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value ;
            }
        }
    }
}