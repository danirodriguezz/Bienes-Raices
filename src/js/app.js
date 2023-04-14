document.addEventListener("DOMContentLoaded", function() {
    eventListener();
    darkMode();
});

function eventListener() {
    const mobileMenu = document.querySelector(".mobile-menu");
    mobileMenu.addEventListener("click", function() {
        navegacionResponsive();
    });
};

function navegacionResponsive() {
    const navegacion =  document.querySelector(".navegacion");
    navegacion.classList.toggle("mostrar");
}

function darkMode() {
    const preferDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    
    if(preferDarkMode.matches) {
        document.body.classList.add("dark-mode");
    } else {
        document.body.classList.remove("dark-mode");
    };
    
    preferDarkMode.addEventListener("change", function() {
        if(preferDarkMode.matches) {
            document.body.classList.add("dark-mode");
        } else {
            document.body.classList.remove("dark-mode");
        };
    })
};