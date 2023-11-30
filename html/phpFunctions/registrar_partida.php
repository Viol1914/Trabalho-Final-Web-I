<?php
require "../php/db_functions.php";
require "../php/authenticate.php";

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados enviados via POST
    $gameId = $_POST['gameId'];
    $score = $_POST['score'];
    $date = $_POST['date'];

    // Obtém o ID do usuário logado
    $user_id = $_SESSION["user_id"];

    // Conecta ao banco de dados
    $conexao = connect_db();

    // Verifica a participação em ligas
    $sqlParticipaLigas = "SELECT league_id FROM user_league WHERE user_id = '$user_id'";
    $resultadoParticipaLigas = $conexao->query($sqlParticipaLigas);

    if ($resultadoParticipaLigas) {
        while ($row = $resultadoParticipaLigas->fetch_assoc()) {
            $liga_id = $row['league_id'];

            // Registra a pontuação na tabela league_scores
            $sqlRegistrarPontuacaoLiga = "INSERT INTO league_scores (league_id, user_id, total_score) 
                                          VALUES ('$liga_id', '$user_id', '$score') 
                                          ON DUPLICATE KEY UPDATE total_score = total_score + '$score'";

            if (!$conexao->query($sqlRegistrarPontuacaoLiga)) {
                echo "Erro ao registrar pontuação na liga: " . $conexao->errno . " - " . $conexao->error;
            }
        }
    } else {
        echo "Erro ao verificar a participação em ligas: " . $conexao->errno . " - " . $conexao->error;
    }

    // Prepara e executa a consulta SQL para inserir os dados na tabela matches
    $sqlRegistrarPartida = "INSERT INTO matches (user_id, score, match_date) VALUES ('$user_id', '$score', '$date')";

    if ($conexao->query($sqlRegistrarPartida) === TRUE) {
        echo "Partida registrada com sucesso!";
    } else {
        echo "Erro ao registrar a partida: " . $conexao->errno . " - " . $conexao->error;
    }

    // Fecha a conexão com o banco de dados
    disconnect_db($conexao);
} else {
    // Se a requisição não for do tipo POST, retorna um erro
    http_response_code(405); // Método não permitido
    echo "Método não permitido";
}
?>