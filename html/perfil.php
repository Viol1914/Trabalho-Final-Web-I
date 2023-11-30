<?php
require "php/force_authenticate.php"
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/perfil.css">
    <title>Meu perfil</title>
</head>

<body>
    <div class="btn"><a href="home.php"> Home
        </a>
    </div>
    <div class="content" id="userpage">
        <section class="contentleftuser">
            <div>
                <h2>Meu Perfil</h2>
                <span id="nomeuser">User:</span>
            </div>
            <div class="foto">
                <div class="imguser">
                    <img src="../assets/images/icon.png" alt="Icon do User">
                </div>
                <button id="mudarimguser" class="btnuser" type="button">Alterar imagem</button>
            </div>
        </section>


        <section class="contentrightuser">
            <div class="container" id="containerperfil">
                <div class="xps">
                    <img src="../assets/images/2.svg">
                    <h3 id="user_xp">XP</h3>
                </div>
                <div class="partidas">
                    <img src="../assets/images/1.svg">
                    <h3 id="user_matches">Jogos</h3>
                </div>
                <div>
                    <button id="historico" class="btnhistorico" type="button"><a href="historico.php">Ver histórico de
                            partidas</a></button>
                </div>
            </div>
            <div class="container" id="ligasusercontainer">
                <div class="rankTitle">ranking</div>
                <div class="rankList">

                </div>
            </div>
        </section>

    </div>
    <script src="../scripts/perfil.js"></script>
</body>

</html>