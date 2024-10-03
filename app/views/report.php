<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submit a Report</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Water animation */
    .wave {
      position: absolute;
      width: 100%;
      height: 100px;
      bottom: 0;
      background: url('https://i.ibb.co/4V0VJ2G/wave.png') repeat-x;
      animation: animateWave 6s linear infinite;
    }

    .wave:nth-child(2) {
      bottom: 10px;
      opacity: 0.5;
      animation: animateWave 8s linear infinite;
    }

    @keyframes animateWave {
      0% {
        transform: translateX(0);
      }

      100% {
        transform: translateX(-1600px);
      }
    }

    .flood {
      position: relative;
      padding: 50px 0;
      background-color: #1E40AF;
      text-align: center;
      color: white;
      overflow: hidden;
    }

    .flood-text h1 {
      font-size: 2.5rem;
      font-weight: bold;
    }

    .flood-text p {
      margin-top: 1rem;
      font-size: 1.2rem;
    }

    .wave {
      bottom: 0;
      background: url('wave.svg') repeat-x;
    }
  </style>
</head>

<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-blue-900 p-4">
    <div class="container mx-auto flex justify-between items-center">
      <a href="#" class="text-white text-2xl font-semibold">Flood Monitoring</a>
      <div>
        <a href="/logout" class="text-white hover:text-gray-200 px-4">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section with Flood Animation -->
  <section class="flood relative">
    <div class="flood-text">
      <h1 class="font-bold text-4xl md:text-6xl">
        Stay Informed. Stay Safe.
      </h1>
      <p class="mt-4 text-lg">
        Monitor flood updates and be prepared to take action in case of emergency.
      </p>
      <a href="/report" class="mt-8 inline-block bg-yellow-500 text-blue-900 py-3 px-6 rounded-lg shadow hover:bg-yellow-400">
        Submit Reports
      </a>
    </div>

    <!-- Water animation layers -->
    <div class="wave"></div>
    <div class="wave"></div>
  </section>

  <?php if (isset($errors)): ?>
    <?php foreach ($errors as $error): ?>
      <?= $error ?>
    <?php endforeach; ?>
  <?php endif; ?>

  <!-- Form Section -->
  <section class="py-12">
    <div class="container mx-auto px-4">
      <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Submit a Report</h2>
        <form action="/report" method="POST" enctype="multipart/form-data">
          <!-- Name -->
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Your Name</label>
            <input type="text" id="name" name="name" required class="input-field mt-1 block w-full border-gray-300 rounded-md p-2" placeholder="Your Name">
          </div>

          <!-- Recipient Email -->
          <div class="mb-4">
            <label for="recipient_email" class="block text-sm font-medium text-gray-700">Recipient Email</label>
            <input type="email" id="recipient_email" name="recipient_email" required class="input-field mt-1 block w-full border-gray-300 rounded-md p-2" placeholder="Recipient Email">
          </div>

          <!-- Subject -->
          <div class="mb-4">
            <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
            <input type="text" id="subject" name="subject" required class="input-field mt-1 block w-full border-gray-300 rounded-md p-2" placeholder="Subject">
          </div>

          <!-- Content -->
          <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea id="content" name="content" rows="4" required class="input-field mt-1 block w-full border-gray-300 rounded-md p-2" placeholder="Write your content..."></textarea>
          </div>

          <div class="mb-4">
            <label for="userfile" class="block text-sm font-medium text-gray-700">Attachment</label>
            <input type="file" id="userfile" name="userfile" required class="input-field mt-1 block w-full border-gray-300 rounded-md p-2">
          </div>

          <button type="submit" value="upload" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out transform hover:scale-105">Submit Report</button>
        </form>
      </div>
    </div>
  </section>

</body>

</html>