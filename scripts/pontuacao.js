
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const xp = urlParams.get('xp');
    const qtdPalavras = urlParams.get('qtdPalavras');

    document.getElementById('xp').textContent = xp + ' XP';
    document.getElementById('qtdpalavras').textContent = qtdPalavras + ' palavras';
});
