<?php
session_start();
require('fpdf/fpdf.php');
require('config.php');

function gerarPDF($conexao, $date, $period) {
    $pdf = new FPDF('L'); // 'L' para paisagem
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, utf8_decode('Relatório dos Alunos'), 0, 1, 'C');
    $pdf->Ln(10);

    // Define os horários com base no período
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

    // Consulta para buscar dados dos alunos, incluindo curso e horários de login e logout
    $sql = "SELECT a.id, a.nome, a.matricula, a.email, a.curso, h.tempo_login, 
            DATE_SUB(h.tempo_logout, INTERVAL 1 DAY) AS tempo_logout_sub, 
            ADDTIME(DATE_SUB(h.tempo_logout, INTERVAL 1 DAY), '20:00:00') AS tempo_logout_final
            FROM alunos AS a 
            JOIN historico_logins AS h ON a.matricula = h.matricula 
            WHERE DATE(h.tempo_login) = ? 
            AND TIME(h.tempo_login) BETWEEN ? AND ?";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('sss', $date, $start_time, $end_time);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cabeçalhos da tabela
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(15, 12, 'ID', 1);
    $pdf->Cell(55, 12, utf8_decode('Nome'), 1);
    $pdf->Cell(40, 12, utf8_decode('Matrícula'), 1);
    $pdf->Cell(30, 12, utf8_decode('Curso'), 1);
    $pdf->Cell(34, 12, utf8_decode('Entrada'), 1);
    $pdf->Cell(34, 12, utf8_decode('Saída'), 1);
    $pdf->Cell(60, 12, utf8_decode('Email'), 1);
    $pdf->Ln();

    // Dados dos alunos
    $pdf->SetFont('Arial', '', 10);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(15, 10, $row['id'], 1);
            $pdf->Cell(55, 10, utf8_decode($row['nome']), 1);
            $pdf->Cell(40, 10, utf8_decode($row['matricula']), 1);
            $pdf->Cell(30, 10, utf8_decode($row['curso']), 1);
            $pdf->Cell(34, 10, $row['tempo_login'], 1);
            $pdf->Cell(34, 10, $row['tempo_logout_final'], 1); // Exibe o tempo_logout final
            $pdf->Cell(60, 10, utf8_decode($row['email']), 1);
            $pdf->Ln();
        }
    } else {
        $pdf->Cell(0, 10, utf8_decode('Nenhum usuário encontrado.'), 0, 1, 'C');
    }

    // Saída do PDF
    $pdf->Output('D', 'relatorio_alunos.pdf');
    exit();
}

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
        <form action="relatorio_aluno.php" method="POST">
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
