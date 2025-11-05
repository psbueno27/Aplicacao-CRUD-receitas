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
Descritivo: Lógica de controle para os pratos.             
*******************************************************************************/
include_once '../config/database.php';
include_once '../models/Prato.php';
include_once '../models/Proteina.php';

class PratoController {
    private $conn;
    private $prato;
    private $proteina;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->prato = new Prato($this->conn);
        $this->proteina = new Proteina($this->conn);
    }

    public function index() {
        $stmt = $this->prato->read();
        $num = $stmt->rowCount();
        return ['stmt' => $stmt, 'num' => $num];
    }

    public function create($nome, $preparo, $tempo, $proteina_id) {
        $this->prato->nome = $nome;
        $this->prato->preparo = $preparo;
        $this->prato->tempo = $tempo;
        $this->prato->proteina_id = $proteina_id;
        if($this->prato->create()) {
            return true;
        }
        return false;
    }

    public function readOne($id) {
        $this->prato->id = $id;
        $this->prato->readOne();
        return $this->prato;
    }

    public function update($id, $nome, $preparo, $tempo, $proteina_id) {
        $this->prato->id = $id;
        $this->prato->nome = $nome;
        $this->prato->preparo = $preparo;
        $this->prato->tempo = $tempo;
        $this->prato->proteina_id = $proteina_id;
        if($this->prato->update()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $this->prato->id = $id;
        if($this->prato->delete()) {
            return true;
        }
        return false;
    }

    public function getProteinas() {
        $stmt = $this->proteina->read();
        return $stmt;
    }
}
?>
