const editPost = (e) => {
    const button = e.target
    const postId = e.target.parentElement.parentElement.parentElement.dataset.postid
    const headline = document.querySelector(`.id${postId} .text-section h2`).innerText
    const body = document.querySelector(`.id${postId} .text-section p`).innerText
    const link = document.querySelector(`.id${postId} .image-section`).parentElement.href
    const imgSource = document.querySelector(`.id${postId} .image-section img`).src
    const profileImgSource = document.querySelector(`.id${postId} .date-section .left img`).src
    location = `/views/edit_post.php?postId=${postId}&headline=${headline}&body=${body}&link=${link}&img_source=${imgSource}&profile_img_source=${profileImgSource}`
}

document.querySelectorAll('.post-edit-button').forEach((button) => {
    button.addEventListener('click', editPost)
})