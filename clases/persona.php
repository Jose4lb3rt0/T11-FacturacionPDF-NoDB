<?php 

    abstract class Persona{
        protected $nombre;
        protected $apellido;
        protected $dni;
        protected $telefono;

        public function __construct($nombre, $apellido, $dni, $telefono){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->dni = $dni;
            $this->telefono = $telefono;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getApellido(){
            return $this->apellido;
        }

        public function getDni(){
            return $this->dni;
        }
        
        public function getTelefono(){
            return $this->telefono;
        }

        abstract public function mostrarDatos();
    }