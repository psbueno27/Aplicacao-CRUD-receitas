<?php
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../models/Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario->nome = $_POST["nome"];
    $usuario->email = $_POST["email"];
    $usuario->senha = $_POST["senha"];

    if ($usuario->cadastrar()) {
        header("Location: confirmacao.php?msg=sucesso");
        exit;
    } else {
        echo "<p style='color:red'>Erro ao cadastrar!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Cadastro</title>
    <link rel="stylesheet" href="/CRUD%20trabalho/public/css/styles_log.css">
</head>
<body>
    <div class="login">
    <h1>Cadastro</h1><br>
    
        <form method="POST" action="confirmacao.php">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br><br>

            <input type="submit" class="button" value="Cadastrar">
        </form>
        <p class="mensagem"><?php if (isset($_GET['ja_cadastrado'])) {
            echo $mensagem="Usuário já cadastrado!";
         } 
        ?></p>
    </div>    
        
</body>

</html>
