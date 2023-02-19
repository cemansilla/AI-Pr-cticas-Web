import { controlLoading, generateRandom } from './helpers';

document.addEventListener("turbo:load", () => {
  let mediaRecorder;
  let chunks = [];

  const startRecordingBtn = document.getElementById('startRecordingBtn');
  const stopRecordingBtn = document.getElementById('stopRecordingBtn');
  const proposalContainer = document.getElementById('proposal_container');

  if(startRecordingBtn!=null && stopRecordingBtn!=null && proposalContainer!=null){
    startRecordingBtn.addEventListener('click', () => {
      navigator.mediaDevices.getUserMedia({ audio: true })
        .then(stream => {
          mediaRecorder = new MediaRecorder(stream);

          mediaRecorder.addEventListener("dataavailable", function (event) {
            chunks.push(event.data);
          });

          mediaRecorder.addEventListener("stop", function () {
            let audioBlob = new Blob(chunks, { 'type': 'audio/ogg; codecs=opus' });
            let audioName = generateRandom();

            let formData = new FormData();
            formData.append('audio_file', audioBlob, `${audioName}.ogg`);

            proposalContainer.innerHTML = "";
            controlLoading(true);

            axios.post('/api/pyapi/voice', formData)
              .then(response => {
                if(response.data.success){
                  let proposal = response.data.message;
                  proposal = proposal.replace(/\n/g, "<br>");
                  proposal = proposal.replace(/\\n/g, '<br>');
                  proposalContainer.innerHTML = proposal;
      
                  controlLoading(false);
                }else{
                  alert("Ha ocurrido un error: " + response.data.error_message);
                  controlLoading(false);
                }
              })
              .catch(error => {
                alert("Ha ocurrido un error");
                console.log('error', error);
                controlLoading(false);
              });

            chunks = [];
          });

          mediaRecorder.start();

          startRecordingBtn.disabled = true;
          stopRecordingBtn.disabled = false;
        })
        .catch(err => {
          alert("Ha ocurrido un error al acceder al microfono");
          controlLoading(false);
        });
    });

    stopRecordingBtn.addEventListener('click', () => {
      mediaRecorder.stop();

      startRecordingBtn.disabled = false;
      stopRecordingBtn.disabled = true;
    });
  }
});