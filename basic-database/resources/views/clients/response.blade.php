<h1>Demo Response</h1>
<form action="" method="POST">
    <input value="{{ old('username') }}" name="username" type="text" placeholder="Enter...">
    <button type="submit">Submit</button>
    @csrf
</form>
@if (session('message'))
    <h2>{{ session('message') }}</h2>
@endif
