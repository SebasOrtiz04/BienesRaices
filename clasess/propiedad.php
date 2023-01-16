<?php

//Se define el namespace
namespace App;

class Propiedad {

    //Base de datos
    protected static $db;
    protected static $columnnasDB=['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedores_id'];

    //Errores
    protected static array $errores = [];

    public string $id;
    public string $titulo;
    public string $precio;
    public string $imagen;
    public string $descripcion;
    public string $habitaciones;
    public string $wc;
    public string $estacionamiento;
    public string $creado;
    public string $vendedores_id;

    //Definir la conexión a la base de datos
    public static function setDB(object $database):void {
        self::$db = $database;
    }

    public function __construct(array $args = []){
        $this->id = $args['id'] ?? '';    
        $this->titulo = $args['titulo'] ?? '';    
        $this->precio = $args['precio'] ?? '';    
        $this->imagen = $args['imagen'] ?? '';    
        $this->descripcion = $args['descripcion'] ?? '';    
        $this->habitaciones = $args['habitaciones'] ?? '';    
        $this->wc = $args['wc'] ?? '';    
        $this->estacionamiento = $args['estacionamiento'] ?? '';    
        $this->creado = date('Y/m/d');    
        $this->vendedores_id = $args['vendedores_id'] ?? '';    
    }

    //Definir la función de guardar
    public function guardar():bool{

        //Sanitizar datos
        $atributos = $this->sanitizarDatos();

        //Insertar a la base de datos
        $query = "INSERT INTO propiedades (";
        $query.= join(', ',array_keys($atributos)); 
        $query.= ") VALUES ('";
        $query.= join("', '",array_values($atributos));
        $query.= "')";

        return self::$db->query($query);     
    }
    
    public function atributos(): array{
        $atributos = [];
        foreach(self::$columnnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos():array{
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return  $sanitizado;
    }

    //Validacion
    public static function getErrores():array{
        return self::$errores;
    }

    public function validar():array{
        if(!$this->titulo)self::$errores[]='Debes añadir un titulo';
        if(!$this->precio)self::$errores[]='El precio es obligatiorio';
        if(strlen($this->descripcion)<50)self::$errores[]='La descripcion es obligatoria y debe tener almenos  50 caracteres';
        if(!$this->habitaciones )self::$errores[]='Indica el número de habitaciones';
        if(!$this->wc )self::$errores[]='Indica el número de baños';
        if(!$this->estacionamiento )self::$errores[]='Indica el número de espacios de estacionamiento';
        if(!$this->vendedores_id )self::$errores[]='Elige un vendedor';
        if(!$this->imagen)self::$errores[]='La imagen es obligatoria';

        return self::$errores;
    }

    //Subida de archivos
    public function setImagen($imagen):void{
        if($imagen)$this->imagen=$imagen;
    }  
    
    //Lista todas las propiedades
    public static function all():array{
        $query = "SELECT * FROM propiedades";
        return self::consultarSQL($query);
    }

    public static function consultarSQL($query):array{
        
        //Consultar en la base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro=$resultado->fetch_assoc()){
            $array[]= self::crearObjeto($registro);
        }

        //Liberar memoria
        $resultado->free();

        //Retornar resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

        foreach($registro as $key => $value){
            if(property_exists($objeto,$key)){
                $objeto->$key=$value;
            }
        }

        return $objeto;
    }
}
