<?php
$conn = include 'connection.php';
session_start();
$submitcomplaint = $conn->prepare("INSERT INTO complaints (subject, complaint, user_type, user_id) VALUES (?, ?, \"" . $_SESSION['user_type'] . "\", " . $_SESSION['id'] . ")");
$submitcomplaint->bind_param("ss", $_POST['subject'], $_POST['complaint']);
$submitcomplaint->execute();

header("Location: complaint-form.php");

$_SESSION['problem'] = true;

exit;