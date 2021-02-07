linkList = document.querySelectorAll('.hamburger_text_container h1')
console.log(linkList)

linkList.forEach(element => {
    const link = element.dataset.link
    element.addEventListener('click', ()=>{
        Smooth.exit(link)
    })
});