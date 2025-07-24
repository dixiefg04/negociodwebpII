<?php

namespace Controllers\Academic;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Producto\Productos;
use Dao\Carros\Carros as CarrosDAO;

class About extends PublicController
{
    private string $HolaMessage;
    public function run(): void
    {
        $productos = Productos::obtenerProductos();
        $this->HolaMessage = "Hola esto es un nuevo controlador";
        $carros = CarrosDAO::obtenerCarros();
        Renderer::render("Academic/about", [
            "mensaje" => $this->HolaMessage,
            "productos" => $productos,
            "carros" => $carros,
        ]);
    }
}
