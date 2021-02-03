const logMessage = (type, message) => {
    const newDiv = document.createElement('div')
    newDiv.setAttribute('class', 'message-container')
    let typeClass 
    if(type === 1) {
        typeClass = 'info-message'

    } else if (type === 2) {
        typeClass = 'error-message'
    }
    newDiv.innerHTML = `<div class="message-box ${typeClass}"> <p>${message}</p> </div>`
    document.body.appendChild(newDiv)
}

const areYouSure = (message, yesText, noText) => {
    const fullCover = document.createElement('div')
    fullCover.classList.add('full-cover')
    const messageElement = document.createElement('div')
    messageElement.classList.add('message-container')
    //Upper
    const upperElement = document.createElement('div')
    upperElement.classList.add('upper')
    //Paragraph
    const paragraph = document.createElement('p')
    paragraph.innerText=message
    //Append
    upperElement.appendChild(paragraph)

    //Lower
    const lowerElement = document.createElement('div')
    lowerElement.classList.add('lower')
    //Button1
    const button1 = document.createElement('button')
    button1.classList.add('button')
    button1.classList.add('reject')
    button1.innerText=noText
    //Button2
    const button2 = document.createElement('button')
    button2.classList.add('button')
    button2.classList.add('confirm')
    button2.innerText=yesText
    //Append 
    lowerElement.appendChild(button1)
    lowerElement.appendChild(button2)
    
    messageElement.appendChild(upperElement)
    messageElement.appendChild(lowerElement)

    fullCover.appendChild(messageElement)
    document.body.appendChild(fullCover)
    
}

