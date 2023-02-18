@push('head')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}"></script>
@endpush

<div class="bg-white rounded-top shadow-sm mb-3">
  <div class="row g-0">
    <div class="col mt-6 p-4">
      <div class="row">
        <div class="col-md-6">
          <h1>Grabación de Audio</h1>
          <form id="audioForm">
            <div id="obsidian_buttons_container" class="form-group d-flex justify-content-start align-items-center">
              <button type="button" class="btn btn-primary" id="startRecordingBtn">Comenzar grabación</button>
              <button type="button" class="btn btn-danger" id="stopRecordingBtn" disabled>Detener grabación</button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          @include('partials.loading')
          <div id="proposal_container"></div>
        </div>
      </div>      
    </div>
  </div>
</div>