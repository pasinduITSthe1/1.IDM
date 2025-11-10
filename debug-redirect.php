<?php
// Debug the 302 redirect
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost/guest-api/upload-attachments.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'id_customer' => 94,
    'attachment_type' => 'id_front',
    'file_path' => '/storage/emulated/0/IDM/TEST123/front.jpg'
]));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true); // Include headers in response
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false); // Don't follow redirects

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: " . $httpCode . "\n";
echo "Full Response with Headers:\n";
echo $response;
?>