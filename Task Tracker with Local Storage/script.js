const taskList = document.getElementById('taskList');
const tasks = JSON.parse(localStorage.getItem('tasks')) || [];

function renderTasks() {
  taskList.innerHTML = '';
  tasks.forEach((task, i) => {
    const li = document.createElement('li');
    li.textContent = task;
    li.onclick = () => deleteTask(i);
    taskList.appendChild(li);
  });
  localStorage.setItem('tasks', JSON.stringify(tasks));
}

function addTask() {
  const input = document.getElementById('taskInput');
  if (input.value.trim()) {
    tasks.push(input.value.trim());
    input.value = '';
    renderTasks();
  }
  console.log("waza");
}
function deleteTask(index) {
  tasks.splice(index, 1);
  renderTasks();
}

function restartTasks() {
    localStorage.removeItem('tasks');
    document.getElementById('taskList').innerHTML = '';
}

renderTasks();