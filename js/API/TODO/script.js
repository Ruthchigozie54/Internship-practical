const input = document.querySelector(".task-input")
const button = document.querySelector(".add-btn")
const ul = document.querySelector(".task-list")

let tasks = JSON.parse(localStorage.getItem('tasks')) || []

for (i = 0; i < tasks.length; i++){
  let list = document.createElement("li")
  list.classList.add("task-item")
    list.innerHTML = `
      <span class="task-text">${tasks[i]}</span>
  `
  ul.appendChild(list)


}

button.addEventListener('click', () => {
  let list = document.createElement("li")
  list.classList.add("task-item")

  list.innerHTML = `
      <span class="task-text">${input.value}</span>
  `
  ul.appendChild(list)
  tasks.push(input.value)
  localStorage.setItem('tasks', JSON.stringify(tasks))
})