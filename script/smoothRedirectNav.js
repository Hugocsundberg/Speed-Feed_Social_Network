linkList = document.querySelectorAll('.hamburger_text_container h1')

linkList.forEach(element => {
    const link = element.dataset.link
    element.addEventListener('click', ()=>{
        Smooth.exit(link)
    })
});

logo = document.querySelector('img.logo')

    const logoLink = "/index.php"
    logo.addEventListener('click', ()=>{
        Smooth.exit(logoLink)
    })