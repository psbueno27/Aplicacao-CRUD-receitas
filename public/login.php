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
    
Data: 5 de novembro de 2025
Descritivo: Ponto para entrada do ambiente de login.              
*******************************************************************************/
    session_start();
    include_once __DIR__ . '/../config/database.php'; // caminho pro seu database.php

    $mensagem = '';
    $mensagem1 = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email_login = $_POST['email'] ?? '';
            $senha_login = $_POST['senha'] ?? '';

        // Conecta ao banco
        $database = new Database();
        $conn = $database->getConnection();

        // Busca o usuário pelo email
        $query = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email_login);
        $stmt->execute();

        // Se encontrou o usuário
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica a senha usando password_verify
            if (password_verify($senha_login, $usuario['senha'])) {
                // Cria a sessão real do usuário
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_email'] = $usuario['email'];

                header("Location: index.php");
                exit;
            } else {
                $mensagem = 'Senha incorreta. Tente novamente.';
            }
        } else {
            $mensagem = 'Usuário não cadastrado. Por favor, cadastre-se primeiro.';
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Login</title>
    <link rel="stylesheet" href="/CRUD%20trabalho/public/css/styles_log.css">
</head>
<body>
    <main>
        <div class="login">
            <h1>Login</h1><br><br>
            <form method="POST" action="login.php">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required><br>

                <a href="cadastrof.php">Cadastre-se</a><br><br>

                <input type="submit" class="button" value="Entrar">
            </form>
            <p class="mensagem"><?php echo $mensagem1; ?></p>
            <p class="mensagem"><?php echo $mensagem; ?></p>
        </div>
    </main>
</body>

</html>


