const saveButton = document.querySelector('section.form div.save')
const formSubmit = document.querySelector('section.form input.form-account-submit')

let informationChange = false
let imageChange = false
let image = false
const inputName = document.querySelector('input#name').value
const inputEmail = document.querySelector('input#email').value
const inputPassword = document.querySelector('input#password').value
const inputBio = document.querySelector('input#bio').value

clickHandleAccountSave = () => {
    passwordFieldValue = document.querySelector('input#password').value
    if(passwordFieldValue !== '') {
        const box = new ConfirmationBox('Are you sure you want to change your password?', 'Dont change password', 'Change password')
        box.createPopUp()
        .catch(()=>{
            formSubmit.click()
        })
    } else {
        formSubmit.click()
    }
}

const enterKeyHandler = (e)=>{
    if(e.key==="Enter") {
        e.preventDefault()
        window.removeEventListener('keydown', enterKeyHandler)
        clickHandleAccountSave()
    }
}

    const enterEventlistener = window.addEventListener('keydown', enterKeyHandler)
    saveButton.addEventListener('click', clickHandleAccountSave)

    const imageInput = document.querySelector('section.top input.input-field')
    const imageElement = document.querySelector('section.top img')
    
    imageInput.addEventListener('change', () => {
        fileReader = new FileReader() 
        fileReader.onload = () => {
            image = fileReader.result
            imageChange = true
            informationChange = true
            saveButton.classList.remove('inactive')
            saveButton.classList.add('press-bounce')
            imageElement.setAttribute('src', fileReader.result)
        }
        
        fileReader.readAsDataURL(imageInput.files[0])
    
    })

window.addEventListener('keydown', ()=>{
    setTimeout(()=>{
        if(inputName !== document.querySelector('input#name').value || inputEmail !== document.querySelector('input#email').value || inputPassword !== document.querySelector('input#password').value || inputBio !== document.querySelector('input#bio').value || imageChange === true) {
            informationChange = true
            saveButton.classList.remove('inactive')
            saveButton.classList.add('press-bounce')
        } else {
            informationChange = false
            saveButton.classList.add('inactive')
            saveButton.classList.remove('press-bounce')
        }
    }, 300)
})