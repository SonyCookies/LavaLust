<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report Upload Success</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      margin-top: 50px;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 10px;
      background-color: #f9f9f9;
    }

    .success {
      color: green;
      font-size: 1.5em;
    }

    .filename {
      color: blue;
      margin-top: 10px;
    }

    .timer {
      color: red;
      margin-top: 20px;
    }

    .back-button {
      display: inline-block;
      padding: 10px 20px;
      margin-top: 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }
  </style>
  <script>
    setTimeout(function() {
      window.location.href = "/report";
    }, 5000);
  </script>
</head>

<body>
  <div class="container">
    <h1 class="success">Success!</h1>
    <p>Your report was uploaded and the email was sent successfully.</p>

    <p class="filename">Uploaded File: <?php echo htmlspecialchars($filename); ?></p>

    <p class="timer">You will be redirected back to the report page in 5 seconds...</p>

    <a href="report.php" class="back-button">Go Back to Report</a>
  </div>
</body>

</html>