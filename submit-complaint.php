<?php
$conn = include 'connection.php';
session_start();
$submitcomplaint = $conn->prepare("INSERT INTO complaints (id, subject, complaint) VALUES (NULL, ?, ?)");
$submitcomplaint->bind_param("ss", $_POST['subject'], $_POST['complaint']);
$submitcomplaint->execute();

header("Location: complaint-form.php");

$_SESSION['problem'] = true;

exit;