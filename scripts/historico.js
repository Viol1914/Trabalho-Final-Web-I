
document.addEventListener('DOMContentLoaded', function () {
    fetchHistorico();
});

function fetchHistorico() {
    fetch('phpFunctions/obter_historico.php')
        .then(response => response.json())
        .then(data => {
            updateHistorico(data);
            totalXpMatch(data); h
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

function updateHistorico(historico) {
    const historicoContainer = document.getElementById('historicocontainer');
    
    historicoContainer.innerHTML = '';

    historico.forEach(partida => {
        const partidaElement = document.createElement('div');
        partidaElement.textContent = `Partida ID: ${partida.match_id}, Pontuação: ${partida.score}, Data: ${partida.date}`;
        historicoContainer.appendChild(partidaElement);
    });
}
