<?php
require "php/force_authenticate.php";
require "php/db_functions.php";

$erroEntrarLiga = $erroCriarLiga = $erroPreenchimento = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_SESSION["user_id"];

    $conexao = connect_db();

    if (isset($_POST['entrarliga'])) {
        $codigoLiga = $_POST['codigoliga'];

        if (empty($codigoLiga)) {
            $erroEntrarLiga = "Por favor, preencha o código da liga.";
        } else {
            $sqlVerificarLiga = "SELECT league_id FROM leagues WHERE league_password = '$codigoLiga'";
            $resultadoVerificarLiga = $conexao->query($sqlVerificarLiga);

            if ($resultadoVerificarLiga && $resultadoVerificarLiga->num_rows > 0) {
                $liga = $resultadoVerificarLiga->fetch_assoc();
                $liga_id = $liga['league_id'];

                $sqlVerificarParticipacao = "SELECT * FROM user_league WHERE user_id = '$user_id' AND league_id = '$liga_id'";
                $resultadoVerificarParticipacao = $conexao->query($sqlVerificarParticipacao);

                if ($resultadoVerificarParticipacao && $resultadoVerificarParticipacao->num_rows === 0) {
                    $sqlEntrarLiga = "INSERT INTO user_league (user_id, league_id) VALUES ('$user_id', '$liga_id')";
                    $conexao->query($sqlEntrarLiga);

                    $sucessoCriarLiga = "Usuário entrou na liga com sucesso!";
                } else {
                    $erroEntrarLiga = "Usuário já faz parte desta liga.";
                }
            } else {
                $erroEntrarLiga = "Código da liga não encontrado.";
            }
        }
    } elseif (isset($_POST['criarliga'])) {
        $nomeLiga = $_POST['nomeliga'];
        $codigoLiga = $_POST['codigoLiga'];

        if (empty($nomeLiga) || empty($codigoLiga)) {
            $erroPreenchimento = "Ambos os campos devem ser preenchidos.";
        } else {
            $sqlVerificarCodigoUnico = "SELECT league_id FROM leagues WHERE league_password = '$codigoLiga'";
            $resultadoVerificarCodigoUnico = $conexao->query($sqlVerificarCodigoUnico);

            if ($resultadoVerificarCodigoUnico && $resultadoVerificarCodigoUnico->num_rows === 0) {
                $sqlCriarLiga = "INSERT INTO leagues (league_name, creator_user_id, league_password) 
                                VALUES ('$nomeLiga', '$user_id', '$codigoLiga')";

                $conexao->query($sqlCriarLiga);

                $liga_id = $conexao->insert_id;

                $sqlEntrarLiga = "INSERT INTO user_league (user_id, league_id) VALUES ('$user_id', '$liga_id')";
                $conexao->query($sqlEntrarLiga);

                $sucessoCriarLiga = "Nova liga criada!";
            } else {
                $erroCriarLiga = "Código da liga já existe.";
            }
        }
    }

    disconnect_db($conexao);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/liga.css">
    <title>Nova Liga</title>
</head>

<body>
    <?php
    if (!empty($erroEntrarLiga)) {
        echo "<div class='error' style='color:red; text-align:center;'>$erroEntrarLiga</div>";
    }
    if (!empty($erroCriarLiga)) {
        echo "<div class='error' style='color:red; text-align:center;'>$erroCriarLiga</div>";
    }
    if (!empty($erroPreenchimento)) {
        echo "<div class='error' style='color:red; text-align:center;'>$erroPreenchimento</div>";
    }
    if (!empty($sucessoCriarLiga)) {
        echo "<div class='sucesso' style='color:green; text-align:center;'>$sucessoCriarLiga</div>";
    }
    ?>
    <div class="container" id="ligacontainer">
        <div class="content">
            <h2>Nova Liga</h2><br>
            <div class="novaligacontent">
                <form action="" method="post">
                    <div class="novaligacontent">
                        <div class="entrarliga">
                            <h3>Entrar em uma liga</h3>
                            <input class="inputbox" type="text" name="codigoliga" id="entrarligacod"
                                placeholder="Código">
                            <button type="submit" name="entrarliga" class="btn">Entrar</button>
                        </div>
                        <div class="criarliga">
                            <h3>Criar nova liga</h3>
                            <input class="inputbox" type="text" name="nomeliga" id="criarliganome"
                                placeholder="Nome da nova liga">
                            <input class="inputbox" type="text" name="codigoLiga" id="codigoLiga"
                                placeholder="Código único da liga">
                            <button type="submit" name="criarliga" class="btn">Criar</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="buttons">
                <a href="home.php"><button class="btn">Cancelar</button> </a>
            </div>
        </div>
</body>

</html>