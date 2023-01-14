@extends('layouts.mainLayout')

@section('title', 'Add Category Form')

@section('content')
@if ($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5 w-1/4">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<h1 class="text-5xl font-bold text-center">Add New Category</h1>
<div class="flex justify-center mt-10">
  <div class="w-[40%] bg-gray-200 rounded-lg p-10">
    <form action="" method="POST">
      @csrf
      <div class="mb-3">
        <label for="category" class="block mb-2 font-medium text-gray-900 text-sm">Category Name</label>
        <input type="text" id="category"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
          placeholder="Action" name="category" required>
      </div>
      <button type="submit"
        class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save</button>
    </form>
  </div>
</div>
@endsection