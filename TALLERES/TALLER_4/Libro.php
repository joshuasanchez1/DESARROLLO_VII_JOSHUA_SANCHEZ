<?php
class Libro {
    public $titulo;
    public $autor;
    public $anioPublicacion;

    public function __construct($titulo, $autor, $anioPublicacion) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anioPublicacion = $anioPublicacion;
    }

    public function obtenerInformacion() {
        return "'{$this->titulo}' por {$this->autor}, publicado en {$this->anioPublicacion}";
    }
}

// Ejemplo de uso
$miLibro = new Libro("Supreme Magus", "Legion20", 2018);
echo $miLibro->obtenerInformacion();