<?php
session_start();
include_once('config.php');

 // Dados do novo admin
$email = 'admin@example.com'; // Substitua pelo email desejado
$senha = 'admin123'; // Substitua pela senha desejada (certifique-se de usar uma senha segura e hash se possível)
$is_admin = 1; // Indica que é um admin

// Hash da senha (opcional, mas recomendado para segurança)
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO servidores (email, senha, is_admin) VALUES (?, ?, ?)";

if ($stmt = $conexao->prepare($sql)) {
    $stmt->bind_param('ssi', $email, $senha_hash, $is_admin);
    
    if ($stmt->execute()) {
        echo "Usuário admin adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar usuário admin: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Erro na preparação da consulta: " . $conexao->error;
}

$conexao->close();
?>
