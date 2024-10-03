<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gmail Account Verification</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-md bg-white shadow-md rounded-lg p-8">
    <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Email Verification</h2>

    <?php $LAVA = &lava_instance(); ?>
    <?php echo $LAVA->form_validation->errors(); ?>
    <?php if (isset($success_message)) { ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        <?php echo $success_message; ?>
      </div>
    <?php } ?>
    <?php if (isset($error_message)) { ?>
      <div id="message-container" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-center">
        <?php echo $error_message; ?>
      </div>
    <?php } ?>

    <!-- Verification Form -->
    <form action="/check" method="POST">
      <div class="mb-4">
        <label for="verify" class="block text-sm font-medium text-gray-700">Verification Code</label>
        <input type="text" id="verify" name="verify" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter verification code" required>
        <input type="hidden" name="email" value="<?= $email ?>">
      </div>
      <div class="mt-6">
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out transform hover:scale-105">Submit</button>
      </div>
    </form>
  </div>

  <script>
    setTimeout(function() {
      const messageContainer = document.getElementById('message-container');
      if (messageContainer) {
        messageContainer.style.display = 'none';
      }
    }, 2000);
  </script>
</body>

</html>