<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Report Generator</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(-45deg, #f3f4f6, #e0f2fe, #dbeafe, #fef3c7);
      background-size: 600% 600%;
      animation: gradientMove 30s ease infinite;
    }

    @keyframes gradientMove {
    0% {
      background-position: 0% 50%;
    }
    50% {
      background-position: 100% 50%;
    }
    100% {
      background-position: 0% 50%;
      }
    }

    form {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(12px);
      padding: 20px;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
      transition: transform 0.3s ease;
    }

    form:hover {
      transform: scale(1.02);
    }

    h2 {
      text-align: center;
      margin-bottom: 24px;
      color: #1f2937;
      font-size: 24px;
      font-weight: 600;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #374151;
    }

    input[type="text"],
    input[type="number"],
    textarea {
      width: 100%;
      padding: 12px 14px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      background-color: #f9fafb;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus,
    textarea:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
      outline: none;
    }

    textarea {
      resize: vertical;
      min-height: 120px;
    }

    button {
      width: 100%;
      padding: 14px;
      background-color: #3b82f6;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease, box-shadow 0.2s ease;
    }

    button:hover {
      background-color: #2563eb;
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
    }

    h6 {
      text-align: center;
      color: #6b7280;
      font-size: 12px;
      margin-top: -10px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <form action="generate.php" method="POST">
  <h2>Generate PDF Report</h2>
  <label>Author:</label>
  <input type="text" name="author" required />
  <label>Year:</label>
  <input type="number" name="year" required />
  <label>Product:</label>
  <input type="text" name="product" required />
  <label>Brand:</label>
  <input type="text" name="brand" required />
  <label>Paragraph(Info about the product/brand):</label>
  <textarea name="paragraph" required></textarea>
  <br>
  <h6>only click once, don't double click please :></h6>
  <button type="submit">Generate PDF</button>
</form>
</body>
<script>
document.querySelector("form").addEventListener("submit", function(e) {
    this.querySelector("button[type='submit']").disabled = true;
});
</script>
</html>