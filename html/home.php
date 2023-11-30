<?php
require "php/force_authenticate.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/home.css">
    <title>Keyspace</title>
</head>

<body>
    <img id="nuvem1" class="decorations" src="../assets/images/Nuvem.svg">
    <img id="nuvem2" class="decorations" src="../assets/images/Nuvem.svg">
    <img id="nuvem3" class="decorations" src="../assets/images/Nuvem.svg">
    <img id="nuvem4" class="decorations" src="../assets/images/Nuvem.svg">
    <img id="nuvem5" class="decorations" src="../assets/images/Nuvem.svg">
    <img id="star1" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star2" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star3" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star4" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star5" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star6" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star7" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star8" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star9" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star10" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star11" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="star12" class="decorations" src="../assets/images/estrelas/1.svg">
    <img id="lua" class="decorations" src="../assets/images/estrelas/2.svg">
    <div class="indexcontent">
        <div class="infos">
            <div class="xps">
                <img src="../assets/images/2.svg">
            </div>
            <div class="partidas">
                <img src="../assets/images/1.svg">
            </div>
        </div>
        <div class="container" id="indexcontainer">
            <div class="content">
                <h2>Keyspace</h2>
                <div class="opcoes">
                    <ul>
                        <li><a href="jogo.php">Novo jogo</a></li>
                        <li><a href="perfil.php">Meu Perfil</a></li>
                        <li><a href="liga.php">Nova Liga</a></li>
                    </ul>
                </div>
                <div class="buttons">
                <a href="regras.html"><img class="imgbtn" src="../assets/images/Regras.svg"></a>
                    <?php if ($login): ?>
                    <a href="logout.php"><img class="imgbtn" src="../assets/images/Logout.svg"></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
