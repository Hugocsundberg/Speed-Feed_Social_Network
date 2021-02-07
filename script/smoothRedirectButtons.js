button = document.querySelector('.content-container button.button.press-bounce')
console.log(button)

    const link = "/views/create_post.php"
    button.addEventListener('click', ()=>{
        Smooth.exit(link)
    })