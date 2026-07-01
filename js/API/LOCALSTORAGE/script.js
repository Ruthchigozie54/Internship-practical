const add = document.querySelector(".add")
const sub = document.querySelector(".sub")
const num = document.querySelector(".num")
const btn = document.querySelector("#btn")


  let number = JSON.parse(localStorage.getItem('mynum')) || 0
num.textContent = number
add.addEventListener('click', () => {
  number += 1
  
  num.textContent = number
})


sub.addEventListener('click', () => {
  number -= 1
  
  num.textContent = number
})

btn.addEventListener('click', () => {
  localStorage.setItem("mynum", number)
})