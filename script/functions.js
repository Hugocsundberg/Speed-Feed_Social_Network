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
    setTimeout(() => {
        newDiv.remove()
    }, 5000);
}

