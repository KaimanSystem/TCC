<?php
session_start();
include_once('config.php'); // Inclua a conexão com o banco de dados

if (isset($_POST['tempoTotal']) && isset($_SESSION['matricula'])) {
    $tempoTotal = mysqli_real_escape_string($conexao, $_POST['tempoTotal']);
    $matricula = mysqli_real_escape_string($conexao, $_SESSION['matricula']);

    //  Atualize o tempo de logout no banco de dados
    $sql = "UPDATE `usuários` 
            SET tempo_logout = NOW(), 
                tempo_login = TIME_TO_SEC(TIMEDIFF(NOW(), tempo_login)) + TIME_TO_SEC('$tempoTotal') 
            WHERE matricula = '$matricula'";

    if (mysqli_query($conexao, $sql)) {
        // Se a atualização for bem-sucedida, finalize a sessão
        unset($_SESSION['matricula']);
        unset($_SESSION['senha']);
        header('Location: home.php');
        exit();
    } else {
        // Em caso de erro na atualização
        echo "Erro ao registrar o tempo de logout: " . mysqli_error($conexao);
    }
} else {
    // Se o tempo total ou matrícula não estiver definido
    header('Location: home.php');
    exit();
}
?>
