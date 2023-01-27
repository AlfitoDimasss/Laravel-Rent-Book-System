@extends('layouts.mainLayout')

@section('title', 'Add Rent Form')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@if ($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<h1 class="text-5xl font-bold text-center">Add New Rent</h1>
<div class="flex justify-center mt-10">
  <div class="w-[40%] bg-gray-200 rounded-lg p-10">
    <form action="" method="POST">
      @csrf
      @if (Auth::user()->role_id == 1)
      <div class="mb-3">
        <label for="user" class="block mb-2 font-medium text-gray-900 text-sm">User</label>
        <select name="user" id="user"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 capitalize select2">
          @foreach ($users as $user)
          <option value="{{ $user->id }}">{{ $user->username }}</option>
          @endforeach
        </select>
      </div>
      @else
      <input type="hidden" name="user" value="{{ Auth::user()->id }}">
      @endif
      <div class="mb-3">
        <label for="book" class="block mb-2 font-medium text-gray-900 text-sm">Avaliable Books</label>
        <select name="book" id="book"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 capitalize select2">
          @foreach ($books as $book)
          <option value="{{ $book->id }}">{{ $book->title }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit"
        class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save</button>
    </form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(function() {
    $('.select2').select2();
  });
</script>
@endsection