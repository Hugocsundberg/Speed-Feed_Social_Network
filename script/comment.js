const commentButtons = document.querySelectorAll('.post-coment-button')

const submitComment = (e) => {
    const postId = e.target.parentElement.parentElement.parentElement.dataset.id
    const value = e.target.parentElement.previousSibling.children[0].value
    console.log(value)

    const JSONBody = {
        postId: postId,
        value: value
    }

    window.fetch('../account/comment.php', {
        body: JSON.stringify(JSONBody),
        method: 'post'
    }).then(response => response.text())
        .then(text => {
            console.log(text);
            location.reload();
        })

}

const newComment = (e) => {
    //Check if logged in 
    window.fetch('../account/is_logged_in.php', {
        method: 'post',
        credentials: 'include'
    }).then(response => response.json())
        .then(value => {
            console.log(value);
            if (value) {
                const clickedPost = e.target.parentElement.parentElement.parentElement
                postFlexContainer = document.querySelector('.post-flex-container')
                const postId = clickedPost.dataset.postid
                const commentArray = document.querySelectorAll(`.post-group${postId}`)
                const lastComment = commentArray[commentArray.length - 1]
                const commentDiv = document.createElement('div')
                commentDiv.classList.add('comment')
                commentDiv.innerHTML = `<div class= "upper" ><div class="left"><img src="/images/photo-1609050470947-f35aa6071497.jpeg" alt=""><p class="name">12345</p></div><div class="right"><p class="date">Tue Dec 2020 12:20</p></div></div><div class="lower"><div class="left"><input type="text" class="comment-paragraph"></input></div><div class="right"><button class="comment-submit button">Submit</button></div></div>`
                commentDiv.setAttribute('data-id', clickedPost.dataset.postid)
                postFlexContainer.insertBefore(commentDiv, lastComment.nextElementSibling)
                const submitButton = document.querySelector('.comment-submit')
                submitButton.classList.add('press-bounce')
                submitButton.addEventListener(('click'), submitComment)
            } else {
                logMessage(2, 'You have to log in to comment')
            }
        })



}

commentButtons.forEach((button) => {
    button.addEventListener('click', newComment)
})

//Delete comment 

const deleteComment = (e) => {
    const button = e.target;
    const commentId = e.target.parentElement.parentElement.parentElement.dataset.id
    const comment = e.target.parentElement.parentElement.parentElement
    const value = button.previousSibling.value
    const postId = comment.dataset.postid

    //Send data to backend 
    const JSONBody = {
        commentId: commentId
    }

    window.fetch('../account/delete_comment.php', {
        body: JSON.stringify(JSONBody),
        method: 'post',
        credentials: 'include'
    }).then(response => response.text())
        .then(text => {
            location.reload();
        })

}





const clickHandleDeleteComment = (event) => {
    const box = new ConfirmationBox('Are you sure you want to delete your comment?', 'Keep it', 'Delete it')
    box.createPopUp()
    .then((message)=>{
        console.log(message)
    })
    .catch((message)=>{
        console.log(message)
        deleteComment(event)
    })
}

document.querySelectorAll('.delete-button').forEach((button) => {
    button.addEventListener('click', clickHandleDeleteComment)
})


