window.scrollTo(0, sessionStorage.scroll);

window.addEventListener('scroll', () => {
    sessionStorage.setItem('scroll', window.scrollY);
})