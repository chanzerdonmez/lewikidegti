const nav = document.querySelector("#nav");
const abrir = document.querySelector("#abrir");
const cerrar = document.querySelector("#cerrar");

abrir.addEventListener("click", () => {
    nav.classList.add("visible");
})

cerrar.addEventListener("click", () => {
    nav.classList.remove("visible");
})

document.addEventListener("DOMContentLoaded", function() {
    var authLinks = document.querySelectorAll(".nav-list li a[href*='login'], .nav-list li a[href*='logout']");
    
    authLinks.forEach(function(link) {
        link.addEventListener("click", function() {
            var text = this.textContent.trim();
            if (text === "Connexion") {
                this.textContent = "Déconnexion";
            } else if (text === "Déconnexion") {
                this.textContent = "Connexion";
            }
        });
    });
});




