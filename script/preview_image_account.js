const imageInput = document.querySelector('section.top input.input-field')
const imageElement = document.querySelector('section.top img')

imageInput.addEventListener('change', () => {
    fileReader = new FileReader() 
    fileReader.onload = () => {
        console.log(fileReader.result)
        imageElement.setAttribute('src', fileReader.result)
    }
    
    fileReader.readAsDataURL(imageInput.files[0])

})
