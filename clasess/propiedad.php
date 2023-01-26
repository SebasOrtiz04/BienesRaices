<?php

//Se define el namespace
namespace App;

class Propiedad extends ActiveRecord{

    protected static $tabla = 'propiedades';
    protected static $columnnasDB=['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedores_id'];

    public $id;
    public string $titulo;
    public string $precio;
    public string $imagen;
    public string $descripcion;
    public string $habitaciones;
    public string $wc;
    public string $estacionamiento;
    public string $creado;
    public string $vendedores_id;

    public function __construct(array $args = []){
        $this->id = $args['id'] ?? null;    
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

    //Validación
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
}