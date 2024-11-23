<?php

class NivelUsuarioRepositorio {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Cadastrar um novo nível de usuário
    public function cadastrar(NivelUsuario $nivelUsuario) {
        $nivel = $nivelUsuario->getNivel();

        $sql = "INSERT INTO nivelUsuarios (nivel) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $nivel);

        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    // Buscar todos os níveis de usuário
    public function buscarTodos() {
        $sql = "SELECT * FROM nivelUsuarios";
        $result = $this->conn->query($sql);

        $niveis = array();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nivel = new NivelUsuario(
                    $row['idNivelUsuario'],
                    $row['nivel']
                );
                $niveis[] = $nivel;
            }
        }

        return $niveis;
    }

    // Buscar nível de usuário por ID
    public function buscarPorId($idNivelUsuario) {
        $sql = "SELECT * FROM nivelUsuarios WHERE idNivelUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idNivelUsuario);

        $stmt->execute();
        $result = $stmt->get_result();

        $nivel = null;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nivel = new NivelUsuario(
                $row['idNivelUsuario'],
                $row['nivel']
            );
        }

        $stmt->close();
        return $nivel;
    }

    // Atualizar um nível de usuário
    public function atualizar(NivelUsuario $nivelUsuario) {
        $idNivelUsuario = $nivelUsuario->getIdNivelUsuario();
        $nivel = $nivelUsuario->getNivel();

        $sql = "UPDATE nivelUsuarios SET nivel = ? WHERE idNivelUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $nivel, $idNivelUsuario);

        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    // Excluir nível de usuário por ID
    public function excluir($idNivelUsuario) {
        $sql = "DELETE FROM nivelUsuarios WHERE idNivelUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idNivelUsuario);

        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }
}