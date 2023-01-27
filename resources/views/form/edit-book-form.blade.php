@extends('layouts.mainLayout')

@section('title', 'Edit Book Form')

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
<h1 class="text-5xl font-bold text-center">Edit Book</h1>
<div class="flex justify-center mt-10">
  <div class="w-[40%] bg-gray-200 rounded-lg p-10">
    <form action="" method="POST" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      {{-- BOOK CODE --}}
      <div class="mb-3">
        <label for="book_code" class="block mb-2 font-medium text-gray-900 text-sm">Book Code</label>
        <input type="text" id="book_code"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
          placeholder="B01" name="book_code" value="{{ $book->book_code }}" required>
        <input type="hidden" id="old_book_code" name="old_book_code" value="{{ $book->book_code }}" required>
      </div>

      {{-- TITLE --}}
      <div class="mb-3">
        <label for="title" class="block mb-2 font-medium text-gray-900 text-sm">Title</label>
        <input type="text" id="title"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
          placeholder="My Diary" name="title" value="{{ $book->title }}" required>
      </div>

      {{-- COVER --}}
      <div class="mb-3 flex gap-10">
        <div class="w-1/4">
          <p class="block mb-2 font-medium text-gray-900 text-sm">Current Cover</p>
          <div>
            <img src="../images/{{ $book->cover }}" width="100px" height="100px" alt="">
          </div>
        </div>
        <div class="w-full">
          <label for="cover" class="block mb-2 font-medium text-gray-900 text-sm">Cover</label>
          <input type="file" id="cover"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
            placeholder="Sample.jpg" name="cover">
          <p class="text-xs italic text-gray-500 mt-2 ml-1">Leave blank if nothing changes.</p>
        </div>
      </div>

      {{-- CATEGORY --}}
      <div class="mb-5 flex gap-10">
        <div class="w-1/4">
          <p class="block mb-2 font-medium text-gray-900 text-sm">Current Category</p>
          @foreach ($book->categories as $category)
          <span class="bg-blue-600 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{
            $category->category }}</span>
          @endforeach
        </div>
        <div class="w-full">
          <label for="category" class="block mb-2 font-medium text-gray-900 text-sm">Category</label>
          <select name="category[]" id="category"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 capitalize select-multiple-category"
            multiple>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category }}</option>
            @endforeach
          </select>
          <p class="text-xs italic text-gray-500 mt-2 ml-1">Leave blank if nothing changes.</p>
        </div>
      </div>

      {{-- RATING --}}
      <div class="mb-3">
        <label for="rating" class="block mb-2 font-medium text-gray-900 text-sm">Rating</label>
        <input type="number" id="rating"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
          placeholder="1-5" name="rating" value="{{ $book->rating }}" required>
      </div>

      {{-- SUBMIT --}}
      <div class="flex justify-end">
        <button type="submit"
          class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save</button>
      </div>
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