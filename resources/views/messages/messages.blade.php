@if(Session::has('message'))
    <div class="w-full text-3xl text-center text-white bg-green-500">
        {{ Session::get('message') }}
    </div>
@endif
