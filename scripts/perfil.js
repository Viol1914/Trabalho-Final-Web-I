
document.addEventListener('DOMContentLoaded', function () {
    fetchHistorico();
});

function fetchHistorico() {
    fetch('phpFunctions/obter_historico.php')
        .then(response => response.json())
        .then(data => {
            totalXpMatch(data); 
        })
        .catch(error => {
            console.error('Erro ao obter o histórico:', error);
        });
}

function totalXpMatch(historico) {
    const xpfield = document.getElementById('user_xp');
    const matchesField = document.getElementById('user_matches');

    const totalXP = historico.reduce((acc, partida) => acc + parseInt(partida.score), 0);
    const totalPartidas = historico.length;

    xpfield.textContent = `${totalXP} xp`;
    matchesField.textContent = `${totalPartidas} jogos`;
}

document.addEventListener('DOMContentLoaded', function () {
    fetchHistorico();
    fetchLigasUsuario();
});

function fetchLigasUsuario() {
    fetch('phpFunctions/obter_ligas_usuario.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro na requisição: ${response.statusText}`);
            }
            return response.json(); 
        })
        .then(data => {
            updateLigasUsuario(data);
        })
        .catch(error => {
            console.error('Erro ao obter as ligas do usuário:', error);
        });
}


function updateLigasUsuario(data) {
    const ligasContainer = document.querySelector('#ligasusercontainer .rankList');

    ligasContainer.innerHTML = '';

    const ul = document.createElement('ul');
    data.forEach(liga => {
        const li = document.createElement('li');
        li.textContent = `${liga.league_name} - Posição: ${liga.position}`;

        const button = document.createElement('button');
        button.textContent = 'Ver Ranking';
        button.addEventListener('click', () => {
            window.location.href = `ranking.php?liga_id=${liga.league_id}`;
        });

        li.appendChild(button);
        ul.appendChild(li);
    });

    ligasContainer.appendChild(ul);
}
