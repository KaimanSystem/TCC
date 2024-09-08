<?php
session_start();
require('fpdf/fpdf.php');
require('config.php'); // Inclua o arquivo de conexão

// Função para gerar o relatório em PDF
function gerarPDF($conexao) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14); // Tamanho da fonte maior para o título

     // Título do documento
    $pdf->Cell(0, 10, utf8_decode('Relatório de Usuários'), 0, 1, 'C');
    $pdf->Ln(10); // Adiciona um espaço após o título

    // Calcula a largura total da tabela
    $tableWidth = 15 + 55 + 50 + 60 + 30;
    $pageWidth = $pdf->GetPageWidth();
    $marginX = ($pageWidth - $tableWidth) / 2;

    // Posiciona a tabela no centro
    $pdf->SetX($marginX);

    // Cabeçalhos das colunas
    $pdf->SetFont('Arial', 'B', 12); // Aumentar a fonte dos cabeçalhos
    $pdf->Cell(15, 12, 'ID', 1);
    $pdf->Cell(55, 12, utf8_decode('Nome'), 1);
    $pdf->Cell(50, 12, utf8_decode('Matrícula'), 1);
    $pdf->Cell(60, 12, utf8_decode('Email'), 1);
    $pdf->Cell(30, 12, utf8_decode('Senha'), 1);
    $pdf->Ln();

    // Dados dos usuários
    $pdf->SetFont('Arial', '', 10);
    $sql = "SELECT id, nome, matricula, email, senha FROM usuários";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pdf->SetX($marginX); // Centraliza cada linha de dados
            $pdf->Cell(15, 10, $row['id'], 1);
            $pdf->Cell(55, 10, utf8_decode($row['nome']), 1);
            $pdf->Cell(50, 10, utf8_decode($row['matricula']), 1);
            $pdf->Cell(60, 10, utf8_decode($row['email']), 1);
            // Esconder a senha real
            $pdf->Cell(30, 10, '******', 1);
            $pdf->Ln();
        }
    } else {
        $pdf->Cell(0, 10, utf8_decode('Nenhum usuário encontrado.'), 0, 1, 'C');
    }

    // Saída do PDF
    $pdf->Output('D', 'relatorio_usuarios.pdf'); // 'D' força o download do PDF
    exit();
}

// Verifica se o botão de gerar PDF foi clicado
if (isset($_POST['gerar_pdf'])) {
    gerarPDF($conexao);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha de Funções | Kaiman System</title>
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        @import url('https://fonts.cdnfonts.com/css/bebas-neue');

        body {
            font-family: 'Bebas Neue', sans-serif;
            background-image: linear-gradient(to top, #92e06e, #3a6925);
            text-align: center;
            color: #ffffff;
            margin: 0;
            height: 100vh; 
            display: flex;
            flex-direction: column;
            justify-content: center;
        } 
        .box {
            position: relative;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 80%;
            max-width: 500px;

            margin: 0 auto; /* Center horizontally */
        }
        a {
            text-decoration: none;
            color: white;
            border: 3px solid #568915;
            border-radius: 15px;
            padding: 10px;
            margin: 0 10px;
            display: block;
            margin-bottom: 10px;
        }
        a:hover {
            background-color: #568915;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Escolha o Tipo de Função</h1>
        <br>
        <a href="relatorio_comunidade.php">Relatorio | Comunidade </a>
        <a href="relatorio_aluno.php">Relatorio | Alunos</a>
        <a href="edit_dados.php">Auditoria de dados</a>
    </div>
</body>
</html>
