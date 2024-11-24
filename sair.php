<?php
session_start();
include_once('config.php'); // Inclua a conexão com o banco de dados

if (isset($_SESSION['matricula'])) {
    $matricula = $_SESSION['matricula'];
    $tempo_logout = date('Y-m-d H:i:s');

    // Atualiza o registro de logout no banco de dados
    $sql = "UPDATE historico_logins 
            SET tempo_logout = ? 
            WHERE matricula = ? AND tempo_logout IS NULL ORDER BY tempo_login DESC LIMIT 1";

    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param('ss', $tempo_logout, $matricula);
        if ($stmt->execute()) {
            // Logout registrado com sucesso
        } else {
            $_SESSION['error'] = "Erro ao registrar o logout: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Erro na preparação do registro de logout: " . $conexao->error;
    }

    // Finaliza a sessão
    session_destroy();
    header("Location: home.php"); // Redireciona para a página inicial, ajuste conforme necessário
    exit();
} else {
    // Caso a matrícula não esteja na sessão
    header("Location: home.php");
    exit();
}
?>
