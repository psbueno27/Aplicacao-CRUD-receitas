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
Descritivo: Ponto para entrada da aplicação.              
*******************************************************************************/
$page = isset($_GET["page"]) ? $_GET["page"] : "pratos";
$action = isset($_GET["action"]) ? $_GET["action"] : "index";
$id = isset($_GET["id"]) ? $_GET["id"] : null;

switch ($page) {
    case "pratos":
        switch ($action) {
            case "index":
                include __DIR__ . '/../views/pratos/index_prat.php';
                break;
            case "create":
                include __DIR__ . '/../views/pratos/create_prat.php';
                break;
            case "edit":
                include __DIR__ . '/../views/pratos/edit_prat.php';
                break;
            case "delete":
                include_once __DIR__ . '/../controllers/PratoController.php';
                $controller = new PratoController();
                if ($controller->delete($id)) {
                    header("Location: /CRUD%20trabalho/public/index.php?page=pratos");
                    exit();
                } else {
                    echo "<p class=\'error\'>Não foi possível deletar o prato.</p>";
                }
                break;
            default:
                include __DIR__ . '/../views/pratos/index_prat.php';
                break;
        }
        break;
    case "proteinas":
        switch ($action) {
            case "index":
                include __DIR__ . '/../views/proteinas/index_prot.php';
                break;
            case "create":
                include __DIR__ . '/../views/proteinas/create_prot.php';
                break;
            case "edit":
                include __DIR__ . '/../views/proteinas/edit_prot.php';
                break;
            case "delete":
                include_once __DIR__ . '/../controllers/ProteinaController.php';
                $controller = new ProteinaController();
                if ($controller->delete($id)) {
                    header("Location: /CRUD%20trabalho/public/index.php?page=proteinas");
                    exit();
                } else {
                    echo "<p class=\'error\'>Não foi possível deletar a proteina.</p>";
                }
                break;
            default:
                include __DIR__ . '/../views/proteinas/index_prot.php';
                break;
        }
        break;
    default:
        include __DIR__ . '/../views/pratos/index_prat.php';
        break;
}

?>
