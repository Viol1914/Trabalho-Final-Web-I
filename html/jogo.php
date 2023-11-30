<?php
require "php/force_authenticate.php"
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Digitaita</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='../assets/jogo.css'>

    </head>

    <body>
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
        <div class="container-game">
            <div class="container-game-header">
                <a href="home.php"><img class="imgbtn" src="../assets/images/Sair.svg"></a>
            </div>
            <img id="gato" src="../assets/images/Gato.svg">
            <div class="container-game-board">
                <div class="container" id="game-board">
                    <div class="game-tempo"></div>
                    <div class="palavra" id="palavra">Palavra</div>
                    <div class="digitacao"><input id="digitacao" class="inputbox"></div>
                    <div class="XP" id="XP"></div>
                </div>
            </div>
        </div>
        <img id="avatar" src="../assets/images/avatares/Avatar10.svg">
        <script src='../scripts/jogo.js'></script>
    </body>

</html>
