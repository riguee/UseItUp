<?php
include 'connection.php';

$submitcomplaint = $conn->prepare("INSERT INTO complaints (subject, complaint) VALUES (?, ?)");
$submitcomplaint->bind_param("ss", $_POST['subject'], $_POST['complaint']);
$submitcomplaint->execute();

header("Location: complaint-form.php");
exit;