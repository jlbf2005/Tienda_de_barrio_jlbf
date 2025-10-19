
const usuarios = [
    { email: 'admin@tienda.com', password: '12345' },
];

window.addEventListener('load', () => {
    const form = document.getElementById('loginForm');
    if (!form) {
        console.error('No se encontró #loginForm. Verifica el ID en tu vista.');
        return;
    }


    const userDashboardURL = form.dataset.userDashboardUrl || '/usuario';

    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const rememberMe = document.getElementById('rememberMe');
    const errorMessage = document.getElementById('errorMessage');

    const remembered = localStorage.getItem('rememberedEmail');
    if (remembered && emailInput) emailInput.value = remembered;

    console.log('login.js cargado ✔');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const email = (emailInput?.value || '').trim();
        const pass = (passwordInput?.value || '').trim();


        const usuario = usuarios.find(u => u.email === email && u.password === pass);

        if (usuario) {

            if (rememberMe?.checked) {
                localStorage.setItem('rememberedEmail', email);
            } else {
                localStorage.removeItem('rememberedEmail');
            }

            console.log('Redirigiendo a:', userDashboardURL);
            window.location.href = userDashboardURL;
            return;
        }


        if (errorMessage) {
            errorMessage.textContent = 'Correo o contraseña incorrectos.';
            errorMessage.classList.remove('d-none');
        }
        if (passwordInput) {
            passwordInput.value = '';
            passwordInput.focus();
        }
    });
});