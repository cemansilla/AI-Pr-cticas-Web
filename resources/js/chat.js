import { writeMessage } from './helpers';

document.addEventListener("turbo:load", () => {
  const chatInput = document.getElementById('chat-input');
  const chatMessages = document.getElementById('chat-messages');

  if(chatInput!=null && chatMessages!=null){
    chatInput.addEventListener('keyup', (event) => {
      if (event.key === 'Enter') {      
        const message = event.target.value;
        event.target.value = '';
  
        writeMessage(true, message, chatMessages);
        
        axios.post('/api/pyapi/chat', { message })
          .then(response => {
            writeMessage(false, response.data.message, chatMessages);
          })
          .catch(error => {
            writeMessage(false, 'Ups! Error :(', chatMessages);
            console.log(error);
          });
      }
    });
  }
});