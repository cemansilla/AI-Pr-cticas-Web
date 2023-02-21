import { controlLoading } from './helpers';

document.addEventListener("turbo:load", () => {
  const btn_BSubmit = document.getElementById('btn_sentiment_submit');
  const analysisContainer = document.getElementById('analysis_container');
  const chartContainer = document.getElementById('piechart_sentiment');
  let text = document.querySelector('#input_sentiment_text');

  if(btn_BSubmit!=null && analysisContainer != null  && chartContainer != null && text!=null){
    btn_BSubmit.addEventListener('click', function() {
      if (!chartContainer.classList.contains('hidden')) {
        chartContainer.classList.add('hidden');
      }
      analysisContainer.innerHTML = "";
      controlLoading(true);

      let data = {
        text: text.value
      };

      axios.post('/api/pyapi/sentiment', data)
        .then(response => {
          console.log(response);
          if(response.data.success){
            let proposal = response.data.analysys_response.diagnosis;
            proposal = proposal.replace(/\n/g, "<br>");
            proposal = proposal.replace(/\\n/g, '<br>');
            analysisContainer.innerHTML = proposal;


            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
      
            function drawChart() {      
              var data = google.visualization.arrayToDataTable([
                ['Sentiment', 'Percentage'],
                ['Positivo',  response.data.analysys_response.scores.pos],
                ['Negativo',  response.data.analysys_response.scores.neg],
                ['Neutral',   response.data.analysys_response.scores.neu],
              ]);
      
              var options = {
                title: 'Análisis de sentimiento',
                legend: 'none',
                pieSliceText: 'label'
              };
      
              var chart = new google.visualization.PieChart(chartContainer);
              chartContainer.classList.remove('hidden');
      
              chart.draw(data, options);
            }


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