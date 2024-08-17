<?php
session_start();
include_once('config.php');

// Habilitar exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica se os campos 'cpf' e 'senha' foram enviados pelo formulário
if (isset($_POST['cpf']) && isset($_POST['senha'])) {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    // Adiciona uma verificação para garantir que os campos não estão vazios
    if (empty($cpf) || empty($senha)) {
        $_SESSION['error'] = "Campos não preenchidos.";
        header('Location: home.php');
        exit;
    }

    // Prepara a consulta SQL para evitar SQL Injection 
    $sql = "SELECT * FROM comunidade WHERE CPF = ? AND senha = ?";
    
    if ($stmt = $conexao->prepare($sql)) {
        // Associa os parâmetros e executa a consulta
        $stmt->bind_param('ss', $cpf, $senha);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Credenciais corretas
                $_SESSION['CPF'] = $cpf;
                header('Location: sistema.php');
                exit;
            } else {
                // Credenciais incorretas
                $_SESSION['error'] = "Credenciais inválidas.";
                header('Location: home.php');
                exit;
            }
        } else {
            // Erro ao executar a consulta
            $_SESSION['error'] = "Erro ao executar a consulta: " . $stmt->error;
            header('Location: home.php');
            exit;
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        // Erro na preparação da consulta
        $_SESSION['error'] = "Erro na preparação da consulta: " . $conexao->error;
        header('Location: home.php');
        exit;
    }
} else {
    // Campos não preenchidos
    $_SESSION['error'] = "Campos não preenchidos.";
    header('Location: home.php');
    exit;
}

// Fecha a conexão com o banco de dados
$conexao->close();
?>
