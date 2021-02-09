const saveButton = document.querySelector('input.link-button')
let informationChange = false
// let imageChange = false
// let image = false    
const inputHeadline = document.querySelector('input.headline').value
const inputBody = document.querySelector('textarea.CreatePostbody').value
const inputLink = document.querySelector('input.link-input').value

window.addEventListener('keydown', ()=>{
    setTimeout(()=>{
        if(inputHeadline !== document.querySelector('input.headline').value || inputBody !== document.querySelector('textarea.CreatePostbody').value || inputLink !== document.querySelector('input.link-input').value) {
            informationChange = true
            saveButton.classList.remove('inactive')
            saveButton.classList.add('press-bounce')
        } else {
            informationChange = false
            saveButton.classList.add('inactive')
            saveButton.classList.remove('press-bounce')
        }
        console.log(informationChange)
    }, 300)
})