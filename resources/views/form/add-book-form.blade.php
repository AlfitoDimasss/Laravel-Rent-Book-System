@extends('layouts.mainLayout')

@section('title', 'Add Book Form')

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
<h1 class="text-5xl font-bold text-center">Add New Book</h1>
<div class="flex justify-center mt-10">
  <div class="w-[40%] bg-gray-200 rounded-lg p-10">
    <form action="" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="book_code" class="block mb-2 font-medium text-gray-900 text-sm">Book Code</label>
        <input type="text" id="book_code"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
          placeholder="B01" name="book_code" required>
      </div>
      <div class="mb-3">
        <label for="title" class="block mb-2 font-medium text-gray-900 text-sm">Title</label>
        <input type="text" id="title"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
          placeholder="My Diary" name="title" required>
      </div>
      <div class="mb-3">
        <label for="cover" class="block mb-2 font-medium text-gray-900 text-sm">Cover</label>
        <input type="file" id="cover"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
          placeholder="Sample.jpg" name="cover">
      </div>
      <div class="mb-3">
        <label for="category" class="block mb-2 font-medium text-gray-900 text-sm">Category</label>
        <select name="category[]" id="category"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 capitalize select-multiple-category"
          multiple>
          @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->category }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label for="rating" class="block mb-2 font-medium text-gray-900 text-sm">Rating</label>
        <input type="number" id="rating"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
          placeholder="1-5" name="rating" required>
      </div>
      <button type="submit"
        class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save</button>
    </form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(function() {
    $('.select-multiple-category').select2();
  });
</script>
@endsection