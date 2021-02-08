console.log('okokok')
const logOut = document.querySelector('h1.log-out')


logOut.addEventListener('click', (e)=>{
    e.preventDefault()
    const confirmationBox = new ConfirmationBox('Are you sure you want to log out?', 'Log out', 'Stay logged in')
    confirmationBox.createPopUp().then(()=>{
        Smooth.exit('/account/logout.php')
    })
    

})