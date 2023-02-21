import { controlLoading } from './helpers';

document.addEventListener("turbo:load", () => {
  const btn_PSubmit = document.getElementById('btn_postrrss_submit');
  const proposalTextContainer = document.getElementById('proposal_text_container');
  const proposalImageContainer = document.getElementById('image_post_result');
  let prompt = document.querySelector('#input_postrrss_prompt');
  let destino = document.querySelector('#input_postrrss_destination');
  let excluir = document.querySelector('#input_postrrss_exclude');

  if(btn_PSubmit!=null && proposalTextContainer != null && proposalImageContainer != null && prompt!=null && destino!=null && excluir!=null){
    btn_PSubmit.addEventListener('click', function() {
      proposalImageContainer.src = "";
      if (!proposalImageContainer.classList.contains('hidden')) {
        proposalImageContainer.classList.add('hidden');
      }
      proposalTextContainer.innerHTML = "";

      controlLoading(true);

      let data = {
        prompt: prompt.value,
        destino: destino.value,
        excluir: excluir.value
      };

      axios.post('/api/pyapi/post-rrss', data)
        .then(response => {
          if(response.data.success){
            let proposal = response.data.text;
            proposal = proposal.replace(/\n/g, "<br>");
            proposal = proposal.replace(/\\n/g, '<br>');
            proposalTextContainer.innerHTML = proposal;

            proposalImageContainer.src = response.data.image;
            proposalImageContainer.classList.remove('hidden');

            controlLoading(false);
          }else{
            alert("Ha ocurrido un error: " + response.data.error_message);
            controlLoading(false);
          }
        })
        .catch(error => {        
          alert("Ha ocurrido un error");
          controlLoading(false);
        });
    });
  }
});