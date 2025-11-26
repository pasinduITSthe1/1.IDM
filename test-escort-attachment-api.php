<?php
// Test the escort attachment API endpoint
$data = array(
    'id_escort' => 18,
    'attachment_type' => 'document_front',
    'file_path' => '/storage/emulated/0/IDM/ESCORT123/front.jpg'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost/guest-api/upload-escort-attachments.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: " . $httpCode . "\n";
echo "Response: " . $response . "\n";
?>