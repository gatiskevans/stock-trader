@if(Session::has('message'))
    <div class="w-full text-3xl text-center text-white bg-green-500 p-3">
        {{ Session::get('message') }}
    </div>
@endif
