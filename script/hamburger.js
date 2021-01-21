const hamburgerIcon = document.querySelector('.hamburger-icon')
const hamburgerMenu = document.querySelector('.hamburger-menu')

let hamburgerActivated = false
const hamburgerActivatedFunction = (e) => {
    window.scrollTo(0, 0)
}

const toggleHamburger = () => {
    hamburgerMenu.classList.toggle('hamburger_expanded');
    hamburgerActivated ? hamburgerActivated = false : hamburgerActivated = true
    if (hamburgerActivated === true) {
        window.addEventListener('scroll', hamburgerActivatedFunction)
    } else {
        window.removeEventListener('scroll', hamburgerActivatedFunction)
    }
}

hamburgerIcon.addEventListener('click', toggleHamburger)

