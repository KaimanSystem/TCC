<?php
session_start();
include_once('config.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se os campos não estão vazios
    if (empty($email) || empty($senha)) {
        $_SESSION['error'] = "Campos não preenchidos.";
        header('Location: home.php');
        exit;
    }

    // Prepara a consulta SQL para evitar SQL Injection
    $sql = "SELECT * FROM servidores WHERE email = ? AND senha = ?";
    
    if ($stmt = $conexao->prepare($sql)) {
        // Associa os parâmetros e executa a consulta 
        $stmt->bind_param('ss', $email, $senha);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Obtém os dados do usuário
                $user = $result->fetch_assoc();
                $_SESSION['email'] = $email;
                
                if ($user['is_admin'] == 1) {
                    // Usuário é um administrador
                    header('Location: funcao_servidores.php');
                } else {
                    // Usuário não é administrador
                    header('Location: home.php');
                }
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
