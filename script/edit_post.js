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

const saveButton = document.querySelector('input.link-button')
let informationChange = false
// let imageChange = false
// let image = false
const inputHeadline = document.querySelector('input#headline').value
const inputBody = document.querySelector('input#body').value
const inputLink = document.querySelector('input#link').value

window.addEventListener('keydown', ()=>{
    setTimeout(()=>{
        if(inputHeadline !== document.querySelector('input#headline').value || inputBody !== document.querySelector('input#body').value || inputLink !== document.querySelector('input#link').value) {
            informationChange = true
            saveButton.classList.remove('inactive')
            saveButton.classList.add('press-bounce')
        } else {
            informationChange = false
            saveButton.classList.add('inactive')
            saveButton.classList.remove('press-bounce')
        }
        console.log(informationChange)
    }, 1)
})