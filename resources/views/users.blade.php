@extends('layouts.mainLayout')

@section('title', 'Users')

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

<h1 class="text-5xl font-bold mb-10">Clients List</h1>

<div class="mb-10">
  <a href="/users-add"
    class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Add
    New Client</a>
</div>

<div class="relative overflow-x-auto">
  <table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
      <tr>
        <th scope="col" class="px-6 py-3">No</th>
        <th scope="col" class="px-6 py-3">Username</th>
        <th scope="col" class="px-6 py-3">Phone</th>
        <th scope="col" class="px-6 py-3">Address</th>
        <th scope="col" class="px-6 py-3">Status</th>
        <th scope="col" class="px-6 py-3">Action</th>
      </tr>
    </thead>
    <tbody>
      @if ($clients == null)
      <tr>
        <th colspan="4" style="text-align: center" class="px-6 py-4 border-b">No Data.</th>
      </tr>
      @else
      @foreach ($clients as $client)
      @if ($loop->iteration % 2 == 1)
      <tr class="bg-white border-b">
        <td class="px-6 py-4">{{ $loop->iteration }}</td>
        <td class="px-6 py-4 capitalize">{{ $client->username }}</td>
        <td class="px-6 py-4 capitalize">{{ $client->phone }}</td>
        <td class="px-6 py-4 capitalize">{{ $client->address }}</td>
        @if ($client->status == 'active')
        <td class="px-6 py-4 capitalize">
          <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $client->status
            }}</span>
        </td>
        @else
        <td class="px-6 py-4 capitalize">
          <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $client->status
            }}</span>
        </td>
        @endif
        <td class="px-6 py-4 flex">
          @if ($client->status == 'active')
          <form action="/user-delete/{{ $client->slug }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit"
              class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
              onclick="return confirm('Are you sure?')">Delete</button>
          </form>
          <form action="/user-ban/{{ $client->slug }}" method="POST">
            @method('PUT')
            @csrf
            <button type="submit"
              class="text-white bg-purple-700 hover:bg-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-2"
              onclick="return confirm('Are you sure?')">Ban</button>
          </form>
          @else
          <form action="/user-approve/{{ $client->slug }}" method="POST">
            @method('PUT')
            @csrf
            <button type="submit"
              class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
              onclick="return confirm('Are you sure?')">Approve</button>
          </form>
          @endif
        </td>
      </tr>
      @else
      <tr class=" bg-gray-50 border-b">
        <td class="px-6 py-4">{{ $loop->iteration }}</td>
        <td class="px-6 py-4 capitalize">{{ $client->username }}</td>
        <td class="px-6 py-4 capitalize">{{ $client->phone }}</td>
        <td class="px-6 py-4 capitalize">{{ $client->address }}</td>
        @if ($client->status == 'active')
        <td class="px-6 py-4 capitalize">
          <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $client->status
            }}</span>
        </td>
        @else
        <td class="px-6 py-4 capitalize">
          <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $client->status
            }}</span>
        </td>
        @endif
        <td class="px-6 py-4 flex">
          @if ($client->status == 'active')
          <form action="/user-delete/{{ $client->slug }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit"
              class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
              onclick="return confirm('Are you sure?')">Delete</button>
          </form>
          <form action="/user-ban/{{ $client->slug }}" method="POST">
            @method('PUT')
            @csrf
            <button type="submit"
              class="text-white bg-purple-700 hover:bg-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-2"
              onclick="return confirm('Are you sure?')">Ban</button>
          </form>
          @else
          <form action="/user-approve/{{ $client->slug }}" method="POST">
            @method('PUT')
            @csrf
            <button type="submit"
              class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
              onclick="return confirm('Are you sure?')">Approve</button>
          </form>
          @endif
        </td>
      </tr>
      @endif
      @endforeach
      @endif
    </tbody>
  </table>
</div>

{{-- ADMIN LIST --}}
<h1 class="text-5xl font-bold mt-10 mb-10">Admins List</h1>
<div class="relative overflow-x-auto">
  <table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
      <tr>
        <th scope="col" class="px-6 py-3">No</th>
        <th scope="col" class="px-6 py-3">Username</th>
        <th scope="col" class="px-6 py-3">Phone</th>
        <th scope="col" class="px-6 py-3">Address</th>
        <th scope="col" class="px-6 py-3">Status</th>
      </tr>
    </thead>
    <tbody>
      @if ($admins == null)
      <tr>
        <th colspan="4" style="text-align: center" class="px-6 py-4 border-b">No Data.</th>
      </tr>
      @else
      @foreach ($admins as $admin)
      @if ($loop->iteration % 2 == 1)
      <tr class="bg-white border-b">
        <td class="px-6 py-4">{{ $loop->iteration }}</td>
        <td class="px-6 py-4 capitalize">{{ $admin->username }}</td>
        <td class="px-6 py-4 capitalize">{{ $admin->phone }}</td>
        <td class="px-6 py-4 capitalize">{{ $admin->address }}</td>
        @if ($admin->status == 'active')
        <td class="px-6 py-4 capitalize">
          <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $admin->status
            }}</span>
        </td>
        @else
        <td class="px-6 py-4 capitalize">
          <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $admin->status
            }}</span>
        </td>
        @endif
      </tr>
      @else
      <tr class=" bg-gray-50 border-b">
        <td class="px-6 py-4">{{ $loop->iteration }}</td>
        <td class="px-6 py-4 capitalize">{{ $admin->username }}</td>
        <td class="px-6 py-4 capitalize">{{ $admin->phone }}</td>
        <td class="px-6 py-4 capitalize">{{ $admin->address }}</td>
        @if ($admin->status == 'active')
        <td class="px-6 py-4 capitalize">
          <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $admin->status
            }}</span>
        </td>
        @else
        <td class="px-6 py-4 capitalize">
          <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $admin->status
            }}</span>
        </td>
        @endif
      </tr>
      @endif
      @endforeach
      @endif
    </tbody>
  </table>
</div>
@endsection