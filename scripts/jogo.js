// script.js

const words = ["apple", "banana", "cherry", "date", "fig", "grape", "kiwi", "lemon", "mango", "orange"];
let currentWord = "";
let score = 0;

function chooseRandomWord() {
    const randomIndex = Math.floor(Math.random() * words.length);
    return words[randomIndex];
}

function startGame() {
    currentWord = chooseRandomWord();
    document.getElementById("palavra").textContent = currentWord;
    document.getElementById("digitacao").value = "";
}

function checkWord() {
    const input = document.getElementById("digitacao").value;
    if (input === currentWord) {
        score += 25;
        document.getElementById("XP").textContent = "+" + score + "XP";
        var avatar = document.getElementById("avatar");
        avatar.classList.add("pular");
        avatar.addEventListener("animationend", function() {
            avatar.classList.remove("pular");
        });
        startGame();
    }
}

document.getElementById("digitacao").addEventListener("input", checkWord);

startGame();

document.addEventListener('DOMContentLoaded', function () {
    var tempoDiv = document.querySelector('.game-tempo');
    var tempoRestante = 10;

    function atualizarCronometro() {
        tempoDiv.innerHTML = tempoRestante + ' s';

        if (tempoRestante <= 0) {
            clearInterval(cronometro);
            registerGame(score);
            window.location.href = `jogopontuacao.html?xp=${score}&qtdPalavras=${score / 25}`

        } else {
            tempoRestante--;
        }
    }

    var cronometro = setInterval(atualizarCronometro, 1000);
});

function registerGame(score) {
    const gameId = generateUniqueId();
    const currentDate = new Date().toISOString().slice(0, 19).replace("T", " ");

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "phpFunctions/registrar_partida.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        console.log("Estado da solicitação: " + xhr.readyState);

        if (xhr.readyState === 4) {
            console.log("Status da resposta: " + xhr.status);

            if (xhr.status === 200) {
                console.log("Partida registrada com sucesso!");
            } else {
                console.log("Erro ao registrar a partida.");
            }
        }
    };

    const data = `gameId=${gameId}&score=${score}&date=${currentDate}`;
    console.log("Dados enviados: " + data);

    xhr.send(data);
}

function generateUniqueId() {
    return Math.floor(Math.random() * 1000000) + 1;
}
