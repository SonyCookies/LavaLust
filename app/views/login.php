<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Login</title>
  <style>
    .input-field {
      transition: all 0.3s ease;
    }

    .input-field:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
    }
  </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full transform transition-transform hover:scale-105">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Login</h2>
    <form action="/login" method="POST">
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" required class="input-field mt-1 block w-full border-gray-300 rounded-md p-2" placeholder="you@example.com">
      </div>
      <div class="mb-6">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" required class="input-field mt-1 block w-full border-gray-300 rounded-md p-2" placeholder="********">
      </div>
      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out transform hover:scale-105">Login</button>
    </form>
    <p class="mt-4 text-center text-sm text-gray-600">
      Don't have an account? <a href="/register" class="text-blue-500 hover:text-blue-600">Sign up</a>
    </p>
  </div>
</body>

</html>