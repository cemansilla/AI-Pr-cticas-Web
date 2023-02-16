@push('head')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}"></script>
@endpush

<div class="bg-white rounded-top shadow-sm mb-3">
  <div class="row g-0">
    <div class="col mt-6 p-4">      
      <div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; height:600px !important;">
        <div id="chat-messages"></div>
      </div>

      <div class="publisher bt-1 border-light">
        <x-orchid-icon path="user" width="1.5em" height="100%" />
        <input class="publisher-input" type="text" placeholder="Preguntá algo..." id="chat-input">
      </div>      
    </div>
  </div>
</div>