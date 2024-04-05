<?php
include 'db_connect.php';

// Pagination parameters
$limit = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch monitored websites
$sql = "SELECT * FROM websites ORDER BY id DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $count = ($page - 1) * $limit + 1; // Calculate starting count for the current page
    while ($row = $result->fetch_assoc()) {
        $status_class = $row["status_code"] == 400 ? "error" : ""; // Check if status code is 400
        echo "<tr>";
        echo "<td>" . $count . "</td>"; // Display the count instead of the row ID
        echo "<td class='$status_class'>". $row["url"] . "</td>";
        echo "<td class='$status_class'>" . $row["status_code"] . "</td>"; // Apply CSS class based on status code
        echo "<td>" . $row["last_check_time"] . "</td>";
        echo "<td><button class='recheck-btn' data-id='" . $row["id"] . "'>Recheck</button> <a href='" . $row["url"] . "' target='_blank'><button>Visit</button></a></td>";
        echo "</tr>";
        $count++; // Increment the count for the next row
    }
} else {
    // If no websites are found, display a message in red
    echo "<tr class='error'><td colspan='5'>No websites found</td></tr>";
}

$conn->close();
?>




<script>
    // Function to handle recheck button click
    $(document).ready(function() {
        $(".recheck-btn").click(function() {
            var websiteId = $(this).data("id");
            $.ajax({
                url: "recheck.php",
                type: "POST",
                data: { id: websiteId },
                success: function(response) {
                    if (response === "success") {
                        alert("Website rechecked successfully!");
                        // Reload the page to update the last checked time
                        location.reload();
                    } else {
                        alert("Failed to recheck website.");
                    }
                },
                error: function() {
                    alert("An error occurred while rechecking the website.");
                }
            });
        });
    });
</script>