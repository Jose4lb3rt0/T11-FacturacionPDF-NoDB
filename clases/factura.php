<?php

    require_once 'cliente.php';
    require_once 'producto.php';

    class Factura{
        private $cliente;
        private $productos = [];

        public function __construct(Cliente $cliente){
            $this->cliente = $cliente;
        }

        public function agregarProducto(Producto $producto, $cantidad){
            $this->productos[] = [
                'producto' => $producto,
                'cantidad' => $cantidad
            ];
        }

        public function getCliente() {
            return $this->cliente;
        }
    
        public function getProductos() {
            return $this->productos;
        }

        public function calcularTotal() {
            $total = 0;
            foreach ($this->productos as $item) {
                $total += $item['producto']->getPrecio() * $item['cantidad'];
            }
            return $total;
        }

        public function mostrarFactura(){
            echo $this->cliente->mostrarDatos();
            echo "Productos: <br>";
            foreach($this->productos as $producto){
                echo "Nombre: {$producto->getNombre()} Precio: {$producto->getPrecio()} <br>";
            }
            echo "Total: {$this->calcularTotal()} <br>";
        }
    }
