@if($errors->any())
    <div class="text-red-500 grid justify-items-center font-extrabold text-1xl mt-5">
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif
