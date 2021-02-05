const editComment = (e) => {
    //Vars
    const button = e.target;
    const comment = e.target.parentElement.parentElement.parentElement
    const postid = comment.dataset.postid
    const commentId = comment.dataset.id
    const editButton = document.querySelector(`.comment-id${commentId} .lower .right button.edit-button`)
    const paragraph = document.querySelector(`.comment.post${postid}.comment-id${commentId} .lower .left p`)
    const previousValue = paragraph.innerText
    const parentElement = paragraph.parentElement
    console.log(paragraph)
    //text input
    const newElement = document.createElement('input')
    newElement.setAttribute('type', 'text')
    newElement.setAttribute('value', previousValue)
    newElement.classList.add('editCommentInput')
    newElement.classList.add('comment-paragraph')
    parentElement.insertBefore(newElement, paragraph)
    paragraph.remove()
    //Alter Edit Comment
    //Change text
    editButton.innerText = 'Done'
    //Add event listener sendComment
    const newEditButton = editButton.cloneNode(true);
    newEditButton.addEventListener(('click'), sendComment)
    editButton.insertAdjacentElement('beforebegin', newEditButton)
    editButton.remove()

    //button 
    // const newButton = document.createElement('button')
    // newButton.classList.add('editCommentSubmitButton')
    // newButton.classList.add('comment-submit')
    // newButton.classList.add('button')
    // newButton.innerText = "Update"
    // newElement.insertAdjacentElement('afterEnd', newButton)
    // 


}
const sendComment = (e) => {
    e.preventDefault()
    const button = e.target;
    const commentId = e.target.parentElement.parentElement.parentElement.dataset.id
    const comment = e.target.parentElement.parentElement.parentElement
    const value = document.querySelector(`.comment-id${commentId} .lower .left input`).value
    const postId = comment.dataset.postid

    //Send data to backend 
    const JSONBody = {
        postId: postId,
        body: value,
        commentId: commentId
    }

    window.fetch('../account/edit_comment.php', {
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


