@extends('layouts.mainLayout')

@section('title', 'Rent Logs')

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
<h1 class="text-5xl font-bold mb-10">My Rent Logs</h1>
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
        <th scope="col" class="px-6 py-3">Book Title</th>
        <th scope="col" class="px-6 py-3">Rent Date</th>
        <th scope="col" class="px-6 py-3">Return Date</th>
        <th scope="col" class="px-6 py-3">Actual Return Date</th>
        <th scope="col" class="px-6 py-3">Status</th>
        <th scope="col" class="px-6 py-3">Action</th>
      </tr>
    </thead>
    <tbody>
      @if ($rentLogs == null)
      <tr>
        <th colspan="7" style="text-align: center" class="px-6 py-4 border-b">No Data.</th>
      </tr>
      @else
      @foreach ($rentLogs as $rentLog)
      @if ($loop->iteration % 2 == 1)
      <tr class="bg-white border-b">
        <td class="px-6 py-4">{{ $loop->iteration }}</td>
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
          <p>-</p>
        </td>
      </tr>
      @else
      <tr class=" bg-gray-50 border-b">
        <td class="px-6 py-4">{{ $loop->iteration }}</td>
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
          <p>-</p>
        </td>
      </tr>
      @endif
      @endforeach
      @endif
    </tbody>
  </table>
</div>
@endsection