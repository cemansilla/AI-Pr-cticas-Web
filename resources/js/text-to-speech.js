import { controlLoading } from './helpers';

document.addEventListener("turbo:load", () => {
  const btn_BSubmit = document.getElementById('btn_tts_submit');
  const audioContainer = document.getElementById('tts_container');
  let text = document.querySelector('#input_tts_text');

  if(btn_BSubmit!=null && audioContainer != null && text!=null){
    btn_BSubmit.addEventListener('click', function() {
      audioContainer.innerHTML = "";
      controlLoading(true);

      let data = {
        text: text.value
      };

      axios.post('/api/pyapi/text-to-speech', data)
        .then(response => {
          if(response.data.success){
            axios.get(response.data.audio_url, { responseType: 'blob' })
              .then(function (response) {
                var url = URL.createObjectURL(response.data);
                var audio = new Audio(url);

                audioContainer.appendChild(audio);
                audio.play();

                controlLoading(false);
              })
              .catch(function (error) {
                alert("Ha ocurrido un error al obtener el archivo de audio.");
                controlLoading(false);
              });
          }else{
            alert("Ha ocurrido un error: " + response.data.error_message);
            controlLoading(false);
          }
        })
        .catch(error => {
          console.log("error", error);
          alert("Ha ocurrido un error");
          controlLoading(false);
        });
    });
  }
});