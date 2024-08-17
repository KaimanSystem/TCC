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
    $sql = "SELECT id, nome, cpf, email, senha FROM comunidade";
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
        /* Estilos gerais */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-image: linear-gradient(to bottom, #f0f4f8, #c6d5d8);
}

/* Estilo do contêiner principal */
.container {
    background-color: #ffffff;
    padding: 60px; /* Aumenta o padding */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 500px; /* Aumenta a largura do contêiner */
    max-width: 90%;
}

/* Estilo do título */
h1 {
    font-family: 'Bebas Neue', cursive;
    font-size: 30px; /* Aumenta o tamanho da fonte */
    margin: 0 0 30px; /* Ajusta a margem */
    color: #333;
    text-align: center; /* Centraliza o título */
    white-space: nowrap; /* Impede a quebra de linha */
    overflow: hidden; /* Oculta qualquer texto que exceda o contêiner */
    text-overflow: ellipsis; /* Adiciona reticências se o texto for muito longo */
}

/* Estilo dos campos do formulário */
label {
    display: block;
    font-size: 15px; /* Aumenta o tamanho da fonte */
    margin: 12px 0 6px; /* Ajusta a margem */
    color: #555;
}

input[type="date"], select {
    width: calc(100% - 20px);
    padding: 14px; /* Aumenta o padding dos campos */
    border-radius: 5px;
    border: 1px solid #ddd;
    margin-bottom: 20px; /* Aumenta o espaçamento entre os campos */
    box-sizing: border-box;
}

/* Estilo do botão */
input[type="submit"] {
    font-family: 'Bebas Neue', cursive;
    font-size: 15px; /* Aumenta o tamanho da fonte */
    background-color: #829d5e;
    color: white;
    border: none;
    padding: 16px 24px; /* Aumenta o padding do botão */
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
    width: 100%;
    box-sizing: border-box;
}

input[type="submit"]:hover {
    background-color: #6d834f;
    transform: translateY(-2px);
}

input[type="submit"]:active {
    background-color: #5a6b4f;
    transform: translateY(0);
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