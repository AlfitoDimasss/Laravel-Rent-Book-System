<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Login Form</title>
</head>

<body>
  <div class="flex justify-center content-center h-screen items-center">
    <div class="w-full max-w-xs">
      @if ($msg = Session::get('success'))
      <div class="bg-green-200 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-5" role="alert">
        <strong>{{ $msg }}</strong>
      </div>
      @endif
      @if ($msg = Session::get('status'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
        <strong>{{ $msg }}</strong>
      </div>
      @endif
      <h1 class="text-5xl font-bold text-center mb-10">LOGIN</h1>
      <form class="bg-gray-200 shadow-md rounded px-8 pt-6 pb-8 mb-4" action="" method="POST">
        @csrf
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
            Username
          </label>
          <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="username" name="username" type="text" placeholder="Username" required>
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            Password
          </label>
          <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
            id="password" name="password" type="password" placeholder="******************" required>
        </div>
        <div class="flex items-center justify-between">
          <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit">
            Login
          </button>
          <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/register">
            Sign Up
          </a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>