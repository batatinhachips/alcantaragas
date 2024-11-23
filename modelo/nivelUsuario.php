<?php

class NivelUsuario {
    private $idNivelUsuario;
    private $nivel;

    public function __construct($idNivelUsuario, $nivel) {
        $this->idNivelUsuario = $idNivelUsuario;
        $this->nivel = $nivel;
    }

    // Getters e Setters
    public function getIdNivelUsuario() {
        return $this->idNivelUsuario;
    }

    public function setIdNivelUsuario($idNivelUsuario) {
        $this->idNivelUsuario = $idNivelUsuario;
    }

    public function getNivel() {
        return $this->nivel;
    }

    public function setNivel($nivel) {
        $this->nivel = $nivel;
    }
}