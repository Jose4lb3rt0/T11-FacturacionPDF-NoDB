<?php

    require_once 'persona.php';

    Class Cliente extends Persona {

        public function __construct($nombre, $apellido, $dni, $telefono, $correo){
            parent::__construct($nombre, $apellido, $dni, $telefono, $correo);    
        }

        public function mostrarDatos() { ///////////////////
            echo "Cliente: {$this->getNombre()} {$this->getApellido()} {$this->getDni()} {$this->getTelefono()} {$this->getCorreo()}";
        }

    }

    $persona = new Cliente("h","sdsd","sdsd","sdsd", "hola@gmail.com");

    // $persona->mostrarDatos();