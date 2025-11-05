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
Descritivo: Formulário para a criação de proteinas.               
*******************************************************************************/
include_once __DIR__ . '/../../controllers/ProteinaController.php';

$controller = new ProteinaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    if ($controller->create($nome)) {
        header('Location: /CRUD%20trabalho/public/index.php?page=proteinas');
        exit();
    } else {
        echo "<p class='error'>Não foi possível criar a proteina.</p>";
    }
}

include __DIR__ . '/../../views/includes/header.php';
?>

<h2>Criar Proteina</h2>

<form action="/CRUD%20trabalho/public/index.php?page=proteinas&action=create" method="POST">
    <label for="nome">Nome da Proteina:</label>
    <input type="text" id="nome" name="nome" required>
    <button type="submit" class="button">Salvar</button>
    <a href="/CRUD%20trabalho/public/index.php?page=proteinas" class="button">Cancelar</a>
</form>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
