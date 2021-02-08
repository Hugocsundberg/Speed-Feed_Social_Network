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
        hamburgerIcon.classList.remove('hamburgerHamburger')
        hamburgerIcon.classList.add('hamburgerCross')
        window.addEventListener('scroll', hamburgerActivatedFunction)
    } else {
        hamburgerIcon.classList.add('hamburgerHamburger')
        hamburgerIcon.classList.remove('hamburgerCross')
        window.removeEventListener('scroll', hamburgerActivatedFunction)
    }
}

hamburgerIcon.addEventListener('click', toggleHamburger)

