<?php
require "../php/db_functions.php";
require "../php/authenticate.php";

$conexao = connect_db();

if (!$conexao) {
    http_response_code(500); // Erro interno do servidor
    echo "Erro de conexão com o banco de dados: " . mysqli_connect_error();
    exit();
}

// Obtém o ID do usuário logado
$user_id = $_SESSION["user_id"];

// Consulta SQL para obter as ligas do usuário com a posição calculada dinamicamente
$sqlObterLigasUsuario = "
    SELECT l.league_id, l.league_name,
           (SELECT COUNT(*) + 1 FROM (
                SELECT ls.user_id, ls.league_id, SUM(ls.total_score) as total_score
                FROM league_scores ls
                WHERE ls.league_id = ul.league_id
                GROUP BY ls.user_id, ls.league_id
                HAVING total_score > (SELECT SUM(total_score) FROM league_scores WHERE user_id = $user_id AND league_id = ul.league_id)
           ) AS subquery) AS position
    FROM user_league ul
    JOIN leagues l ON ul.league_id = l.league_id
    WHERE ul.user_id = $user_id
    ORDER BY l.league_id";

$resultadoObterLigasUsuario = $conexao->query($sqlObterLigasUsuario);

if ($resultadoObterLigasUsuario) {
    // Retorna os dados como JSON
    $ligasUsuario = $resultadoObterLigasUsuario->fetch_all(MYSQLI_ASSOC);
    echo json_encode($ligasUsuario);
} else {
    http_response_code(500); // Erro interno do servidor
    echo "Erro ao obter as ligas do usuário: " . $conexao->error;
}

disconnect_db($conexao);
?>