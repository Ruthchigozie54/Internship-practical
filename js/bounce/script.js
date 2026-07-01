let box = document.getElementById('box')

let moveUp = document.getElementById('up')
let moveDown = document.getElementById('down')
let moveLeft = document.getElementById('left')
let moveRight = document.getElementById('right')

let x = 0
let y = 0

moveUp.addEventListener('click', () => {
    y -= 10
    box.style.top = `${y}px`
})

moveDown.addEventListener('click', () => {
    y += 10
    box.style.top = `${y}px`
})

moveLeft.addEventListener('click', () => {
    x -= 10
    box.style.left = `${x}px`
})

moveRight.addEventListener('click', () => {
    x += 10
    box.style.left = `${x}px`
})