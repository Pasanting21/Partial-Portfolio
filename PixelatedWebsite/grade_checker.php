<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Grade Checker</title>
  <style>
    @keyframes floatUpDown {
      0% {
        transform: translateY(0);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
      }
      50% {
        transform: translateY(-15px);
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.6);
      }
      100% {
        transform: translateY(0);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
      }
    }

    body {
      margin: 0;
      height: 100vh;
      background: url('https://cdna.artstation.com/p/assets/images/images/041/639/586/original/phlusocosta-deserto.gif?1632266713') center center / cover no-repeat;
      image-rendering: pixelated;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      overflow: hidden;
    }

    .container {
      background: rgba(10, 10, 10, 0.85);
      padding: 2.5rem 3.5rem;
      border-radius: 20px;
      color: #f0f0f0;
      text-align: center;
      max-width: 360px;
      width: 90%;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.8);
      user-select: none;
    }

    h2 {
      font-weight: 700;
      margin-bottom: 1.5rem;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      text-shadow: 0 0 10px #4caf50;
    }

    input[type=number] {
      width: 100%;
      padding: 0.75rem 1rem;
      font-size: 1.1rem;
      margin-bottom: 1.5rem;
      border: none;
      border-radius: 12px;
      outline: none;
      box-shadow: inset 0 0 8px #4caf50aa;
      background: #111;
      color: #eee;
      transition: box-shadow 0.3s ease;
    }

    input[type=number]:focus {
      box-shadow: inset 0 0 12px #4caf50ff;
    }

    button {
      padding: 0.75rem 2rem;
      font-size: 1.1rem;
      cursor: pointer;
      border: none;
      border-radius: 12px;
      background: linear-gradient(135deg, #43a047, #66bb6a);
      color: white;
      font-weight: 600;
      box-shadow: 0 5px 15px #4caf50cc;
      transition: background 0.3s ease, box-shadow 0.3s ease;
      user-select: none;
    }

    button:hover {
      background: linear-gradient(135deg, #388e3c, #4caf50);
      box-shadow: 0 8px 25px #4caf50ee;
    }

    .result {
      margin-top: 1.5rem;
      padding: 0.9rem;
      border-radius: 12px;
      font-weight: 700;
      font-size: 1.3rem;
      text-transform: uppercase;
      letter-spacing: 1.3px;
      user-select: none;
      box-shadow: 0 0 10px;
    }

    .passed {
      background-color: #4caf5080;
      color: #d0f7d0;
      box-shadow: 0 0 15px #4caf50cc;
    }

    .failed {
      background-color: #f4433680;
      color: #f7c6c6;
      box-shadow: 0 0 15px #f44336cc;
    }

    .GTDB {
      position: fixed;
      top: 15px;
      left: 15px;
      color: #a5d6a7;
      font-weight: 700;
      background: linear-gradient(135deg, #2e7d32cc, #388e3ccc);
      padding: 0.75rem 1.25rem;
      border-radius: 14px;
      text-decoration: none;
      box-shadow: 0 6px 12px rgba(46, 125, 50, 0.7);
      transition: background 0.3s ease, transform 0.3s ease;
      user-select: none;
      animation: floatDown 4s ease-in-out infinite;
      z-index: 1000;
    }

    .GTDB:hover {
      background: linear-gradient(135deg, #1b5e20, #2e7d32);
      transform: translateY(-5px) scale(1.05);
      box-shadow: 0 10px 20px rgba(30, 110, 40, 0.85);
    }
  </style>
</head>

<body>
  <a href="dashboard.php" class="GTDB">Go back to dashboard</a>
  <div class="container">
    <h2>Grade Checker</h2>
    <form method="post">
      <input type="number" name="grade" placeholder="Enter grade" min="0" max="100" required />
      <button type="submit">Check</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $grade = intval($_POST["grade"]);

      if ($grade >= 75) {
        echo '<div class="result passed">passed</div>';
      } else {
        echo '<div class="result failed">failed</div>';
      }
    }
    ?>
  </div>
</body>

</html>