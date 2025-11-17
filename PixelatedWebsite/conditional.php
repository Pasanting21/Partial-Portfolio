<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Conditional with Many Ranges</title>
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  <style>
    body {
      background: url('cave.gif')no-repeat center center fixed;
      background-size: cover;
      color: #00ffcc;
      font-family: 'Press Start 2P', cursive;
      text-align: center;
      padding: 50px;
    }

    .link {
        display: inline-block;
        margin-bottom: 30px;
        padding: 10px 20px;
        font-family: 'Press Start 2P', cursive;
        font-size: 12px;
        color: #00ffcc;
        background-color: #000;
        border: 3px solid #00ffcc;
        text-decoration: none;
        box-shadow: 0 0 10px #00ffcc;
        transition: all 0.3s ease;
        animation: pulse 2s infinite;
    }

    .link:hover {
        background-color: #00ffcc;
        color: #000;
        transform: scale(1.05);
        box-shadow: 0 0 20px #00ffcc;
        cursor: pointer;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 5px #00ffcc; }
        50% { box-shadow: 0 0 15px #00ffcc; }
        100% { box-shadow: 0 0 5px #00ffcc; }
    }

    h3 {
      font-size: 16px;
      animation: bounce 1.5s infinite;
      margin-bottom: 30px;
      text-shadow: 2px 2px #000;
    }

    form {
      display: inline-block;
      background-color: #222;
      padding: 20px;
      border: 4px solid #00ffcc;
      box-shadow: 0 0 15px #00ffcc;
      animation: glow 2s infinite alternate;
    }

    input[type="number"],
    input[type="submit"] {
      font-family: 'Press Start 2P', cursive;
      font-size: 12px;
      padding: 10px;
      margin: 10px 0;
      border: 3px solid #00ffcc;
      background-color: #000;
      color: #00ffcc;
      width: 220px;
      box-shadow: inset 0 0 5px #00ffcc;
      transition: all 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #00ffcc;
      color: #000;
      transform: scale(1.05);
      cursor: pointer;
    }

    .result {
      margin-top: 30px;
      font-size: 14px;
      color: #ffcc00;
      text-shadow: 1px 1px #000;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes glow {
      from { box-shadow: 0 0 5px #00ffcc; }
      to { box-shadow: 0 0 20px #00ffcc; }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
    }
  </style>
</head>
<body>
    <a href="dashboard.php" class="link">Back to Dashboard</a>
  <h3>Please Input Your Score</h3>
  <form method="post">
    Enter your score:<br>
    <input type="number" name="score" required><br><br>
    <input type="submit" value="Check">
  </form>

  <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $score = $_POST['score'];
      echo "<div class='result'>";
      if ($score >= 95 && $score <= 100) {
        echo "🎉 Excellent!";
      } elseif ($score >= 90 && $score <= 94) {
        echo "👏 Very Good!";
      } elseif ($score >= 85 && $score <= 89) {
        echo "🙂 Fair!";
      } elseif ($score >= 80 && $score <= 84) {
        echo "🔧 Needs Improvements!";
      } elseif ($score >= 75 && $score <= 79) {
        echo "💪 Needs Effort!";
      } elseif ($score >= 70 && $score <= 74) {
        echo "📚 Poor - You need to study harder!";
      } elseif ($score >= 65 && $score <= 69) {
        echo "😟 Very Poor - Extra effort is required!";
      } elseif ($score >= 60 && $score <= 64) {
        echo "😐 Below Average - Don't give up!";
      } elseif ($score >= 55 && $score <= 59) {
        echo "🧭 Weak Performance - Needs Guidance!";
      } elseif ($score >= 50 && $score <= 54) {
        echo "🆘 Struggling - Seek help from teacher.";
      } elseif ($score >= 45 && $score <= 49) {
        echo "⚠️ Very Weak - Focus on basics.";
      } elseif ($score >= 40 && $score <= 44) {
        echo "🚨 At Risk - Consider remedial classes.";
      } elseif ($score >= 35 && $score <= 39) {
        echo "🔴 Critical - Immediate improvement needed!";
      } elseif ($score >= 30 && $score <= 34) {
        echo "❌ Failing - Strong intervention required.";
      } elseif ($score >= 0 && $score <= 29) {
        echo "💀 Failed - Must retake the course.";
      } else {
        echo "🤔 Invalid score. Please enter between 0 and 100.";
      }
      echo "</div>";
    }
  ?>
</body>
</html>