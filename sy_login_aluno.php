<?php
session_start();
include_once('config.php');

// Habilitar exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['matricula']) && isset($_POST['senha'])) {
    $matricula = $_POST['matricula'];
    $senha = $_POST['senha'];
    $id_computador = $_SERVER['REMOTE_ADDR']; //  Exemplo de identificação do computador, ID fixo ou um identificador diferente

    if (empty($matricula) || empty($senha)) {
        $_SESSION['error'] = "Campos não preenchidos.";
        header('Location: home.php');
        exit;
    }

    $sql = "SELECT * FROM alunos WHERE matricula = ? AND senha = ?";
    
    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param('ss', $matricula, $senha);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $_SESSION['matricula'] = $matricula;
                // Registra o login
                $sql_update = "UPDATE alunos SET id_computador = ?, tempo_login = NOW() WHERE matricula = ?";
                if ($stmt_update = $conexao->prepare($sql_update)) {
                    $stmt_update->bind_param('ss', $id_computador, $matricula);
                    $stmt_update->execute();
                    $stmt_update->close();
                }
                header('Location: regras.php');
                exit;
            } else {
                $_SESSION['error'] = "Credenciais inválidas.";
                header('Location: home.php');
                exit;
            }
        } else {
            $_SESSION['error'] = "Erro ao executar a consulta: " . $stmt->error;
            header('Location: home.php');
            exit;
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Erro na preparação da consulta: " . $conexao->error;
        header('Location: home.php');
        exit;
    }
} else {
    $_SESSION['error'] = "Campos não preenchidos.";
    header('Location: home.php');
    exit;
}

$conexao->close();
?>
