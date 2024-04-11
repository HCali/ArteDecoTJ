<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set the recipient email address
    $to = "artedecotj@gmail.com";

    // Set the subject line for the email
    $subject = "New Inquiry from Arte Deco Website";

    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $message = $_POST['message'];

    // Validate form inputs
    if (empty($name) || empty($email) || empty($phone) || empty($date) || empty($message)) {
        // If any required fields are empty, display an error message
        echo "Error: All fields are required.";
        exit;
    }

    // Sanitize form inputs to prevent injection attacks
    $name = htmlspecialchars($name);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    $date = htmlspecialchars($date);
    $message = htmlspecialchars($message);

    // Create email body
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Date of Event: $date\n";
    $body .= "Message: $message\n";

    // Set headers
    $headers = "From: $name <$email>";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        // If the email is sent successfully, redirect to a thank you page or display a success message
        header("Location: thank_you.html");
        exit;
    } else {
        // If there's an error sending the email, display an error message
        echo "Error: Unable to send email. Please try again later.";
    }
} else {
    // If the request method is not POST, redirect to the homepage or display an error message
    header("Location: index.html");
    exit;
}
?>
