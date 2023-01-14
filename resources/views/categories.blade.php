@extends('layouts.mainLayout')

@section('title', 'Categories')

@section('content')
@if ($msg = Session::get('success'))
<div class="bg-green-200 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-5" role="alert">
  <strong>{{ $msg }}</strong>
</div>
@endif
@if ($msg = Session::get('failed'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
  <strong>{{ $msg }}</strong>
</div>
@endif
<h1 class="text-5xl font-bold mb-10">Category List</h1>
<div class="mb-10">
  <a href="/category-add"
    class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Add
    New Category</a>
</div>
<div class="relative overflow-x-auto">
  <table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
      <tr>
        <th scope="col" class="px-6 py-3">No</th>
        <th scope="col" class="px-6 py-3">Category</th>
        <th scope="col" class="px-6 py-3 text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      @if ($categories == null)
      <tr>
        <th colspan="4" style="text-align: center" class="px-6 py-4 border-b">No Data.</th>
      </tr>
      @else
      @foreach ($categories as $category)
      @if ($loop->iteration % 2 == 1)
      <tr class="bg-white border-b">
        <td class="px-6 py-4">{{ $loop->iteration }}</td>
        <td class="px-6 py-4 capitalize">{{ $category->category }}</td>
        <td class="px-6 py-4 text-center flex justify-center">
          <a href="/category-edit/{{ $category->slug }}"
            class="text-white bg-yellow-400 hover:bg-yellow-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Edit</a>
          <form action="/category-delete/{{ $category->slug }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit"
              class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
              onclick="return confirm('Are you sure?')">Delete</button>
          </form>
        </td>
      </tr>
      @else
      <tr class=" bg-gray-50 border-b">
        <td class="px-6 py-4">{{ $loop->iteration }}</td>
        <td class="px-6 py-4 capitalize">{{ $category->category }}</td>
        <td class="px-6 py-4 text-center flex justify-center">
          <a href="/category-edit/{{ $category->slug }}"
            class="text-white bg-yellow-400 hover:bg-yellow-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Edit</a>
          <form action="/category-delete/{{ $category->slug }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit"
              class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
              onclick="return confirm('Are you sure?')">Delete</button>
          </form>
        </td>
      </tr>
      @endif
      @endforeach
      @endif
    </tbody>
  </table>
</div>
@endsection