function getBotIconSvg(){
  const svg_icon = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
  svg_icon.setAttribute('xmlns', 'http://www.w3.org/2000/svg_icon');
  svg_icon.setAttribute('version', '1.1');
  svg_icon.setAttribute('width', '1.5em');
  svg_icon.setAttribute('height', '1.5em');
  svg_icon.setAttribute('viewBox', '0 0 32 32');
  svg_icon.setAttribute('role', 'img');
  svg_icon.setAttribute('fill', 'currentColor');
  svg_icon.setAttribute('path', 'bot');
  svg_icon.setAttribute('componentname', 'orchid-icon');
  const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
  path.setAttribute('d', 'M27.5,12A2.5,2.5,0,0,0,25,14.5V13a1,1,0,0,0-1-1H8a1,1,0,0,0-1,1v1.5a2.5,2.5,0,0,0-5,0v6a2.5,2.5,0,0,0,5,0V24a1,1,0,0,0,1,1h2v4.5a2.5,2.5,0,0,0,5,0V25h2v4.5a2.5,2.5,0,0,0,5,0V25h2a1,1,0,0,0,1-1V20.5a2.5,2.5,0,0,0,5,0v-6A2.5,2.5,0,0,0,27.5,12ZM5,20.5a.5.5,0,0,1-1,0v-6a.5.5,0,0,1,1,0Zm8,9a.5.5,0,0,1-1,0V25h1Zm6.5.5a.51.51,0,0,1-.5-.5V25h1v4.5A.51.51,0,0,1,19.5,30ZM23,23H9V14H23Zm5-2.5a.5.5,0,0,1-1,0v-6a.5.5,0,0,1,1,0Z');
  svg_icon.appendChild(path);
  const path_2 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
  path_2.setAttribute('d', 'M7.08,9.88a1,1,0,0,0,.24.78,1,1,0,0,0,.75.34H23.93a1,1,0,0,0,.75-.34,1,1,0,0,0,.24-.78A9,9,0,0,0,21.65,4l2.18-2.18A1,1,0,0,0,22.42.42L19.93,2.91A9,9,0,0,0,16,2a8.87,8.87,0,0,0-4.42,1.18L8.82.42A1,1,0,0,0,7.4.42a1,1,0,0,0,0,1.41L9.94,4.37A8.94,8.94,0,0,0,7.08,9.88ZM22.7,9H9.3A7,7,0,0,1,22.7,9Z');
  svg_icon.appendChild(path_2);

  return svg_icon;
}

function getChatMessageTemplate(propio, message, hora) {
  const mediaChat = document.createElement("div");
  mediaChat.classList.add("media", "media-chat");
  if (propio) {
    mediaChat.classList.add("media-chat-reverse");
  }

  if(!propio){   
  const svg_icon = getBotIconSvg();
   mediaChat.appendChild(svg_icon);
  }

  const mediaBody = document.createElement("div");
  mediaBody.classList.add("media-body");

  const mensajeP = document.createElement("p");
  mensajeP.innerText = message;
  mediaBody.appendChild(mensajeP);

  const horaP = document.createElement("p");
  horaP.innerText = hora;
  horaP.classList.add("meta");
  horaP.innerHTML = '<time>' + hora + '</time>';
  mediaBody.appendChild(horaP);

  mediaChat.appendChild(mediaBody);

  return mediaChat;
}

function getCurrentHour(){
  const fechaActual = new Date();
  const horas = fechaActual.getHours().toString().padStart(2, '0');
  const minutos = fechaActual.getMinutes().toString().padStart(2, '0');
  return `${horas}:${minutos}`;
}

function writeMessage(self, message, container){
  let hour = getCurrentHour();

  messageRow = getChatMessageTemplate(self, message, hour);
  container.appendChild(messageRow);
  container.scrollTo(0, container.scrollHeight);
}

document.addEventListener('DOMContentLoaded', function(event) {
  const chatInput = document.getElementById('chat-input');
  const chatMessages = document.getElementById('chat-messages');

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
});