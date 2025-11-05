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
Descritivo: Modelo para a tabela de pratos.            
*******************************************************************************/
class Prato {
    private $conn;
    private $table_name = "pratos";

    public $id;
    public $nome;
    public $preparo;
    public $tempo;
    public $proteina_id;
    public $proteina_nome;

    public function __construct($db){
        $this->conn = $db;
    }

    // Usado para ler pratos
    function read(){
        $query = "SELECT
                    c.nome as proteina_nome, p.id, p.nome, p.preparo, p.tempo, p.proteina_id
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        proteina c
                            ON p.proteina_id = c.id
                ORDER BY
                    p.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Usado para criar prato
    function create(){
        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome, tempo=:tempo, preparo=:preparo, proteina_id=:proteina_id";
        $stmt = $this->conn->prepare($query);

        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->tempo=htmlspecialchars(strip_tags($this->tempo));
        $this->preparo=htmlspecialchars(strip_tags($this->preparo));
        $this->proteina_id=htmlspecialchars(strip_tags($this->proteina_id));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":tempo", $this->tempo);
        $stmt->bindParam(":preparo", $this->preparo);
        $stmt->bindParam(":proteina_id", $this->proteina_id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Usado para ler um único prato
    function readOne(){
        $query = "SELECT
                    c.nome as proteina_nome, p.id, p.nome, p.preparo, p.tempo, p.proteina_id
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        proteina c
                            ON p.proteina_id = c.id
                WHERE
                    p.id = ?
                LIMIT
                    0,1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nome = $row["nome"];
        $this->preparo = $row["preparo"];
        $this->tempo = $row["tempo"];
        $this->proteina_id = $row["proteina_id"];
        $this->proteina_nome = $row["proteina_nome"];
    }

    // Usado para atualizar o prato
    function update(){
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    nome = :nome,
                    tempo = :tempo,
                    preparo = :preparo,
                    proteina_id = :proteina_id
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($query);

        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->tempo=htmlspecialchars(strip_tags($this->tempo));
        $this->preparo=htmlspecialchars(strip_tags($this->preparo));
        $this->proteina_id=htmlspecialchars(strip_tags($this->proteina_id));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":tempo", $this->tempo);
        $stmt->bindParam(":preparo", $this->preparo);
        $stmt->bindParam(":proteina_id", $this->proteina_id);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Usado para deletar o prato
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>
