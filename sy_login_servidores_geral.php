<?php
session_start();
include_once('config.php');

if (isset($_POST['matricula']) && isset($_POST['senha'])) {
    $matricula = $_POST['matricula'];
    $senha = $_POST['senha'];

    // Verifica se os campos não estão vazios
    if (empty($matricula) || empty($senha)) {
        $_SESSION['error'] = "Campos não preenchidos.";
        header('Location: home.php');
        exit;
    }

    // Prepara a consulta SQL para evitar SQL Injection
    $sql = "SELECT * FROM servidores_geral WHERE matricula = ? AND senha = ?";
    
    if ($stmt = $conexao->prepare($sql)) {
        // Associa os parâmetros e executa a consulta 
        $stmt->bind_param('ss', $matricula, $senha);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Usuário encontrado no banco de dados
                $_SESSION['matricula'] = $matricula;

                // Redireciona para a página regras.php
                header('Location: regras.php');
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
