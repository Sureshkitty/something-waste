<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data with default values
    $name = isset($_POST['name']) ? $_POST['name'] : 'No name provided';
    $email = isset($_POST['email']) ? $_POST['email'] : 'No email provided';
    $message = isset($_POST['message']) ? $_POST['message'] : 'No message provided';

    // Print the received data for debugging
    echo "<h2>Form Data Received:</h2>";
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    echo "Message: $message<br>";

    // Google Apps Script Web App URL
    $url = 'https://script.google.com/macros/s/AKfycbx0dl7pgzWUeie2xG2pmy6T1NRHchugNfG1r7PT-w6b9GVmUQ_u_Kr42zLlBm3IDel-/exec';

    // Create a data array
    $data = array(
        'name' => $name,
        'email' => $email,
        'message' => $message
    );

    // Convert data to JSON
    $jsonData = json_encode($data);

    // Initialize cURL session
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // Execute the request and close the session
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if ($response === false) {
        echo "cURL Error: " . curl_error($ch);
    } else {
        echo "Response from Google Script: " . htmlspecialchars($response);
    }

    curl_close($ch);
} else {
    echo "No POST data received.";
}
?>
