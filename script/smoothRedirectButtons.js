button = document.querySelector('button.button.press-bounce')
console.log(button)

    const link = "/views/create_post.php"
    button.addEventListener('click', ()=>{
        Smooth.exit(link)
    })