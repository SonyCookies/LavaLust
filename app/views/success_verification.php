<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verification Success</title>
  <script>
    // Countdown and redirect logic
    let countdown = 3; // starting countdown from 3 seconds

    function updateCountdown() {
      document.getElementById('countdown').innerHTML = countdown;
      countdown--;

      if (countdown < 0) {
        window.location.href = '/login'; // Redirect to login
      } else {
        setTimeout(updateCountdown, 1000); // Update countdown every second
      }
    }

    window.onload = updateCountdown; // Start countdown on page load
  </script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
  <div class="min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full text-center">
      <h1 class="text-3xl font-bold text-green-500 mb-4">Email Verified Successfully!</h1>
      <p class="text-gray-700 mb-6">Your account has been successfully verified.</p>

      <!-- Countdown text -->
      <p class="text-gray-700 mb-6">Site will redirect you to login after <span id="countdown">3</span>...</p>

      <!-- Button to manually go to login page -->
      <a href="<?= site_url('login'); ?>" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
        Go to Login
      </a>
    </div>
  </div>
</body>

</html>
