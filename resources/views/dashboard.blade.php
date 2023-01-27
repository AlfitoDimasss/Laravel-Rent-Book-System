@extends('layouts.mainLayout')

@section('title', 'Dashboard')

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
<h1 class="text-5xl font-bold">Welcome, {{ Auth::user()->username }}</h1>
<div class="mb-5">
  <div class="grid grid-cols-3 gap-10 mt-5">
    <div class="h-auto bg-[#204b28] flex justify-between items-center p-8 text-white">
      <i class="fas fa-book text-7xl"></i>
      <div class="flex flex-col justify-center items-center gap-3">
        <h3 class="text-4xl">Books</h3>
        <h5 class="text-2xl">{{ $data['book_count'] }}</h5>
      </div>
    </div>
    <div class="h-auto bg-[#4b2043] flex justify-between items-center p-8 text-white">
      <i class="fas fa-list text-7xl"></i>
      <div class="flex flex-col justify-center items-center gap-3">
        <h3 class="text-4xl">Categories</h3>
        <h5 class="text-2xl">{{ $data['category_count'] }}</h5>
      </div>
    </div>
    <div class="h-auto bg-[#4b3d20] flex justify-between items-center p-8 text-white">
      <i class="fas fa-users text-7xl"></i>
      <div class="flex flex-col justify-center items-center gap-3">
        <h3 class="text-4xl">Users</h3>
        <h5 class="text-2xl">{{ $data['user_count'] }}</h5>
      </div>
    </div>
  </div>
</div>

<div class="mb-10">
  <a href="/rent-log-add"
    class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Add
    New Rent</a>
</div>

<div class="relative overflow-x-auto">
  <table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
      <tr>
        <th scope="col" class="px-6 py-3">No</th>
        <th scope="col" class="px-6 py-3">User</th>
        <th scope="col" class="px-6 py-3">Book Title</th>
        <th scope="col" class="px-6 py-3">Rent Date</th>
        <th scope="col" class="px-6 py-3">Return Date</th>
        <th scope="col" class="px-6 py-3">Actual Return Date</th>
        <th scope="col" class="px-6 py-3">Status</th>
        <th scope="col" class="px-6 py-3">Action</th>
      </tr>
    </thead>
    <tbody>
      @if ($data['rent_log_count'] == 0)
      <tr>
        <th colspan="7" style="text-align: center" class="px-6 py-4 border-b">No Data.</th>
      </tr>
      @else
      @foreach ($data['rent_logs'] as $rentLog)
      @if ($loop->iteration % 2 == 1)
      <tr class="bg-white border-b">
        <td class="px-6 py-4">{{ $loop->iteration }}</td>
        <td class="px-6 py-4 capitalize">{{ $rentLog->user->username }}</td>
        <td class="px-6 py-4">{{ $rentLog->book->title }}</td>
        <td class="px-6 py-4">{{ $rentLog->rent_date }}</td>
        <td class="px-6 py-4">{{ $rentLog->return_date }}</td>
        <td class="px-6 py-4">{{ $rentLog->actual_return_date ? $rentLog->actual_return_date : '-' }}</td>
        <td class="px-6 py-4">
          @if ($rentLog->status == 'borrowed')
          <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $rentLog->status
            }}</span>
          @elseif($rentLog->status == 'returned')
          <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $rentLog->status
            }}</span>
          @else
          <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $rentLog->status
            }}</span>
          @endif
        </td>
        <td class="px-6 py-4">
          @if ($rentLog->status == 'borrowed')
          <form action="/rent-log-return/{{ $rentLog->id }}" method="POST" class="mt-5">
            @method('PUT')
            @csrf
            <button type="submit"
              class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
              onclick="return confirm('Are you sure?')">Returned</button>
          </form>
          @elseif($rentLog->status == 'in progress')
          <form action="/rent-log-borrow/{{ $rentLog->id }}" method="POST" class="mt-5">
            @method('PUT')
            @csrf
            <button type="submit"
              class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
              onclick="return confirm('Are you sure?')">Borrowed</button>
          </form>
          @else
          <p>-</p>
          @endif
        </td>
      </tr>
      @else
      <tr class="bg-gray-50 border-b">
        <td class="px-6 py-4">{{ $loop->iteration }}</td>
        <td class="px-6 py-4 capitalize">{{ $rentLog->user->username }}</td>
        <td class="px-6 py-4">{{ $rentLog->book->title }}</td>
        <td class="px-6 py-4">{{ $rentLog->rent_date }}</td>
        <td class="px-6 py-4">{{ $rentLog->return_date }}</td>
        <td class="px-6 py-4">{{ $rentLog->actual_return_date ? $rentLog->actual_return_date : '-' }}</td>
        <td class="px-6 py-4">
          @if ($rentLog->status == 'borrowed')
          <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $rentLog->status
            }}</span>
          @elseif($rentLog->status == 'returned')
          <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $rentLog->status
            }}</span>
          @else
          <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $rentLog->status
            }}</span>
          @endif
        </td>
        <td class="px-6 py-4">
          @if ($rentLog->status == 'borrowed')
          <form action="/rent-log-return/{{ $rentLog->id }}" method="POST" class="mt-5">
            @method('PUT')
            @csrf
            <button type="submit"
              class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
              onclick="return confirm('Are you sure?')">Returned</button>
          </form>
          @elseif($rentLog->status == 'in progress')
          <form action="/rent-log-borrow/{{ $rentLog->id }}" method="POST" class="mt-5">
            @method('PUT')
            @csrf
            <button type="submit"
              class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
              onclick="return confirm('Are you sure?')">Borrowed</button>
          </form>
          @else
          <p>-</p>
          @endif
        </td>
      </tr>
      @endif
      @endforeach
      @endif
    </tbody>
  </table>
</div>

</div>
@endsection