<?php

namespace Controllers\Mantenimientos\Productos;

use Controllers\PublicController;
use Dao\Producto\Categorias as CategoriasDAO;
use Utilities\Site;
use Views\Renderer;

const LIST_URL = "index.php?page=Mantenimientos-Productos-Categorias";

class Categoria extends PublicController
{
    private array $viewData;
    private array $modes;
    public function __construct()
    {
        $this->modes = [
            "INS" => 'Creando Nueva Categoria',
            "UPD" => 'Modificando Categoria %s %s',
            "DEL" => 'Eliminando Categoria %s %s',
            "DSP" => 'Mostrando Detalle de %s %s'
        ];
        $this->viewData = [
            "id" => 0,
            "categoria" => "",
            "estado" => "ACT",
            "mode" => "",
            "modeDsc" => "",
            "estadoACT" => "",
            "estadoINA" => "",
            "estadoRTR" => "",
        ];
    }

    public function run(): void
    {
        $this->capturarModoPantalla();
        $this->datosdeDao();
        $this->prepararVista();
        Renderer::render("mnt/productos/categoria", $this->viewData);
    }
    private function throwError(string $message)
    {
        Site::redirectToWithMsg(LIST_URL, $message);
    }

    private function capturarModoPantalla()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->modes[$this->viewData["mode"]])) {
                $this->throwError("BAD REQUEST: No se puede procesar su solicitud");
            }
        }
    }
    private function datosdeDao()
    {
        if ($this->viewData["mode"] != "INS") {
            if (isset($_GET["id"])) {
                $this->viewData["id"] = intval($_GET["id"]);
                $categoria = CategoriasDAO::getCategoriasById($this->viewData["id"]);
                if (count($categoria) > 0) {
                    $this->viewData["categoria"] = $categoria["categoria"];
                    $this->viewData["estado"] = $categoria["estado"];
                } else {
                    $this->throwError("BAD REQUEST: No existe  el registro en la DB");
                }
            } else {
                $this->throwError("BAD REQUEST: No se puede extraer el registro de la DB");
            }
        }
    }
    private function prepararVista()
    {
        $this->viewData["modeDsc"] = sprintf(
            $this->modes[$this->viewData["mode"]],
            $this->viewData["categoria"],
            $this->viewData["id"]
        );
        $this->viewData["estado" . $this->viewData["estado"]] = 'selected';
    }
}
