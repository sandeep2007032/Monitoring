$(document).ready(function() {
    // Handle form submission
    $("#websiteForm").submit(function(e) {
        e.preventDefault();
        var url = $("#urlInput").val();
        $.post("check_status.php", {url: url}, function(data) {
            alert(data); // Show status message
            // Refresh table
            loadWebsites();
        });
    });

    // Load monitored websites on page load
    loadWebsites();
});

// Function to load monitored websites
function loadWebsites() {
    $.get("get_websites.php", function(data) {
        $("#websiteTable tbody").html(data);
    });
}


$(document).ready(function() {
    var currentPage = 1;

    // Function to load data for a specific page
    function loadPage(pageNumber) {
        $.ajax({
            url: 'get_websites.php', // URL to fetch data from
            type: 'GET',
            data: { page: pageNumber }, // Send the page number as a parameter
            success: function(data) {
                $('#websiteTable tbody').html(data); // Replace the table body with the fetched data
            },
            error: function() {
                alert('Error loading data.');
            }
        });
    }

    // Initial load for the first page
    loadPage(currentPage);

    // Function to load the next page
    function loadNextPage() {
        currentPage++;
        loadPage(currentPage);
    }

    // Function to load the previous page
    function loadPrevPage() {
        if (currentPage > 1) {
            currentPage--;
            loadPage(currentPage);
        }
    }

    // Handle click on "Next" button
    $('#nextPage').on('click', function(e) {
        e.preventDefault();
        loadNextPage();
    });

    // Handle click on "Previous" button
    $('#prevPage').on('click', function(e) {
        e.preventDefault();
        loadPrevPage();
    });
});