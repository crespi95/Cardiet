
import io from 'socket.io-client';


const socket = io('http://www.meteopedroespinosa.es:3000/')
const messageContainer = document.getElementById('message-container')
const messageForm = document.getElementById('send-container')
const messageInput = document.getElementById('message-input')

function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
  results = regex.exec(location.search);
  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
const name = getParameterByName("usuario");
if(name){
appendMessage('Te has unido')
socket.emit('new-user', name)

socket.on('chat-message', data => {
  appendMessage(`${data.name}: ${data.message}`)
})

socket.on('user-connected', name => {
  appendMessage(`${name} se ha conectado`);

})

socket.on('user-disconnected', name => {
  appendMessage(`${name} se ha desconectado`)
})
socket.on('user-borrar', usuarios => {
  document.getElementById("usuario").innerHTML =usuarios.toString();
})


messageForm.addEventListener('submit', e => {
  e.preventDefault()
  const message = messageInput.value
  appendMessage(`Yo: ${message}`)
  socket.emit('send-chat-message', message)
  messageInput.value = ''
})

function appendMessage(message) {
  const messageElement = document.createElement('div')
  messageElement.innerText = message
  messageContainer.append(messageElement)
}}else{
  window.close();
}
$("#conectados").click(()=>{
  $("#usuario").toggle();
});