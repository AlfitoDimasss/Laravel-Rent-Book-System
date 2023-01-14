@extends('layouts.mainLayout')

@section('title', 'Dashboard')

@section('content')
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
      </tr>
    </thead>
    <tbody>
      @if ($data['rent_log_count'] == 0)
      <tr>
        <th colspan="7" style="text-align: center" class="px-6 py-4 border-b">No Data.</th>
      </tr>
      @else
      @foreach ($data['rent_logs'] as $rentLog)
      <tr class="bg-white border-">
        <td class="px-6 py-4">{{ $loop->iteration }}</td>
        <td class="px-6 py-4 capitalize">{{ $rentLog->user->username }}</td>
        <td class="px-6 py-4">{{ $rentLog->book->title }}</td>
        <td class="px-6 py-4">{{ $rentLog->rent_date }}</td>
        <td class="px-6 py-4">{{ $rentLog->return_date }}</td>
        <td class="px-6 py-4">{{ $rentLog->actual_return_date }}</td>
        <td class="px-6 py-4">Finish</td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
</div>

</div>
@endsection