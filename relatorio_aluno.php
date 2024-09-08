<?php
session_start();
require('fpdf/fpdf.php');
require('config.php'); // Inclua o arquivo de conexão

// Função para gerar o relatório em PDF
function gerarPDF($conexao, $date, $period) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14); // Tamanho da fonte maior para o título

    // Título do  documento
    $pdf->Cell(0, 10, utf8_decode('Relatório dos Alunos'), 0, 1, 'C');
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

    // Definir horários com base no período
    switch ($period) {
        case 'matutino':
            $start_time = '06:00:00';
            $end_time = '12:00:00';
            break;
        case 'vespertino':
            $start_time = '12:00:00';
            $end_time = '18:00:00';
            break;
        case 'noturno':
            $start_time = '18:00:00';
            $end_time = '23:59:59';
            break;
        default:
            $start_time = '00:00:00';
            $end_time = '23:59:59';
            break;
    }

    // Dados dos usuários filtrados
    $pdf->SetFont('Arial', '', 10);
    $sql = "SELECT id, nome, matricula, email, senha 
            FROM alunos 
            WHERE DATE(tempo_login) = ? 
            AND TIME(tempo_login) BETWEEN ? AND ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('sss', $date, $start_time, $end_time);
    $stmt->execute();
    $result = $stmt->get_result();

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
    $pdf->Output('D', 'relatorio_alunos.pdf'); // 'D' força o download do PDF
    exit();
}

// Verifica se o botão de gerar PDF foi clicado e se os parâmetros de filtro foram enviados
if (isset($_POST['gerar_pdf'])) {
    $date = $_POST['date'];
    $period = $_POST['period'];
    gerarPDF($conexao, $date, $period);
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
            background-color: #ffffff;
            padding: 40px; 
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px; 
            max-width: 90%;
        }

        /* Estilo do título */
        h1 {
            font-family: 'Bebas Neue', cursive;
            font-size: 32px;
            margin: 0 0 20px;
            color: #333;
            text-align: center; 
            white-space: nowrap; 
            overflow: hidden; 
            text-overflow: ellipsis; 
        }

        /* Estilo dos campos do formulário */
        label {
            display: block;
            font-size: 16px;
            margin: 10px 0 5px;
            color: #555;
        }

        input[type="date"], select {
            width: calc(100% - 20px);
            padding: 12px; /* Aumenta o padding dos campos */
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        /* Estilo do botão */
        input[type="submit"] {
            font-family: 'Bebas Neue', cursive;
            font-size: 18px;
            background-color: #829d5e;
            color: white;
            border: none;
            padding: 14px 20px; /* Aumenta o padding do botão */
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
        <h1>Gerar Relatório | Alunos</h1>
        <form action="gerar_relatorio.php" method="POST">
            <label for="date">Data:</label>
            <input type="date" id="date" name="date" required>
            <label for="period">Período:</label>
            <select id="period" name="period">
                <option value="matutino">Matutino</option>
                <option value="vespertino">Vespertino</option>
                <option value="noturno">Noturno</option>
            </select>
            <input type="submit" name="gerar_pdf" value="Gerar PDF">
        </form>
    </div>
</body>
</html>




