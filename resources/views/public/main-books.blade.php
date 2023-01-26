@extends('layouts.mainLayout')

@section('title', 'Index')

@section('content')
<div class="h-full">
  {{-- SEARCH BAR --}}
  <div class="flex justify-end">
    <form action="" method="GET">
      <div class="flex gap-3">
        <div>
          <input type="title" id="title"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-60 p-2.5"
            placeholder="Book Title" name="title">
        </div>
        <button type="submit"
          class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Search</button>
      </div>
    </form>
  </div>
  {{-- END SEARCH BAR --}}

  {{-- BOOKS LIST --}}
  @if (isset($resultBooks))
  <div>
    <h2 class="text-3xl font-bold mb-3">Results</h2>
    <hr>
    <div class="grid grid-cols-8 gap-5 mt-5 mb-5">
      @foreach ($resultBooks as $book)
      <div class="flex flex-col items-center">
        {{-- Image --}}
        <div class="w-28 h-36 flex justify-center">
          <img
            src="{{ $book->cover == 'default.jpg' ? asset('images/default.jpg') : asset('storage/cover/' . $book->cover) }}"
            alt="">
        </div>
        <div class="flex flex-col items-center">
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
      </div>
      @endforeach
    </div>
  </div>
  <div class="mt-16 flex justify-center">
    <a href="/"
      class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 w-1/4 text-center">Back
      To Index</a>
  </div>
  @else
  {{-- Top Rated Books --}}
  <div>
    <h2 class="text-3xl font-bold mb-3">Top Rated</h2>
    <hr>
    <div class="grid grid-cols-8 gap-5 mt-5 mb-5">
      @foreach ($topBooks as $book)
      <div class="flex flex-col items-center">
        {{-- Image --}}
        <div class="w-28 h-36 flex justify-center">
          <img
            src="{{ $book->cover == 'default.jpg' ? asset('images/default.jpg') : asset('storage/cover/' . $book->cover) }}"
            alt="">
        </div>
        <div class="flex flex-col items-center">
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
        <div class="w-28 h-36 flex justify-center">
          <img
            src="{{ $book->cover == 'default.jpg' ? asset('images/default.jpg') : asset('storage/cover/' . $book->cover) }}"
            alt="">
        </div>
        <div class="flex flex-col items-center">
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
      </div>
      @endforeach
    </div>
  </div>
  <div class="mt-16 flex justify-center">
    <a href="/all"
      class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 w-1/4 text-center">Show
      All</a>
  </div>
  @endif
</div>
@endsection