<?php

namespace Dao\Producto;

use Dao\Table;


class Productos extends Table
{
    public static function obtenerProductos(): array
    {
        return [
            [
                "id" => "001",
                "description" => "Producto 1",
                "precio" => 50,
                "estado" => "ACT",
                "stock" => 100
            ],
            [
                "id" => "002",
                "description" => "Producto 2",
                "precio" => 100.23,
                "estado" => "ACT",
                "stock" => 100
            ],
            [
                "id" => "003",
                "description" => "Producto 3",
                "precio" => 96.25,
                "estado" => "ACT",
                "stock" => 100
            ],

        ];
    }
}
