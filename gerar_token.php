<?php
include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $safe_key = $_POST['safe_key'];

     // Verificar se o e-mail e a chave de segurança estão no banco de dados
    $sql = "SELECT safe_key FROM alunos WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($db_safe_key);
    $stmt->fetch();
    $stmt->close();

    if ($db_safe_key) {
        // Verificar se a chave de segurança fornecida corresponde à chave armazenada
        if ($safe_key === $db_safe_key) {
            // Gerar token e link para redefinição de senha
            $token = bin2hex(random_bytes(16));
            $link = "http://localhost/Projeto/resetar_senha.php?token=$token";

            // Atualizar token no banco de dados
            $sql = "UPDATE alunos SET token_recuperacao = ?, data_token = NOW() WHERE email = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param('ss', $token, $email);
            $stmt->execute();
            $stmt->close();

            echo "Você pode redefinir sua senha <a href='$link'>aqui</a>.";
        } else {
            echo "Chave de segurança incorreta.";
        }
    } else {
        echo "E-mail não encontrado.";
    }
}
?>

