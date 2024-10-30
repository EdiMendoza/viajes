// Elementos de los modales
const loginModal = document.getElementById("loginModal");
const registerModal = document.getElementById("registerModal");
const loginBtn = document.getElementById("loginBtn");
const closeLogin = document.getElementById("closeLogin");
const closeRegister = document.getElementById("closeRegister");
const createAccountLink = document.getElementById("createAccountLink");

// Mostrar y ocultar el modal de Login
loginBtn.onclick = () => {
    loginModal.style.display = "block";
};

closeLogin.onclick = () => {
    loginModal.style.display = "none";
};

// Mostrar y ocultar el modal de Crear Cuenta
createAccountLink.onclick = (e) => {
    e.preventDefault();
    loginModal.style.display = "none";
    registerModal.style.display = "block";
};

closeRegister.onclick = () => {
    registerModal.style.display = "none";
};

// Cerrar los modales al hacer clic fuera de ellos
window.onclick = (event) => {
    if (event.target == loginModal) {
        loginModal.style.display = "none";
    }
    if (event.target == registerModal) {
        registerModal.style.display = "none";
    }
};

// Guardar cuenta creada (solo simulado)
document.getElementById("registerSubmit").onclick = () => {
    alert("Cuenta creada exitosamente.");
    registerModal.style.display = "none";
    loginModal.style.display = "block";
};

// Mostrar y ocultar elementos según el rol
document.getElementById("loginSubmit").onclick = async () => {
    const email = document.getElementById("loginEmail").value;
    const password = document.getElementById("loginPassword").value;

    const response = await fetch("login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, password })
    });

    const result = await response.json();
    if (result.success) {
        if (result.rol === "admin") {
            document.getElementById("adminPanel").classList.remove("hidden");
        } else {
            document.querySelectorAll(".reserveBtn, .cancelBtn").forEach(btn => btn.classList.remove("hidden"));
        }
    } else {
        alert("Login fallido. Verifica tus credenciales.");
    }
};
