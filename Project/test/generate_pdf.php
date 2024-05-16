<?php
// Include the TCPDF library
require_once('TCPDF/tcpdf.php');

// Collect form data, including mobile number
$name = isset($_POST["name"]) ? $_POST["name"] : '';
$email = isset($_POST["email"]) ? $_POST["email"] : '';
$mobile = isset($_POST["mobile"]) ? $_POST["mobile"] : '';
$package = isset($_POST["package"]) ? $_POST["package"] : '';
$dateOfJourney = isset($_POST["dateOfJourney"]) ? $_POST["dateOfJourney"] : '';
$returndate  = isset($_POST["returndate"]) ? $_POST["returndate"] : '';
$numberOfPersons = isset($_POST["numberOfPersons"]) ? $_POST["numberOfPersons"] : 0;
$selectcar = isset($_POST["selectcar"]) ? $_POST["selectcar"] : 0;
$payment_done = isset($_POST["payment_done"]) ? $_POST["payment_done"] : 0;
$price = isset($_POST["price"]) ? $_POST["price"] : 0;
$numberOfRooms = ceil($numberOfPersons / 2);
$due_amount = $price - $payment_done;

// Create a PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($name);
$pdf->SetTitle($name);

// Add a page with a specific background color
$pdf->AddPage();
$pdf->SetFillColor(211, 211, 211); // Set background color: #D3D3D3

// Set font and styles
$pdf->SetFont('helvetica', '', 12);

// Get current date
$currentDate = date('Y-m-d');

// Set text color for the date
$pdf->SetTextColor(255, 20, 20); // Red color (adjust the values as needed)

// Add current date on top
$pdf->Cell(0, 2, 'Date -  ' . $currentDate, 0, 1, 'R');

// Reset text color to default
$pdf->SetTextColor(0, 0, 0); // Reset to black color

$pdf->Ln(1); // Add some space after the date

// Set Submission Details text color and font style
$pdf->SetTextColor(0, 113, 227); // Deep Blue Color
$pdf->SetFont('helvetica', 'B', 16);

// Add Image as part of the title
$imagePath = 'Asset/image.png'; // Replace with the actual path
$pdf->Image($imagePath, 15, 10, 24, 24); // Adjust the position and size of the image
$pdf->Cell(0, 10, 'Invoice Details', 0, 1, 'C');
$pdf->Ln(10); // Add space after the title and image

// Add Invoice Number with current timestamp
$pdf->SetTextColor(253, 106, 19); // Maroon Red Color
$pdf->SetFont('helvetica', 'B', 9);
$invoiceNumber = 'Invoice No: ' . time();
$digitaltimestamp = 'Digital Signature ID : ' . time();
$pdf->Cell(0, 6, $invoiceNumber, 0, 1, 'L');
$pdf->Cell(0, 6, $digitaltimestamp, 0, 1, 'L');

$pdf->Ln(0); // Add space after the invoice number

$pdf->SetFont('helvetica', '', 12);
$pdf->SetTextColor(51, 51, 51); // Reset text color

// Function to add cell without the top border
function addCellWithoutTopBorder($pdf, $label, $value)
{
    $pdf->Cell(40, 10, $label, 0, 0, 'L');
    $pdf->Cell(12, 10, $value, 0, 1, 'L');
}

// Function to add cell with background color
function addCellWithBackground($pdf, $label, $value)
{
    $pdf->SetFillColor(255, 255, 179); // Grey background color
    $pdf->Cell(40, 10, $label, 0, 0, 'L', 1); // 'L' indicates left alignment
    $pdf->Cell(00, 10, $value, 0, 1, 'L', 0); // '1' indicates to fill the cell with the background color
}

// Add rest of the form details
addCellWithoutTopBorder($pdf, 'Name: -', $name);
addCellWithoutTopBorder($pdf, 'Email:', $email);
// Add mobile number to the PDF
addCellWithoutTopBorder($pdf, 'Mobile:', '+91 ' . $mobile);
// Add calculated package to the PDF
addCellWithoutTopBorder($pdf, 'Package:', $package);
addCellWithBackground($pdf, 'Date of Journey:', $dateOfJourney);
addCellWithBackground($pdf, 'Return Date:', $returndate);
addCellWithoutTopBorder($pdf, 'Number of Persons:', $numberOfPersons);
addCellWithoutTopBorder($pdf, 'Rooms Required :', $numberOfRooms);

addCellWithoutTopBorder($pdf, 'Car No ( KOL ) :', 'WB 01N 3827 (K.Dutta)');
addCellWithoutTopBorder($pdf, 'Car No ( LOT8 ) :', 'WB 20B 2918 (S.Nayak)');

// Add calculated price to the PDF
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Total Price:', 0, 0, 'L');
$pdf->Cell(0, 10, 'Rs. ' . number_format($price), 0, 1, 'L');

// Add Paid price to the PDF
$pdf->Ln(2);
$pdf->Cell(40, 10, 'Booking Token:', 0, 0, 'L');
$pdf->Cell(0, 10, 'Rs. ' . number_format($payment_done), 0, 1, 'L');
$pdf->SetFont('helvetica', 'B', 14);

// Add DUE price to the PDF
$pdf->Ln(2);
$pdf->Cell(40, 10, 'Residue:', 0, 0, 'L');
$pdf->Cell(0, 10, 'Rs. ' . number_format($due_amount), 0, 1, 'L');

// Add authorized signatory section after the form details
$pdf->Ln(2); // Add space before authorized signatory
$pdf->SetFont('helvetica', 'B', 10);
// ... (previous code)

// Add signature image
$signaturePath = 'signature.png'; // Replace with the actual path
$pdf->Image($signaturePath, 150, $pdf->GetY() + 5, 40, 20); // Adjust the position and size of the signature image

// Add "Authorised Signatory:" beneath the signature
$pdf->Cell(0, 6, 'Authorised Signatory:', 0, 1, 'L');

$pdf->Ln(5); // Add space after the signature

// Add company information in the footer with padding at the bottom
$pdf->SetY(-45); // Set position near the bottom
$pdf->SetFont('helvetica', 'I', 8);
//$pdf->MultiCell(0, 10, 'GANGASAGAR Tourism', 0, 'C');
$pdf->MultiCell(0, 3, 'GANGASAGAR Tourism', 0, 'C'); // Centered "GANGASAGAR Tourism" text
$pdf->MultiCell(0, 10, 'Phone: 8145302135 | Email: suchibratapatra2003@gmail.com', 0, 'C');
$pdf->MultiCell(0, 10, 'Website: https://gangasagartourism.co.in/', 0, 'C');

// ... (remaining code)

// Set file name for the PDF
// Generate a more professional PDF file name based on invoice details
$invoiceFileName = 'Invoice_' . date('Ymd_His') . '_' . str_replace(' ', '_', $name) . '.pdf';

// Set the file path
$filename = __DIR__ . '/' . $invoiceFileName;

// Save the PDF to a file with the new name
$pdf->Output($filename, 'F');

// Send the PDF file to the browser for download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $invoiceFileName . '"');
readfile($filename);

// Delete the temporary PDF file
unlink($filename);
?>
