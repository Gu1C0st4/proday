document.addEventListener("DOMContentLoaded", function() {
    const preloader = document.querySelector('.preloader');

    function hidePreloader() {
        preloader.style.opacity = '0';
        preloader.style.visibility = 'hidden';
    }

    function showPreloader() {
        preloader.style.opacity = '1';
        preloader.style.visibility = 'visible';
    }

    setTimeout(hidePreloader, 2000); // 2000 milissegundos = 2 segundos

    // Redirecionamento ao submeter o formulário
    const form = document.getElementById('register-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Previne a submissão padrão do formulário

        // Validação dos campos do formulário
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (username && password && confirmPassword && password === confirmPassword) {
            showPreloader(); // Mostra o preloader novamente
            setTimeout(function() {
                window.location.href = 'index.php'; // Redireciona para index.php
            }, 500); // Adiciona um pequeno atraso para mostrar o preloader
        } else {
            alert('Por favor, preencha todos os campos corretamente.');
        }
    });
});
