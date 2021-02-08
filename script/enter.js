if(sessionStorage.welcomed !== 'true') { 
    //Welcome 
    //Container
    const welcomeContainer = document.createElement('div')
    welcomeContainer.classList.add('welcomeContainer')
    document.body.appendChild(welcomeContainer)
    //Headline
    const welcomeHeadline = document.createElement('h1')
    welcomeHeadline.classList.add('welcomeHeadline')
    welcomeHeadline.innerText="Welcome"
    welcomeContainer.appendChild(welcomeHeadline)
    //Welcomed = true
    setTimeout(() => {
        welcomeContainer.remove()
    }, 5000);
    sessionStorage.setItem('welcomed', true)
} else {
    Smooth.enter()
}
