<?php
session_start();
include_once('config.php');

// Habilitar exibição de erros (apenas para desenvolvimento)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (isset($_POST['matricula']) && isset($_POST['senha'])) {
    $matricula = trim($_POST['matricula']);
    $senha = trim($_POST['senha']);
    $id_computador = $_SERVER['REMOTE_ADDR']; // Identificação do computador, pode ser melhorado

    // Verifica se os campos não estão vazios
    if (empty($matricula) || empty($senha)) {
        $_SESSION['error'] = "Campos não preenchidos.";
        header('Location: home.php');
        exit;
    }

    // Prepara a consulta SQL para verificar as credenciais
    $sql = "SELECT * FROM alunos WHERE matricula = ? AND senha = ?";
    
    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param('ss', $matricula, $senha);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Credenciais válidas, registra o login
                $_SESSION['matricula'] = $matricula;

                // Insere um novo registro de login na tabela historico_logins
                $sql_insert = "INSERT INTO historico_logins (matricula, id_computador, tempo_login) 
                               VALUES (?, ?, NOW())";
                if ($stmt_insert = $conexao->prepare($sql_insert)) {
                    $stmt_insert->bind_param('ss', $matricula, $id_computador);
                    $stmt_insert->execute();
                    $stmt_insert->close();
                } else {
                    $_SESSION['error'] = "Erro ao registrar o login: " . $conexao->error;
                }

                // Redireciona para a página de regras
                header('Location: regras.php');
                exit;
            } else {
                $_SESSION['error'] = "Credenciais inválidas.";
            }
        } else {
            $_SESSION['error'] = "Erro ao executar a consulta: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Erro na preparação da consulta: " . $conexao->error;
    }

    // Redireciona de volta à página inicial com erro
    header('Location: home.php');
    exit;
} else {
    $_SESSION['error'] = "Campos não preenchidos.";
    header('Location: home.php');
    exit;
}

$conexao->close();
?>
