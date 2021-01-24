const input = document.querySelector('.image-section.imageUploadSection input')
const imageUploadSection = document.querySelector('.image-section.imageUploadSection')

const handleUploadClick = () => {
    input.click()
}

imageUploadSection.addEventListener('click', handleUploadClick)

