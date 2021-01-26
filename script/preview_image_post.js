const imageInput = document.querySelector('.image-section input')
const imageElement = document.querySelector('.image-section img')

imageInput.addEventListener('change', () => {
    fileReaderPost = new FileReader() 
    fileReaderPost.onload = () => {
        console.log(fileReaderPost.result)
        imageElement.setAttribute('src', fileReaderPost.result)
        imageElement.style.objectFit = "cover"
    }
    
    fileReaderPost.readAsDataURL(imageInput.files[0])

})
