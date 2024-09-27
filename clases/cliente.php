<?php

    require_once 'persona.php';

    Class Cliente extends Persona {

        public function __construct($nombre, $apellido, $dni, $telefono){
            parent::__construct($nombre, $apellido, $dni, $telefono);    
        }

        public function mostrarDatos() { ///////////////////
            echo "Cliente: {$this->getNombre()} {$this->getApellido()} {$this->getDni()} {$this->getTelefono()}<br>";
        }

    }

    $persona = new Cliente("h","sdsd","sdsd","sdsd");

    // $persona->mostrarDatos();