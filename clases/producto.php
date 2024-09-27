<?php
class Producto {
    private $nombre;
    private $precio;

    public function __construct($nombre, $precio) {
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }
}

// $productos = [
//     new Producto("Coca-Cola 1L", 5.00),
//     new Producto("Doritos", 2.00),
//     new Producto("Inca Kola 1L", 3.00),
//     new Producto("Agua 500ml", 1.80),
//     new Producto("Cifrut", 1.80),
//     new Producto("Galletas Casino", 1.80),
//     new Producto("Chocolate", 2.00),
// ];