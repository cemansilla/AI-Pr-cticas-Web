import { controlLoading } from './helpers';

document.addEventListener("turbo:load", () => {
  const btn_OSubmit = document.getElementById('btn_obsidian_submit');  
  const proposalMdContainer = document.getElementById('obsidian_md_container');
  const materia = document.querySelector('#input_obsidian_materia');
  const temas = document.querySelector('#input_obsidian_temas');

  if(btn_OSubmit!=null && proposalMdContainer != null && materia!=null && temas!=null){
    btn_OSubmit.addEventListener('click', function() {
      proposalMdContainer.innerHTML = "";
      controlLoading(true);
      
      let btn_ODownload = document.getElementById('btn_download_obsidian');
      if(btn_ODownload!=null){
        btn_ODownload.remove();
      }

      const data = {
        materia: materia.value,
        temas: temas.value
      };

      axios.post('/api/pyapi/obsidian', data)
        .then(response => {
          if(response.data.success){
            let markdownText = response.data.message;

            let markdownText2HTML = markdownText.replace(/\n/g, "<br>");
            markdownText2HTML = markdownText2HTML.replace(/\\n/g, '<br>');
            proposalMdContainer.innerHTML = markdownText2HTML;
  
            const blob = new Blob([markdownText], { type: 'text/markdown' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.setAttribute('type', 'button');
            link.setAttribute('id', 'btn_download_obsidian');
            link.classList.add('btn', 'btn-secondary');
            link.href = url;
            link.download = 'archivo.md';
            link.innerHTML = 'Descargar archivo .md';
            document.getElementById('obsidian_buttons_container').appendChild(link);
            
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