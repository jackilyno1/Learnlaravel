<h2>Demo View Unicode</h2>
{{-- {{$title}} --}}

<form action="" method="POST">
    <input type="text" name="username" placeholder="Username" value="{{old('username')}}">
    <button type="submit">Submit</button>
    @csrf
</form>
@if (session('mess'))
    <div class="alert alert-success">
        {{ session('mess') }}
    </div>
@endif