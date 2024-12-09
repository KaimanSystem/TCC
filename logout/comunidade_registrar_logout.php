<?php
session_start();
include_once('config.php');

// Verificar se a sessão está definida para 'cpf'
if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];
    $tempo_logout = date('Y-m-d H:i:s');

    // Atualizar o tempo de logout no banco de dados
    $sql = "UPDATE comunidade SET tempo_logout = ? WHERE cpf = ?";
    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param('ss', $tempo_logout, $cpf);
        $stmt->execute();
        $stmt->close();
    }

     // Limpar a sessão
    session_unset();
    session_destroy();
}

header('Location: login_comunidade.php');
exit;
?>
