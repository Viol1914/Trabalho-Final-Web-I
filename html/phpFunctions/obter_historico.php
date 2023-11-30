<?php
require "../php/db_functions.php";
require "../php/authenticate.php";

// Verifica se o usuário está autenticado


// Obtém o ID do usuário logado
$user_id = $_SESSION["user_id"];

// Conecta ao banco de dados
$conexao = connect_db();

// Verifica a conexão
if (!$conexao) {
    http_response_code(500); // Erro interno do servidor
    echo "Erro de conexão com o banco de dados: " . mysqli_connect_error();
    exit();
}

// Prepara e executa a consulta SQL para obter o histórico do jogador
$sql = "SELECT match_id, score, match_date as date FROM matches WHERE user_id = '$user_id' ORDER BY match_date DESC";

$resultado = $conexao->query($sql);

if ($resultado) {
    // Retorna os dados como JSON
    $historico = $resultado->fetch_all(MYSQLI_ASSOC);
    echo json_encode($historico);
} else {
    http_response_code(500); // Erro interno do servidor
    echo "Erro ao obter o histórico: " . $conexao->error;
}

// Fecha a conexão com o banco de dados
disconnect_db($conexao);
?>
