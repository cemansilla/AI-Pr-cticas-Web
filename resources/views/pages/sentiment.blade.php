@push('head')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{ asset('js/sentiment.js') }}"></script>
@endpush

<div class="bg-white rounded-top shadow-sm mb-3">
  <div class="row g-0">
    <div class="col mt-6 p-4">
      <div class="row">
        <div class="col-md-6">
          <form>
            <div class="form-group">
              <label for="input_sentiment_text">Texto a analizar</label>
              <textarea class="form-control" id="input_sentiment_text" placeholder="Me gusta mucho su producto" rows="3"></textarea>
              <small class="form-text text-muted">Ejemplo: Python es el mejor lenguaje de programación para trabajar sentiment con NLTK, pero es feo no usar punto y coma.</small>
            </div>
    
            <button id="btn_sentiment_submit" type="submit" class="btn btn-primary">Generar</button>
          </form>
        </div>
        <div class="col-md-6">
          @include('partials.loading')
          <div id="analysis_container"></div>
          <div id="proposal_sentiment_container">
            <div class="hidden" id="piechart_sentiment" style="width: 400px; height: 500px;"></div>
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>