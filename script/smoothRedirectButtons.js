createPostbutton = document.querySelector('.content-container button.button.press-bounce')

    const createPostlink = "/views/create_post.php"
    createPostbutton.addEventListener('click', ()=>{
        Smooth.exit(createPostlink)
    })

// editButton = document.querySelector('.content-container button.button.press-bounce')
//     const editLink = "/views/create_post.php"
//     createPostbutton.addEventListener('click', ()=>{
//         Smooth.exit(editLink)
//     })