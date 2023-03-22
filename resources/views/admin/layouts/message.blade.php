@if (session()->has('msg'))
    <div class="alert alert-success" id="msg">
        {{ session()->get('msg') }}
    </div>
    
@endif
<div id="alert-div" ></div>