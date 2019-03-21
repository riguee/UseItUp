<!DOCTYPE html>
<html lang="en">
<head>
    <title>test2</title>
</head>
<body>
<form method="post" action="">
    <input type="text" name="test">
    <button type="submit">submit</button>
</form>
<?php
if (isset($_POST['test'])) {
    echo "<script> alert(\"".md5($_POST['test'])."\")</script>";
}
echo date("l");
?>
</body>
