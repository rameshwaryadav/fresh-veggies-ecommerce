<?php
// फाइल का पाथ: backend/config.php

// डेटाबेस क्रेडेंशियल्स
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'food_project');

// डेटाबेस से कनेक्ट करें
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// कनेक्शन की जाँच करें
if($conn->connect_error){
    die("ERROR: Could not connect. " . $conn->connect_error);
}

// सेशन तभी शुरू करें जब पहले से शुरू न हो
// यह लाइन हमेशा सभी कोड के ऊपर होनी चाहिए
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>