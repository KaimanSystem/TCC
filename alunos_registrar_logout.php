<?php
session_start();
include_once('config.php'); 

if (isset($_SESSION['matricula'])) {
    $matricula = $_SESSION['matricula'];
    $tempo_logout = date('Y-m-d H:i:s'); // Gerar o tempo correto

    // Configure o timezone no MySQL
    $conexao->query("SET time_zone = 'America/Sao_Paulo'");

    // SQL para atualizar o logout
    $sql = "UPDATE historico_logins 
            SET tempo_logout = ? 
            WHERE matricula = ? AND tempo_logout IS NULL ORDER BY tempo_login DESC LIMIT 1";

    // Prepare a consulta
    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param('ss', $tempo_logout, $matricula);

        // Debug para verificar os valores enviados 
        error_log("SQL: $sql | Params: tempo_logout=$tempo_logout, matricula=$matricula");

        // Executa a consulta
        if ($stmt->execute()) {
            // Sucesso
        } else {
            error_log("Erro ao registrar o logout: " . $stmt->error);
        }
        $stmt->close();
    } else {
        error_log("Erro na preparação do registro de logout: " . $conexao->error);
    }

    // Finaliza a sessão e redireciona
    session_destroy();
    header("Location: login_aluno.php"); // Redireciona para a página de login, ajuste conforme necessário
    exit(); 
}
// Resolvendo conflitos e aplicando alterações no código
?>