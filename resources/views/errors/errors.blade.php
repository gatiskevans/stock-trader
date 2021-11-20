@if($errors->any())
    <div class="text-red-500 mt-10 grid justify-items-center font-extrabold text-4xl">
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif
