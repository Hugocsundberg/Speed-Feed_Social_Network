// //Vars
// postId =
//     headline
// body

const editPost = (e) => {
    const button = e.target
    const postId = e.target.parentElement.parentElement.parentElement.dataset.postid
    const headline = document.querySelector(`.id${postId} .text-section h2`).innerText
    const body = document.querySelector(`.id${postId} .text-section p`).innerText
    const link = document.querySelector(`.id${postId} .image-section`).parentElement.href
    location = `/views/edit_post.php?postId=${postId}&headline=${headline}&body=${body}&link=${link}`
}

document.querySelectorAll('.post-edit-button').forEach((button) => {
    button.addEventListener('click', editPost)
})