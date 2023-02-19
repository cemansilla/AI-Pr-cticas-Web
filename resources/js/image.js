import { controlLoading } from './helpers';

document.addEventListener("turbo:load", () => {
  const btn_BSubmit = document.getElementById('btn_image_submit');
  const imageContainer = document.getElementById('image_sd_result');
  const objetivo = document.querySelector('#input_image_prompt');
  const excluir = document.querySelector('#input_image_exclude');

  if(btn_BSubmit!=null && imageContainer != null && objetivo!=null && excluir!=null){
    btn_BSubmit.addEventListener('click', function() {
      imageContainer.src = "";
      if (!imageContainer.classList.contains('hidden')) {
        imageContainer.classList.add('hidden');
      }
      controlLoading(true);

      const data = {
        prompt: objetivo.value,
        excluir: excluir.value
      };

      axios.post('/api/pyapi/image', data)
        .then(response => {
          if(response.data.success){
            imageContainer.src = response.data.image;
            imageContainer.classList.remove('hidden');

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