class ConfirmationBox {
    constructor(message, yesText, noText) {
        this.message = message
        this.yesText = yesText
        this.noText = noText
    }



    createPopUp() {
        //Create pop-up
        // const fullCover = document.createElement('div')
        // fullCover.classList.add('full-cover')
        const messageElement = document.createElement('div')
        messageElement.classList.add('message-box-container')
        //Upper
        const upperElement = document.createElement('div')
        upperElement.classList.add('upper')
        //Paragraph
        const paragraph = document.createElement('p')
        paragraph.innerText=this.message
        //Append
        upperElement.appendChild(paragraph)
    
        //Lower
        const lowerElement = document.createElement('div')
        lowerElement.classList.add('lower')
        //Reject button
        const rejectButton = document.createElement('button')
        rejectButton.classList.add('button')
        rejectButton.classList.add('reject')
        rejectButton.innerText=this.noText
        //Confirm button
        const confirmButton = document.createElement('button')
        confirmButton.classList.add('button')
        confirmButton.classList.add('confirm')
        confirmButton.innerText=this.yesText
        //Append 
        lowerElement.appendChild(rejectButton)
        lowerElement.appendChild(confirmButton)
        
        messageElement.appendChild(upperElement)
        messageElement.appendChild(lowerElement)
    
        // fullCover.appendChild(messageElement)
        document.body.appendChild(messageElement)
    
        
        return new Promise((resolve, reject)=>{
            const handleResolve = () => {
                resolve('User pressed ok')
                messageElement.classList.add('message-out')
                setTimeout(() => {
                    messageElement.remove()
                }, 500);

            }
            const handleReject = () => {
                reject('User did not press ok')
                messageElement.classList.add('message-out')
                setTimeout(() => {
                    messageElement.remove()
                }, 500);
            }

            rejectButton.addEventListener('click', handleReject)
            confirmButton.addEventListener('click', handleResolve)
        })
    }
        

}