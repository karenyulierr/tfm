(function () {
    const menu = document.querySelector(".navbar-toggler");
    const div = document.querySelector(".navbar-collapse");
    menu.addEventListener("click", () => {
        console.log($(".navbar-collapse").hasClass("show"));
        if (!$(".navbar-collapse").hasClass("show")) {
            div.classList.add("fondo");
        }
    });
})();
