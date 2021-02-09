console.log('okokok')
const logOut = document.querySelector('h1.log-out')


logOut.addEventListener('click', (e)=>{
    e.preventDefault()
    const confirmationBox = new ConfirmationBox('Are you sure you want to log out?', 'Stay logged in', 'Log out')
    confirmationBox.createPopUp().catch(()=>{
        Smooth.exit('/account/logout.php')
    })
    

})