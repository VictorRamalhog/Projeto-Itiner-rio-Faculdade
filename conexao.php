<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "dbprojeto");

// Verifica se há erro de conexão
if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

// Recebendo os dados do formulário com segurança
$nome = $_POST["nome"];
$TipoDeReporte = $_POST["TipoDeReporte"];
$OBS = $_POST["OBS"];

// Preparando a consulta SQL para evitar SQL Injection
$estadosql = $conn->prepare("INSERT INTO sac (nome, TipoDeReporte, OBS) VALUES (?, ?, ?)");
$estadosql->bind_param("sss", $nome, $TipoDeReporte, $OBS); // "sss" corresponde a 3 strings

// Executa a consulta
$estadosql->execute();

// Fecha a consulta e a conexão
$estadosql->close();
$conn->close();

// Redirecionamento com um loop de atualização após 5 segundos
echo '<html>
<head>
    <meta http-equiv="refresh" content="5;url=denuncias.html" />
</head>
<body>
    <p>Dados inseridos com sucesso! Você será redirecionado para o formulário em 5 segundos.</p>
</body>
</html>';
?>
