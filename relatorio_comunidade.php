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
    $pdf->Cell(0, 10, utf8_decode('Relatório da Comunidade'), 0, 1, 'C');
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
    $pdf->Cell(50, 12, utf8_decode('cpf'), 1);
    $pdf->Cell(60, 12, utf8_decode('Email'), 1);
    $pdf->Cell(30, 12, utf8_decode('Senha'), 1);
    $pdf->Ln();

    // Dados dos usuários
    $pdf->SetFont('Arial', '', 10);
    $sql = "SELECT id, nome, matricula, cpf, senha FROM comunidade";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pdf->SetX($marginX); // Centraliza cada linha de dados
            $pdf->Cell(15, 10, $row['id'], 1);
            $pdf->Cell(55, 10, utf8_decode($row['nome']), 1);
            $pdf->Cell(50, 10, utf8_decode($row['cpf']), 1);
            $pdf->Cell(60, 10, utf8_decode($row['email']), 1);
            // Esconder a senha real
            $pdf->Cell(30, 10, '******', 1);
            $pdf->Ln();
        }
    } else {
        $pdf->Cell(0, 10, utf8_decode('Nenhum usuário encontrado.'), 0, 1, 'C');
    }

    // Saída do PDF
    $pdf->Output('D', 'relatorio_Comunidade.pdf'); // 'D' força o download do PDF
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
    <title>Kaiman System | Admin</title>
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(to top, #92e06e, #3a6925);
        }

        /* Estilo do contêiner principal */
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        /* Estilo do título */
        h1 {
            font-family: 'Bebas Neue', cursive;
            font-size: 36px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Estilo do botão */
        input[type="submit"] {
            font-family: 'Bebas Neue', cursive;
            font-size: 18px;
            background-color: #829d5e;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #6d834f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gerar Relatório | Comunidade </h1>
        <form action="gerar_relatorio2.php" method="POST">
            <input type="submit" name="gerar_pdf" value="Gerar PDF">
        </form>
    </div>
</body>
</html>