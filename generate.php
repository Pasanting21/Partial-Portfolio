<?php
require_once('tcpdf/config/db.php');
require_once('tcpdf/tcpdf.php');

// 🔌 Database connection
$host = 'localhost';
$db   = 'pdf_generator';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    ob_end_clean(); // Clean buffer before showing error
    die("Database connection failed: " . $e->getMessage());
}

// 📝 Get form data safely
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['author'], $_POST['year'], $_POST['product'], $_POST['product'], $_POST['paragraph'])) {
    $author = htmlspecialchars($_POST['author']);
    $year = (int)$_POST['year'];
    $product = htmlspecialchars($_POST['product']);
    $brand = htmlspecialchars($_POST['brand']);
    $paragraph = htmlspecialchars($_POST['paragraph']);
}

// 💾 Save to database
$stmt = $pdo->prepare("INSERT INTO reports (author, year, product, brand, paragraph) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$author, $year, $product, $brand, $paragraph]);

// 📄 Create PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($author);
$pdf->SetTitle('Product Report');
$pdf->SetMargins(20, 20, 20);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// 🎨 Styled HTML content
$html = "
<style>
    h1 { color: #2E86C1; }
    p { line-height: 1.6; }
    .label { font-weight: bold; color: #555; }
</style>
<h1>Product Report</h1>
<p><span class='label'>Author:</span> $author</p>
<p><span class='label'>Year:</span> $year</p>
<p><span class='label'>Product:</span> $product</p>
<p><span class='label'>Brand:</span> $brand</p>
<p><span class='label'>Details:</span></p>
<p>$paragraph</p>
";

$pdf->writeHTML($html, true, false, true, false, '');

ob_end_clean(); // Clean buffer before sending PDF
$pdf->Output('report.pdf', 'I');
?>