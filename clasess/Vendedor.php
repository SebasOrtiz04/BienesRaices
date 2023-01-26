<?php

namespace App;

class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $columnnasDB=['id','nombre','apellido','telefono'];

    //Declaración de atributos
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    //Declaración del constructor
    public function __construct(array $args = []){
        $this->id = $args['id'] ?? null;    
        $this->nombre = $args['nombre'] ?? '';    
        $this->apellido = $args['apellido'] ?? '';    
        $this->telefono = $args['telefono'] ?? '';      
    }

    //Validación
    public function validar():array{
        if(!$this->nombre)self::$errores[]='El nombre es obligatorio';
        if(!$this->apellido)self::$errores[]='El apellido es obligatotio';
        if(!$this->telefono){
            self::$errores[]='El telefono es obligatotrio';
        } else {
            if(!preg_match('/[0-9]{10}/',$this->telefono))
            self::$errores[]='Formato del telefono inválido';
        }

        return self::$errores;
    }
}