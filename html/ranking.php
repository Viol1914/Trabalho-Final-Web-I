<?php
require "php/force_authenticate.php";
require "php/db_functions.php";

$conexao = connect_db();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/ranking.css">
    <title>Ranking da Liga</title>
</head>

<body>
    <div class="content">
        <div>
            <?php
            if (isset($_GET['liga_id'])) {
                $liga_id = $_GET['liga_id'];


                $sqlNomeLiga = "SELECT league_name FROM leagues WHERE league_id = $liga_id";
                $resultadoNomeLiga = $conexao->query($sqlNomeLiga);

                if ($resultadoNomeLiga) {
                    $linhaNomeLiga = $resultadoNomeLiga->fetch_assoc();
                    $nomeLiga = $linhaNomeLiga['league_name'];

                    echo '<h2 id="rankingtitulo">Ranking da Liga - ' . htmlspecialchars($nomeLiga) . '</h2>';
                } else {
                    echo 'Erro ao obter o nome da liga: ' . $conexao->error;
                }

            }
            ?>
            <div class="código"></div>
        </div>
        <div class="container" id="rankingcontainer">
            <?php
            if (isset($_GET['liga_id'])) {
                $liga_id = $_GET['liga_id'];

                $sqlRankingLiga = "SELECT u.username,
                                          COALESCE(SUM(ls.total_score), 0) as total_score,
                                          COALESCE(SUM(CASE WHEN ls.creation_date >= (NOW() - INTERVAL 7 DAY) THEN ls.total_score ELSE 0 END), 0) as weekly_score
                                   FROM users u
                                   LEFT JOIN league_scores ls ON u.user_id = ls.user_id AND ls.league_id = $liga_id
                                   LEFT JOIN user_league ul ON u.user_id = ul.user_id AND ul.league_id = $liga_id
                                   GROUP BY u.username
                                   ORDER BY total_score DESC";

                $resultadoRankingLiga = $conexao->query($sqlRankingLiga);

                if ($resultadoRankingLiga) {
                    echo '<div class="código"><ol>';
                    while ($linha = $resultadoRankingLiga->fetch_assoc()) {
                        echo '<li>' . $linha['username'] . ' - Pontuação Total: ' . $linha['total_score'] . ' - Pontuação Semanal: ' . $linha['weekly_score'] . '</li>';
                    }
                    echo '</ol></div>';
                } else {
                    echo 'Erro ao obter o ranking da liga: ' . $conexao->error;
                }

                disconnect_db($conexao);
            } else {
                echo "Parâmetro liga_id ausente na URL";
            }
            ?>
        </div>
    </div>
</body>

</html>
