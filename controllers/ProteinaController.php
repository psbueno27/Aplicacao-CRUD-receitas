<?php
/******************************************************************************
    Curso: Engenharia de Software
    Disciplina: Linguagem e Técnicas de Programacão
    Professor: Flores
    Turma: ESOFT-2A
    Componentes:
                Alef Luciano (RA: 25004652-2)
                Daniel de Souza (RA: 25143755-2)
                João Pedro (RA: 25168486-2)
                Juan Pablo (RA: 25181903-2)
                Pedro Bueno (RA: 25181992-2)
    
Data: 4 de novembro de 2025
Descritivo: Lógica de controle para as proteinas.               
*******************************************************************************/
include_once '../config/database.php';
include_once '../models/Proteina.php';

class ProteinaController {
    private $conn;
    private $tipodeproteina;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->tipodeproteina = new Proteina($this->conn);
    }

    public function index() {
        $stmt = $this->tipodeproteina->read();
        $num = $stmt->rowCount();
        return ['stmt' => $stmt, 'num' => $num];
    }

    public function create($nome) {
        $this->tipodeproteina->nome = $nome;
        if($this->tipodeproteina->create()) {
            return true;
        }
        return false;
    }

    public function readOne($id) {
        $this->tipodeproteina->id = $id;
        $this->tipodeproteina->readOne();
        return $this->tipodeproteina;
    }

    public function update($id, $nome) {
        $this->tipodeproteina->id = $id;
        $this->tipodeproteina->nome = $nome;
        if($this->tipodeproteina->update()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $this->tipodeproteina->id = $id;
        if($this->tipodeproteina->delete()) {
            return true;
        }
        return false;
    }
}
?>
