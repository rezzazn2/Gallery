// navbar
const nav = document.querySelector(".header")

function changeHeightNav() {
    if (window.scrollY > 1) {
        nav.classList.add('lebih')
    } else {
        nav.classList.remove('lebih')
    }
}

window.addEventListener("scroll", changeHeightNav);



