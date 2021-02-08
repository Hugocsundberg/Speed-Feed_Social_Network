const sortBy = document.querySelector('.sort-by')

sortBy.addEventListener('change', (e) => {
    //Todo: send data to backend
    fetch('/account/sort.php', {
        method: 'POST',
        body: sortBy.value
    })
        .then(response => response.text())
        .then(data => {
            location.reload();
        })
    //Todo: reload page

})