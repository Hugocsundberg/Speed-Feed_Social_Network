const commentButtons = document.querySelectorAll('.post-coment-button')

const submitComment = (e) => {
    const postId = e.target.parentElement.parentElement.parentElement.dataset.id
    const value = e.target.previousSibling.value

    const JSONBody = {
        postId: postId,
        value: value
    }

    window.fetch('../Account/comment.php', {
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
    window.fetch('../Account/isLoggedIn.php', {
        method: 'post',
        credentials: 'include'
    }).then(response => response.json())
        .then(value => {
            console.log(value);
            if (value) {
                const clickedPost = e.target.parentElement.parentElement.parentElement
                const postId = clickedPost.dataset.postid
                const commentArray = document.querySelectorAll(`.post-group${postId}`)
                const lastComment = commentArray[commentArray.length - 1]
                const commentDiv = document.createElement('div')
                commentDiv.classList.add('comment')
                commentDiv.innerHTML = `<div class= "upper" ><div class="left"><img src="/images/photo-1609050470947-f35aa6071497.jpeg" alt=""><p class="name">12345</p></div><div class="right"><p class="date">Tue Dec 2020 12:20</p></div></div><div class="lower"><div class="left"><input type="text" class="comment-paragraph"></input><button class="comment-submit">Submit</button></div></div>`
                commentDiv.setAttribute('data-id', clickedPost.dataset.postid)

                document.body.insertBefore(commentDiv, lastComment.nextElementSibling)
                const submitButton = document.querySelector('.comment-submit')
                submitButton.addEventListener(('click'), submitComment)
            } else {
                alert('You have to log in to comment')
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

    window.fetch('../Account/delete_comment.php', {
        body: JSON.stringify(JSONBody),
        method: 'post',
        credentials: 'include'
    }).then(response => response.text())
        .then(text => {
            location.reload();
        })

}

document.querySelectorAll('.delete-button').forEach((button) => {
    button.addEventListener('click', deleteComment)
})


