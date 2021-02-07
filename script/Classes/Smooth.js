class Smooth {
    static enter() {
        //Create cover element
        const coverElement = document.createElement('div')
        coverElement.classList.add('smooth-enter')
        coverElement.classList.add('smooth-enter-cover')
        document.body.appendChild(coverElement)
        //Remove cover element 
        setTimeout(() => {
            coverElement.remove()
        }, 400);
    }

    static exit(link) {
        //Create cover element
        const coverElement = document.createElement('div')
        coverElement.classList.add('smooth-exit')
        coverElement.classList.add('smooth-enter-cover')
        document.body.appendChild(coverElement)
        setTimeout(() => {
            window.location=link
        }, 400);
    }
}