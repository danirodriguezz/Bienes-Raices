<?php

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
        $this->id = $args["id"] ?? "";
        $this->vendedor_id = $args["vendedor_id"] ?? "";
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "imagen.jpg";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->estacionamiento = $args["estacionamiento"] ?? "";
        $this->creado = date("Y/m/d");
    }

    public function guardar() {
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
        debugear($resultado);
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
        // if(!$this->imagen["name"]) {
        //     self::$errores[] = "Es obligatorio las imagenes";
        // }
        // //Validar por tamaño de fotos(100Kb MAX)
        // $medida = 40000000;
        // if($this->imagen["size"] > $medida) {
        //     self::$errores[] = "La imagen es muy pesada";
        // }
        return self::$errores;
    }
}