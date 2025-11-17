<?php 
session_start();

if (!isset($_SESSION["username"])) {
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pixel Dashboard</title>
  <meta charset="UTF-8">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      padding: 0;
      font-family: 'Press Start 2P', cursive;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      image-rendering: pixelated;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      transition: background 0.5s ease;
    }

    body.day {
      background-image: url('https://i.pinimg.com/originals/04/14/87/0414874d9c531d082636ffcb37b217da.png');
      color: #065535;
    }

    body.night {
      background-image: url('https://wallpaperaccess.com/full/1719750.png');
      color: #a0d8ef;
    }

    .Container {
      background: rgba(255, 255, 255, 0.85);
      border: 5px solid #000;
      padding: 40px;
      width: 480px;
      max-width: 90vw;
      box-shadow: 6px 6px 0 #444;
      text-align: center;
      position: relative;
      animation: floatUp 1s ease-out;
      border-radius: 8px;
      user-select: none;
      transition: background-color 0.5s ease, color 0.5s ease;
    }

    body.night .Container {
      background: rgba(0, 0, 30, 0.8);
      box-shadow: 6px 6px 0 #222;
    }

    @keyframes floatUp {
      from {
        transform: translateY(40px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    h1 {
      font-size: 20px;
      margin: 0 0 20px 0;
    }
    h2 {
      font-size: 12px;
      margin: 0 0 10px 0;
      font-weight: normal;
    }

    .avatar {
      width: 96px;
      height: 96px;
      image-rendering: pixelated;
      margin: 0 auto 20px;
      border: 3px solid #000;
      box-shadow: 3px 3px 0 #333;
      border-radius: 8px;
      background: url('https://www.avatarsinpixels.com/minipix/eyJNb3V0aCI6IjEwIiwiU2hvZXMiOiIxIiwiUGFudHMiOiIxIiwiVG9wIjoiMTMiLCJIYWlyIjoiOCIsInNraW5Ub25lIjoiYTk2MDMwIiwiZXllc1RvbmUiOiI2ZDMxMGEiLCJwYW50c1RvbmUiOiIwMDRmNzMiLCJ0b3BUb25lIjoiNjk2OTY5Iiwic2hvZXNUb25lIjoiMzQzNDM0In0=;/5/show.png') no-repeat center center;
      background-size: contain;
    }

    .stats {
      display: flex;
      justify-content: space-around;
      margin-bottom: 25px;
    }
    .stat {
      background: #00b894;
      border: 2px solid #000;
      box-shadow: 3px 3px 0 #00796b;
      padding: 15px;
      width: 120px;
      border-radius: 6px;
      color: #fff;
      font-size: 11px;
      transition: background 0.3s;
      cursor: default;
      user-select: none;
    }
    body.night .stat {
      background: #034f4f;
      box-shadow: 3px 3px 0 #012f2f;
      color: #a0d8ef;
    }
    .stat:hover {
      background: #00e6b8;
      box-shadow: 4px 4px 0 #004d40;
      color: #000;
    }
    body.night .stat:hover {
      background: #06e0e0;
      color: #000;
      box-shadow: 4px 4px 0 #003636;
    }

    #LO {
      display: inline-block;
      padding: 12px 22px;
      margin: 10px;
      font-size: 10px;
      font-family: 'Press Start 2P', cursive;
      text-decoration: none;
      color: #fff;
      background-color: #00b894;
      border: 3px solid #000;
      box-shadow: 4px 4px 0 #00796b;
      transition: all 0.2s ease;
      user-select: none;
      border-radius: 4px;
    }

    #LO:hover {
      background-color: #00e6b8;
      color: #000;
      box-shadow: 5px 5px 0 #004d40;
    }
    body.night #LO {
      background-color: #034f4f;
      box-shadow: 4px 4px 0 #012f2f;
    }
    body.night #LO:hover {
      background-color: #06e0e0;
      color: #000;
      box-shadow: 5px 5px 0 #003636;
    }

    .toggle-container {
      position: absolute;
      top: 15px;
      right: 15px;
      display: flex;
      align-items: center;
      font-size: 10px;
      user-select: none;
      cursor: pointer;
      color: inherit;
    }
    .toggle-switch {
      margin-left: 8px;
      width: 40px;
      height: 20px;
      background: #00b894;
      border-radius: 20px;
      position: relative;
      transition: background 0.3s;
    }
    .toggle-switch::before {
      content: '';
      position: absolute;
      top: 2px;
      left: 2px;
      width: 16px;
      height: 16px;
      background: #fff;
      border-radius: 50%;
      transition: transform 0.3s;
      box-shadow: 0 0 2px rgba(0,0,0,0.3);
    }
    .toggle-switch.active {
      background: #034f4f;
    }
    .toggle-switch.active::before {
      transform: translateX(20px);
    }

    .cloud {
      position: absolute;
      top: 50px;
      left: -100px;
      width: 120px;
      height: 60px;
      background: url('https://www.pngkey.com/png/full/1-15550_clouds-pixel-clouds-transparent.png') no-repeat;
      background-size: contain;
      animation: cloudMove 60s linear infinite;
      opacity: 0.8;
      image-rendering: pixelated;
    }
    .cloud:nth-child(3) {
      top: 120px;
      left: -200px;
      animation-delay: 15s;
      animation-duration: 80s;
    }

    .cloud1 {
      position: absolute;
      top: 50px;
      left: -100px;
      width: 120px;
      height: 60px;
      background: url('https://png.pngtree.com/png-clipart/20231026/original/pngtree-nube-pixel-art-png-image_13436335.png') no-repeat;
      background-size: contain;
      animation: cloudMove 50s linear infinite;
      opacity: 0.8;
      image-rendering: pixelated;
    }

    .cloud2 {
      position: absolute;
      top: 50px;
      left: -100px;
      width: 120px;
      height: 60px;
      background: url('https://img.genial.ly/6419d3fb244f7e00181ce354/483319ec-b042-42c0-a38f-54eef90e9222.png') no-repeat;
      background-size: contain;
      animation: cloudMove 40s linear infinite;
      opacity: 0.8;
      image-rendering: pixelated;
    }

    @keyframes cloudMove {
      0% {
        transform: translateX(0);
      }
      100% {
        transform: translateX(150vw);
      }
    }

    .action-buttons {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      justify-content: center;
      margin-top: 18px;
      margin-bottom: 8px;
    }

    .lo-btn {
      display: flex;
      align-items: center;
      gap: 7px;
      padding: 12px 20px;
      font-size: 11px;
      font-family: 'Press Start 2P', cursive;
      text-decoration: none;
      color: #fff;
      background: linear-gradient(90deg, #00b894 70%, #00e6b8 100%);
      border: 3px solid #000;
      box-shadow: 4px 4px 0 #00796b;
      border-radius: 6px;
      transition: all 0.18s;
      margin: 0;
      min-width: 170px;
      justify-content: center;
    }

    .lo-btn span {
      font-size: 15px;
    }

    .lo-btn:hover {
      background: linear-gradient(90deg, #00e6b8 70%, #00b894 100%);
      color: #000;
      box-shadow: 5px 5px 0 #004d40;
      transform: translateY(-2px) scale(1.04);
    }

    .lo-btn.logout {
      background: linear-gradient(90deg, #ff7675 70%, #fdcb6e 100%);
      box-shadow: 4px 4px 0 #b33939;
    }
    .lo-btn.logout:hover {
      background: linear-gradient(90deg, #fdcb6e 70%, #ff7675 100%);
      color: #000;
      box-shadow: 5px 5px 0 #b33939;
    }

    .lo-btn.change {
      background: linear-gradient(90deg, #0984e3 70%, #74b9ff 100%);
      box-shadow: 4px 4px 0 #2d3436;
    }
    .lo-btn.change:hover {
      background: linear-gradient(90deg, #74b9ff 70%, #0984e3 100%);
      color: #000;
      box-shadow: 5px 5px 0 #2d3436;
    }

    .lo-btn.pagination {
      background: linear-gradient(90deg, #fdcb6e 70%, #ffeaa7 100%);
      color: #222;
      box-shadow: 4px 4px 0 #b2bec3;
    }
    .lo-btn.pagination:hover {
      background: linear-gradient(90deg, #ffeaa7 70%, #fdcb6e 100%);
      color: #000;
      box-shadow: 5px 5px 0 #b2bec3;
    }

    .lo-btn.menu {
      background: linear-gradient(90deg, #636e72 70%, #b2bec3 100%);
      color: #fff;
      box-shadow: 4px 4px 0 #2d3436;
    }
    .lo-btn.menu:hover {
      background: linear-gradient(90deg, #b2bec3 70%, #636e72 100%);
      color: #000;
      box-shadow: 5px 5px 0 #2d3436;
    }

    .lo-btn.grade {
      background: linear-gradient(90deg, #00b894 70%, #55efc4 100%);
      box-shadow: 4px 4px 0 #00b894;
    }
    .lo-btn.grade:hover {
      background: linear-gradient(90deg, #55efc4 70%, #00b894 100%);
      color: #000;
      box-shadow: 5px 5px 0 #00b894;
    }

    .lo-btn.conditional {
      background: linear-gradient(90deg, #6c5ce7 70%, #a29bfe 100%);
      box-shadow: 4px 4px 0 #2d3436;
    }
    .lo-btn.conditional:hover {
      background: linear-gradient(90deg, #a29bfe 70%, #6c5ce7 100%);
      color: #000;
      box-shadow: 5px 5px 0 #2d3436;
    }

    @media (max-width: 600px) {
      .action-buttons {
        flex-direction: column;
        gap: 10px;
      }
      .lo-btn {
        min-width: 0;
        width: 100%;
        font-size: 10px;
        padding: 10px 0;
      }
    }
  </style>
</head>

<body class="day">

  <div class="cloud"></div>
  <div class="cloud1"></div>
  <div class="cloud2"></div>

  <div class="Container">

    <div class="toggle-container" onclick="toggleMode()" title="Toggle Day/Night Mode">
      <span>Day / Night</span>
      <div id="toggleSwitch" class="toggle-switch"></div>
    </div>

    <div class="avatar" title="Your Pixel Avatar"></div>

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
    <h1>🌤️ Your Pixel Art Dashboard</h1>

    <div class="stats">
      <div class="stat" title="Tasks completed">Tasks: 8</div>
      <div class="stat" title="Messages waiting">Messages: 3</div>
      <div class="stat" title="Current level">Level: 12</div>
    </div>

    <div class="action-buttons">
      <a href="change_password.php" class="lo-btn change"><span>🔑</span>Change Password</a>
      <a href="logout.php" class="lo-btn logout"><span>🚪</span>Log Out</a>
      <a href="pagination.php" class="lo-btn pagination"><span>📄</span>Pagination</a>
      <a href="menu.php" class="lo-btn menu"><span>📋</span>Menu</a>
      <a href="grade_checker.php" class="lo-btn grade"><span>📝</span>Grade Checker</a>
      <a href="conditional.php" class="lo-btn conditional"><span>🔢</span>Conditional Ranges</a>
    </div>

  </div>

  <script>
    const body = document.body;
    const toggleSwitch = document.getElementById('toggleSwitch');

    if (localStorage.getItem('mode') === 'night') {
      body.classList.replace('day', 'night');
      toggleSwitch.classList.add('active');
    }

    //To change mode Day/Night
    function toggleMode() {
      if (body.classList.contains('day')) {
        body.classList.replace('day', 'night');
        toggleSwitch.classList.add('active');
        localStorage.setItem('mode', 'night');
      } else {
        body.classList.replace('night', 'day');
        toggleSwitch.classList.remove('active');
        localStorage.setItem('mode', 'day');
      }
    }
  </script>

</body>
</html>