<?php
require 'db_connect.php';

// Check if all fields are set and not empty
if (
    !isset(
        $_POST['client_id'], $_POST['lawyer_id'], $_POST['case_type'],
        $_POST['case_description'], $_POST['case_status'],
        $_POST['start_date'], $_POST['end_date']
    ) ||
    empty(trim($_POST['client_id'])) ||
    empty(trim($_POST['lawyer_id'])) ||
    empty(trim($_POST['case_type'])) ||
    empty(trim($_POST['case_description'])) ||
    empty(trim($_POST['case_status'])) ||
    empty(trim($_POST['start_date'])) ||
    empty(trim($_POST['end_date']))
) {
    echo "❌ Please fill all the fields.";
    exit;
}

// Get values
$client_id = trim($_POST['client_id']);
$lawyer_id = trim($_POST['lawyer_id']);
$case_type = trim($_POST['case_type']);
$case_description = trim($_POST['case_description']);
$case_status = trim($_POST['case_status']);
$start_date = trim($_POST['start_date']);
$end_date = trim($_POST['end_date']);

// Prepare SQL
$stmt = $conn->prepare("INSERT INTO cases (client_id, lawyer_id, case_type, case_description, case_status, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iisssss", $client_id, $lawyer_id, $case_type, $case_description, $case_status, $start_date, $end_date);

// Execute
if ($stmt->execute()) {
    echo "✅ Case submitted successfully!";
} else {
    echo "❌ Error submitting case: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>