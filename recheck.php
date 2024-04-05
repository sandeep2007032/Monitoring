<?php
// Database connection
include 'db_connect.php';

// Function to check website status
function checkUrlStatus($url) {
    try {
        // Get headers
        $headers = @get_headers($url);

        if ($headers === false) {
            throw new Exception("Failed to fetch headers.");
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

// Check if website ID is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $websiteId = $_POST['id'];

    // Fetch URL of the website from the database
    $sql = "SELECT url FROM websites WHERE id = $websiteId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $url = $row["url"];

        // Recheck the status of the website
        $status_code = checkUrlStatus($url);

        // Update the last checked time in the database
        $updateSql = "UPDATE websites SET last_check_time = CURRENT_TIMESTAMP, status_code = $status_code WHERE id = $websiteId";

        if ($conn->query($updateSql) === TRUE) {
            echo "success";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Website not found.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
