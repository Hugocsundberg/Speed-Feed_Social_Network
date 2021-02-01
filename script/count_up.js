const intParagraph = document.querySelector('.count-up')

let int = 0
let speed = 1000
let likeWord


const interval = () => {
    setTimeout(() => {

        int === 1 ? likeWord = 'like' : likeWord = 'likes';
        intParagraph.innerHTML = `${Math.round(int)} ${likeWord}`
        int++
        if(speed > 60) {
            speed = speed - (speed/10)
        }
        if(int <= 100) {
            interval()
        }
    }, speed);
}

interval()