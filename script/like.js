//Like
const sendLike = (post_id) => {
    fetch('/Account/send_like.php', {
        credentials: "include",
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            post_id: post_id
        })
    }).then(res => {
        return res.json()
    }).then(data => {
        console.log(data)
        likeIndicator = document.querySelector(`.post.id${post_id} .text-section .text-section-vote p`)

        likeIndicator.innerText = data.likes;

        if (data.loggedIn !== false) {
            document.querySelector(`.id${post_id} .text-section .text-section-vote .upvote-section img`).classList.toggle('upvoteInactive')
            document.querySelector(`.id${post_id} .text-section .text-section-vote .upvote-section img`).classList.toggle('upvote-active')

            if (document.querySelector(`.id${post_id} .text-section .text-section-vote .upvote-section img`).classList.contains('upvoteInactive')) {
                document.querySelector(`.id${post_id} .text-section .text-section-vote .upvote-section img`).src = "/images/upvote.svg"
            } else if (document.querySelector(`.id${post_id} .text-section .text-section-vote .upvote-section img`).classList.contains('upvote-active')) {
                document.querySelector(`.id${post_id} .text-section .text-section-vote .upvote-section img`).src = "/images/upvoteActive.svg"
                document.querySelector(`.id${post_id} .text-section .text-section-vote .downvote-section img`).src = "/images/downvote.svg"
                document.querySelector(`.id${post_id} .text-section .text-section-vote .downvote-section img`).classList.add('downvoteInactive')
                document.querySelector(`.id${post_id} .text-section .text-section-vote .downvote-section img`).classList.remove('downvote-active')
            }
        }

        //if data === true 
        //increase like count
    })

}


document.querySelectorAll('.upvote').forEach((upvote) => {
    upvote.addEventListener('click', (e) => { sendLike(e.currentTarget.parentElement.parentElement.dataset.post) })
})





//Dislike
const sendDislike = (post_id) => {
    fetch('/Account/send_dislike.php', {
        credentials: "include",
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            post_id: post_id
        })
    }).then(res => {
        return res.json()
    }).then(data => {
        console.log(data)
        likeIndicator = document.querySelector(`.post.id${post_id} .text-section .text-section-vote p`)

        likeIndicator.innerText = data.likes;
        //if data === true 
        //increase like count

        dislikeButton = document.querySelector(`.id${post_id} .text-section .text-section-vote .downvote-section img`)


        if (data.loggedIn !== false) {
            document.querySelector(`.id${post_id} .text-section .text-section-vote .downvote-section img`).classList.toggle('downvoteInactive')
            document.querySelector(`.id${post_id} .text-section .text-section-vote .downvote-section img`).classList.toggle('downvote-active')

            if (document.querySelector(`.id${post_id} .text-section .text-section-vote .downvote-section img`).classList.contains('downvoteInactive')) {
                document.querySelector(`.id${post_id} .text-section .text-section-vote .downvote-section img`).src = "/images/downvote.svg"
            } else if (document.querySelector(`.id${post_id} .text-section .text-section-vote .downvote-section img`).classList.contains('downvote-active')) {
                document.querySelector(`.id${post_id} .text-section .text-section-vote .downvote-section img`).src = "/images/downvoteActive.svg"
                document.querySelector(`.id${post_id} .text-section .text-section-vote .upvote-section img`).src = "/images/upvote.svg"
                document.querySelector(`.id${post_id} .text-section .text-section-vote .upvote-section img`).classList.add('upvoteInactive')
                document.querySelector(`.id${post_id} .text-section .text-section-vote .upvote-section img`).classList.remove('upvote-active')
            }
        }
    })

}


document.querySelectorAll('.downvote').forEach((upvote) => {
    upvote.addEventListener('click', (e) => { sendDislike(e.currentTarget.parentElement.parentElement.dataset.post) })
})