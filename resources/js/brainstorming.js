document.addEventListener("turbo:load", () => {
  function controlLoading(activate, text = "Loading...") {
    var loading = document.getElementById("spinner-container");

    if(loading!=null){
      if(activate){
        document.getElementById("spinner-text").innerHTML = text;
        loading.classList.remove("hidden");
      }else{
        if (!loading.classList.contains("hidden")) {
          loading.classList.add("hidden");
        }
      }      
    }
  }

  const btn_BSubmit = document.getElementById('form_brainstorming_submit');
  const proposalContainer = document.getElementById('proposal_container');
  const objetivo = document.querySelector('#input_prompt');
  const destino = document.querySelector('#input_destination');
  const excluir = document.querySelector('#input_exclude');

  if(btn_BSubmit!=null && proposalContainer != null && objetivo!=null && destino!=null && excluir!=null){
    btn_BSubmit.addEventListener('click', function (event) {
      proposalContainer.innerHTML = "";
      controlLoading(true);

      const data = {
        objetivo: objetivo.value,
        destino: destino.value,
        excluir: excluir.value
      };

      axios.post('/api/pyapi/brainstorming', data)
        .then(response => {
          let proposal = response.data.message;
          proposal = proposal.replace(/\n/g, "<br>");
          proposal = proposal.replace(/\\n/g, '<br>');
          proposalContainer.innerHTML = proposal;
          
          console.log(response.data);
          controlLoading(false);
        })
        .catch(error => {        
          console.log(error);
          controlLoading(false);
        });
    });
  }
});