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
Descritivo: Formulário para a criação de pratos.              
*******************************************************************************/
include_once __DIR__ . '/../../controllers/PratoController.php';

$controller = new PratoController();
$proteinas_stmt = $controller->getProteinas();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preparo = $_POST['preparo'];
    $tempo = $_POST['tempo'];
    $proteina_id = $_POST['proteina_id'];

    if ($controller->create($nome, $preparo, $tempo, $proteina_id)) {
        header('Location: /CRUD%20trabalho/public/index.php?page=pratos');
        exit();
    } else {
        echo "<p class='error'>Não foi possível criar o prato.</p>";
    }
}

include __DIR__ . '/../../views/includes/header.php';
?>

<h2>Criar Prato</h2>

<form action="/CRUD%20trabalho/public/index.php?page=pratos&action=create" method="POST">
    <label for="nome">Nome do Prato:</label>
    <input type="text" id="nome" name="nome" required>

    <label for="preparo">Preparo:</label>
    <textarea id="preparo" name="preparo"></textarea>

    <label for="tempo">Tempo:</label>
    <input type="text" id="tempo" name="tempo" step="0.01" required>

    <label for="proteina_id">Proteina:</label>
    <select id="proteina_id" name="proteina_id" required>
        <?php
        while ($proteina = $proteinas_stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value=\"" . $proteina['id'] . "\">" . $proteina['nome'] . "</option>";
        }
        ?>
    </select>

    <button type="submit" class="button">Salvar</button>
    <a href="/CRUD%20trabalho/public/index.php?page=pratos" class="button">Cancelar</a>
</form>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
