<?php
    session_start();

    include_once __DIR__ . '/../config/database.php';
    include_once __DIR__ . '/../models/Usuario.php';

    $database = new Database();
    $db = $database->getConnection();

    // Dados do formulário
    $nome = $_POST["nome"] ?? '';
    $email = $_POST["email"] ?? '';
    $senha = $_POST["senha"] ?? '';
    $mensagem = '';

    if ($nome && $email && $senha) {

        // Verifica se já existe o e-mail no banco
        $query = "SELECT id FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Usuário já cadastrado
            header("Location: cadastrof.php?ja_cadastrado=1");
            exit;
        } else {
            // Criptografa a senha e cadastra no banco
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            $query = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha_hash);

            if ($stmt->execute()) {
                // Cadastro feito com sucesso → redireciona pro login
                header("Location: login.php?cadastro_sucesso=1");
                exit;
            } else {
                // Erro ao cadastrar
                header("Location: cadastrof.php?erro=1");
                exit;
            }
        }

    } else {
        // Se faltou campo no formulário
        header("Location: cadastrof.php?campos_incompletos=1");
        exit;
    }
?>