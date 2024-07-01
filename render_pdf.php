<?php
// Check if the PDF data is received
if (isset($_POST['pdfData'])) {
    // Retrieve the PDF data from the POST request
    $pdfData = base64_decode($_POST['pdfData']);
    // $filename = "INDIACOM.pdf";

    // Set appropriate headers to tell the browser it's a PDF file and specify the filename
    ob_end_clean();
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . "Indiacom1" . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    header('Cache-Control: public');
    header('Pragma: public');
    header('Content-Length: ' . strlen($pdfData));

    // Output the PDF data directly to the browser
    echo $pdfData;
    exit;

} else {
    // Handle the case where PDF data is not received
    echo "PDF data not found.";
}


if (isset($_POST['pdf2Data'])) {
    // Retrieve the PDF data from the POST request
    $pdf2Data = base64_decode($_POST['pdf2Data']);
   // $filename = "INDIACOM.pdf";
    // Set appropriate headers to tell the browser it's a PDF file
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . "Indiacom" . '"');
    // header('Content-Disposition: inline; filename="document.pdf"');

    // Output the PDF data directly to the browser
    //echo $pdfData;
    echo $pdf2Data;
    exit;

} else {
    // Handle the case where PDF data is not received
    echo "PDF data not found.";
}

if (isset($_POST['pptData'])) {
    // Retrieve the PDF data from the POST request
    $pptData = base64_decode($_POST['pptData']);
   // $filename = "INDIACOM.pdf";
    // Set appropriate headers to tell the browser it's a PDF file
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . "Indiacom" . '"');
    // header('Content-Disposition: inline; filename="document.pdf"');

    // Output the PDF data directly to the browser
    //echo $pdfData;
    echo $pptData;
    exit;

} else {
    // Handle the case where PDF data is not received
    echo "PDF data not found.";
}

if (isset($_POST['CRCData'])) {
    // Retrieve the PDF data from the POST request
    $CRCData = base64_decode($_POST['CRCData']);
   // $filename = "INDIACOM.pdf";
    // Set appropriate headers to tell the browser it's a PDF file
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . "Indiacom" . '"');
    // header('Content-Disposition: inline; filename="document.pdf"');

    // Output the PDF data directly to the browser
    //echo $pdfData;
    echo $CRCData;
    exit;

} else {
    // Handle the case where PDF data is not received
    echo "PDF data not found.";
}

if (isset($_POST['CORGData'])) {
    // Retrieve the PDF data from the POST request
    $CORGData = base64_decode($_POST['CORGData']);
   // $filename = "INDIACOM.pdf";
    // Set appropriate headers to tell the browser it's a PDF file
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . "Indiacom" . '"');
    // header('Content-Disposition: inline; filename="document.pdf"');

    // Output the PDF data directly to the browser
    //echo $pdfData;
    echo $CORGData;
    exit;

} else {
    // Handle the case where PDF data is not received
    echo "PDF data not found.";
}

if (isset($_POST['copyrightData'])) {
    // Retrieve the PDF data from the POST request
    $copyrightData = base64_decode($_POST['copyrightData']);
   // $filename = "INDIACOM.pdf";
    // Set appropriate headers to tell the browser it's a PDF file
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . "Indiacom" . '"');
    // header('Content-Disposition: inline; filename="document.pdf"');

    // Output the PDF data directly to the browser
    //echo $pdfData;
    echo $copyrightData;
    exit;

} else {
    // Handle the case where PDF data is not received
    echo "PDF data not found.";
}
?>
