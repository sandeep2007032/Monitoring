<?php
// Database connection
include 'db_connect.php';

// Function to check the status of a URL
function checkUrlStatus($url) {
    try {
        // Get headers
        $headers = @get_headers($url);

        if ($headers === false) {
            throw new Exception("400");
        }

        // Extract status code
        $status_line = $headers[0];
        preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
        $status_code = isset($match[1]) ? $match[1] : null;

        return $status_code;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

// Check if URL parameter is provided for GET request
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['url'])) {
    $url = $_GET['url'];
    $status_code = checkUrlStatus($url);

    // Return JSON response
    echo json_encode(["url" => $url, "status_code" => $status_code]);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if URL parameter is provided for POST request
    if (isset($_POST['url'])) {
        $url = $_POST['url'];
        $status_code = checkUrlStatus($url);

        // Update status code in database
        $sql = "INSERT INTO websites (url, status_code) VALUES ('$url', $status_code)";
        if ($conn->query($sql) === TRUE) {
            echo "Status checked successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: URL parameter is missing.";
    }
}

$conn->close();
?>
