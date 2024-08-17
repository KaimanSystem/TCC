<?php
$dbHost = 'localhost'; // Endereço do servidor de banco de dados
$dbUsername = 'root'; // Nome de usuário do banco de dados
$dbPassword = ''; // Senha do banco de dados
$dbName = 'cadastro-gustavo'; // Nome do banco de dados

// Criação da conexão
$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Verificação de erros de conexão
if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}
?>  
 