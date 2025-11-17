<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pixel-Registration</title>
  <title>Registration Site</title>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

    body {
      margin: 0;
      padding: 0;
      font-family: 'Press Start 2P', cursive;
      background: url('https://i.pinimg.com/originals/04/14/87/0414874d9c531d082636ffcb37b217da.png') no-repeat center center fixed;
      background-size: cover;
      image-rendering: pixelated;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #222;
    }

    .form-container {
      background-color: rgba(20, 20, 40, 0.85);
      border: 4px solid #444;
      box-shadow: 6px 6px 0px #000;
      padding: 30px;
      width: 420px;
      max-width: 90%;
      text-align: center;
      /* Animation */
      opacity: 0;
      transform: translateY(40px) scale(0.98);
      animation: fadeInUp 1s cubic-bezier(.42, 0, .58, 1) forwards;
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    input[type="submit"] {
      width: 100%;
      padding: 14px;
      background-color: #1e90ff;
      color: #fff;
      font-family: 'Press Start 2P', cursive;
      font-size: 10px;
      border: 2px solid #000;
      box-shadow: 3px 3px 0 #003366;
      cursor: pointer;
      transition: background-color 0.2s, transform 0.1s;
      /* Animation for press */
    }

    input[type="submit"]:active {
      transform: scale(0.96);
      box-shadow: 1px 1px 0 #003366;
    }

    .link {
      display: block;
      margin-top: 15px;
      font-size: 10px;
      text-decoration: none;
      color: #aaccff;
      position: relative;
      overflow: hidden;
    }

    .link::after {
      content: "";
      display: block;
      position: absolute;
      left: 0;
      bottom: 0;
      width: 0;
      height: 2px;
      background: #aaccff;
      transition: width 0.3s;
    }

    .link:hover::after {
      width: 100%;
    }

    .link:hover {
      color: #ffffff;
    }

    h2 {
      font-size: 14px;
      margin-bottom: 25px;
      color: #228B22;
      text-transform: uppercase;
    }

    label {
      display: block;
      font-size: 10px;
      margin: 12px 0 5px;
      color: #dededeff;
      text-align: left;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 12px;
      font-family: 'Press Start 2P', cursive;
      font-size: 10px;
      border: 2px solid #444;
      background-color: #f0f0f0;
      box-shadow: inset 2px 2px 0 #ccc;
      outline: none;
      color: #222;
      transition: border-color 0.3s ease;
    }

    input:focus {
      border-color: #66ccff;
    }

    input[type="submit"] {
      width: 100%;
      padding: 14px;
      background-color: #00b894;
      color: #fff;
      font-family: 'Press Start 2P', cursive;
      font-size: 10px;
      border: 2px solid #000;
      box-shadow: 3px 3px 0 #00796b;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    input[type="submit"]:hover {
      background-color: #00e6b8;
    }

    .link {
      display: block;
      margin-top: 15px;
      font-size: 10px;
      text-decoration: underline;
      color: #0066cc;
      transition: color 0.2s ease;
    }

    .link:hover {
      color: #ff6600;
    }
  </style>
</head>

<body>
  <div class="form-container">
    <form method="post">
      <h2>Registration</h2>

      <label>Username:</label>
      <input type="text" name="username" placeholder="Enter Username" required>

      <label>Email:</label>
      <input type="email" name="email" placeholder="Enter Email" required>

      <label>Password:</label>
      <input type="password" name="password" placeholder="Enter Password" required>

      <input type="submit" value="Register" class="submit-btn">

      <a href="index.php" class="link">Already Have An Account?Click Here!</a>
      <?php
      include 'config.php';

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["username"], $_POST["email"], $_POST["password"])) {
          $username = trim($_POST["username"]);
          $email = trim($_POST["email"]);
          $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

          $checkEmailSql = "SELECT id FROM users WHERE email = ?";
          $checkStmt = $conn->prepare($checkEmailSql);
          $checkStmt->bind_param("s", $email);
          $checkStmt->execute();
          $checkStmt->store_result();

          if ($checkStmt->num_rows > 0) {
            echo "<script>alert('This email is already registered. Please use a different email.');</script>";
          } else {

            $insertSql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            if ($insertStmt) {
              $insertStmt->bind_param("sss", $username, $email, $password);
              if ($insertStmt->execute()) {
                header("Location: index.php?registered=1");
                exit;
              } else {
                echo "Error: " . $insertStmt->error;
              }
              $insertStmt->close();
            } else {
              echo "Error preparing statement: " . $conn->error;
            }
          }

          $checkStmt->close();
        } else {
          echo "Please fill in all required fields.";
        }
      }
      ?>
    </form>
  </div>
</body>

</html>