<?php
// Include your DB connection file (adjust the filename if needed)
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $location = htmlspecialchars(trim($_POST["location"]));
    $eventDate = htmlspecialchars(trim($_POST["eventDate"]));
    $package = htmlspecialchars(trim($_POST["package"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Prepare SQL query
    $sql = "INSERT INTO enquiries (name, email, phone, location, event_date, package, message) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssssss", $name, $email, $phone, $location, $eventDate, $package, $message);
        if ($stmt->execute()) {
            // Redirect to success page or show confirmation
            echo "<script>alert('Enquiry submitted successfully!'); window.location.href='enquiry.html';</script>";
        } else {
            echo "Error executing query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
