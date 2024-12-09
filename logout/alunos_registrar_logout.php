<?php
session_start();
include_once('config.php');

// Verificar se o tempo de logout foi enviado
if (isset($_POST['matricula'])) {
    $matricula = $_POST['matricula'];
    $tempo_logout = date('Y-m-d H:i:s');

     // Atualizar o tempo de logout no banco de dados
    $sql = "UPDATE alunos SET tempo_logout = ? WHERE matricula = ?";
    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param('ss', $tempo_logout, $matricula);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Erro na atualização do tempo de logout: " . $conexao->error;
    }
}
?>
