<?php 

    abstract class Persona{
        protected $nombre;
        protected $apellido;
        protected $dni;
        protected $telefono;
        protected $correo;

        public function __construct($nombre, $apellido, $dni, $telefono, $correo){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->dni = $dni;
            $this->telefono = $telefono;
            $this->correo = $correo;
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

        public function getCorreo(){
            return $this->correo;
        }
        
        abstract public function mostrarDatos();
    }