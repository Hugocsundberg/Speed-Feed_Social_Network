const editComment = (e) => {
    //Vars
    const button = e.target;
    const comment = e.target.parentElement.parentElement.parentElement
    const postid = comment.dataset.postid
    const commentId = comment.dataset.id
    const paragraph = document.querySelector(`.comment.post${postid}.comment-id${commentId} .lower .left p`)
    const previousValue = paragraph.innerText
    const parentElement = paragraph.parentElement
    console.log(paragraph)
    //text input
    const newElement = document.createElement('input')
    newElement.setAttribute('type', 'text')
    newElement.setAttribute('placeholder', previousValue)
    newElement.classList.add('editCommentInput')
    parentElement.insertBefore(newElement, paragraph)
    paragraph.remove()
    //button 
    const newButton = document.createElement('button')
    newButton.classList.add('editCommentSubmitButton')
    newButton.innerText = "Update"
    newElement.insertAdjacentElement('afterEnd', newButton)
    newButton.addEventListener(('click'), sendComment)


}
const sendComment = (e) => {
    const button = e.target;
    const commentId = e.target.parentElement.parentElement.parentElement.dataset.id
    const comment = e.target.parentElement.parentElement.parentElement
    const value = button.previousSibling.value
    const postId = comment.dataset.postid

    //Send data to backend 
    const JSONBody = {
        postId: postId,
        body: value,
        commentId: commentId
    }

    window.fetch('../Account/edit-comment.php', {
        body: JSON.stringify(JSONBody),
        method: 'post',
        credentials: 'include'
    }).then(response => response.text())
        .then(text => {
            location.reload();
        })

}

document.querySelectorAll('.edit-button').forEach(item => {
    item.addEventListener('click', editComment)
})


