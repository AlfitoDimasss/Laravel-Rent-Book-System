@extends('layouts.mainLayout')

@section('title', 'Index')

@section('content')
<div class="h-full">
  {{-- Top Rated Books --}}
  <div>
    <h2 class="text-3xl font-bold mb-3">Top Rated</h2>
    <hr>
    <div class="grid grid-cols-8 gap-5 mt-5 mb-5">
      @foreach ($topBooks as $book)
      <div class="flex flex-col items-center">
        {{-- Image --}}
        <img src="./storage/cover/one-piece-2.jpg" alt="" width="120px" height="120px">

        {{-- Title --}}
        <h5 class="text-sm mt-2">{{ $book->title }}</h5>

        {{-- Categories --}}
        <div class="mb-0">
          @foreach ($book->categories as $category)
          @if ($loop->iteration != count($book->categories))
          <span class="text-xs text-gray-500 capitalize">{{ $category->category }}, </span>
          @else
          <span class="text-xs text-gray-500 capitalize">{{ $category->category }}</span>
          @endif
          @endforeach
        </div>

        {{-- Star Rating --}}
        <div>
          @for ($i = 0; $i < $book->rating; $i++) <span><i class="fas fa-star text-yellow-400"></i></span>
            @endfor
            @if ($book->rating != 5)
            <span><i class="fas fa-star"></i></span>
            @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>

  {{-- Latest Updated Books --}}
  <div>
    <h2 class="text-3xl font-bold mb-3">Latest Update</h2>
    <hr>
    <div class="grid grid-cols-8 gap-5 mt-5">
      @foreach ($latestBooks as $book)
      <div class="flex flex-col items-center">
        {{-- Image --}}
        <img
          src="{{ $book->cover == 'default.jpg' ? asset('images/default.jpg') : asset('storage/cover/' . $book->cover) }}"
          alt="" width="120px" height="120px">

        {{-- Title --}}
        <h5 class="text-sm mt-2">{{ $book->title }}</h5>

        {{-- Categories --}}
        <div class="mb-0">
          @foreach ($book->categories as $category)
          @if ($loop->iteration != count($book->categories))
          <span class="text-xs text-gray-500 capitalize">{{ $category->category }}, </span>
          @else
          <span class="text-xs text-gray-500 capitalize">{{ $category->category }}</span>
          @endif
          @endforeach
        </div>

        {{-- Star Rating --}}
        <div>
          @for ($i = 0; $i < $book->rating; $i++) <span><i class="fas fa-star text-yellow-400"></i></span>
            @endfor
            @if ($book->rating != 5)
            <?php $n = 5 - $book->rating ?>
            @for ($i = 0; $i < $n; $i++) <span><i class="fas fa-star"></i></span>
              @endfor
              @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="mt-16 flex justify-center">
    <a href="/all"
      class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 w-1/4 text-center">Show
      All</a>
  </div>
</div>
@endsection