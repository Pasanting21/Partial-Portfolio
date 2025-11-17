<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Press Start 2P', cursive;
            background: url('8351186.gif') no-repeat center center fixed;
            background-size: cover;
            image-rendering: pixelated;
            min-height: 100vh;
            color: #222;
        }

        .GTDB {
            display: inline-block;
            margin: 24px 0 0 24px;
            padding: 10px 18px;
            background: #228B22;
            color: #fff;
            font-family: 'Press Start 2P', cursive;
            font-size: 12px;
            border: 2px solid #333;
            border-radius: 8px;
            text-decoration: none;
            box-shadow: 3px 3px 0 #555;
            transition: background 0.2s;
        }

        .GTDB:hover {
            background: #32CD32;
            color: #fff;
        }

        h2 {
            font-size: 18px;
            margin-top: 40px;
            color: #228B22;
            text-shadow: 2px 2px 0 #fff, 0 0 8px #228B22;
            text-align: center;
        }

        .btn {
            margin: 10px;
            padding: 16px 32px;
            font-size: 14px;
            font-family: 'Press Start 2P', cursive;
            border: 3px solid #333;
            background: #00b894;
            color: #fff;
            border-radius: 10px;
            box-shadow: 4px 4px 0 #555;
            cursor: pointer;
            transition: background 0.2s, box-shadow 0.2s;
        }

        .btn:hover {
            background: #00e6b8;
            box-shadow: 2px 2px 0 #00796b;
        }

        .container {
            margin: 40px auto 0 auto;
            background: rgba(255, 255, 255, 0.7);
            border: 4px solid #333;
            box-shadow: 8px 8px 0 #555;
            border-radius: 16px;
            width: 90%;
            max-width: 900px;
            min-height: 400px;
            text-align: center;
            padding: 30px 0;
        }

        iframe {
            width: 98%;
            height: 600px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            background: #f0f0f0;
        }

        .back-btn {
            display: block;
            margin: 24px auto 0 auto;
            padding: 10px 18px;
            background: #228B22;
            color: #fff;
            font-family: 'Press Start 2P', cursive;
            font-size: 12px;
            border: 2px solid #333;
            border-radius: 8px;
            text-decoration: none;
            box-shadow: 3px 3px 0 #555;
            transition: background 0.2s;
            text-align: center;
        }

        .back-btn:hover {
            background: #32CD32;
            color: #fff;
        }
    </style>
    <script>
        function showVariable(func) {
            document.getElementById('varFrame').src = 'variable.php?func=' + func;
            document.getElementById('varFrame').style.display = 'block';
        }

        function hideVariable() {
            document.getElementById('varFrame').style.display = 'none';
        }
    </script>
</head>

<body>
    <a href="dashboard.php" class="GTDB">Go back to dashboard</a>
    <h2>Menu</h2>
    <div style="text-align:center;">
        <button class="btn" onclick="showVariable('strlen')">strlen()</button>
        <button class="btn" onclick="showVariable('str_replace')">str_replace()</button>
        <button class="btn" onclick="showVariable('str_word_count')">str_word_count()</button>
        <button class="btn" onclick="showVariable('strpos')">strpos()</button>
        <button class="btn" onclick="showVariable('strrev')">strrev()</button>
        <button class="btn" onclick="showVariable('strtoupper')">strtoupper()</button>
        <button class="btn" onclick="showVariable('strtolower')">strtolower()</button>
        <button class="btn" onclick="showVariable('ucfirst')">ucfirst()</button>
        <button class="btn" onclick="showVariable('substr')">substr()</button>
        <button class="btn" onclick="showVariable('trim')">trim()</button>
    </div>
    <a href="menu.php" class="back-btn">Back to Menu</a>
    <div class="container">
        <iframe id="varFrame" style="display:none;"></iframe>
    </div>
</body>

</html>