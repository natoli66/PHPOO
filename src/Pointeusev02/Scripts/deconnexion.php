<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
</head>
<body>
<?php
session_start();
session_destroy();
header('Location: ../Public/index.php');

?>
</body>
</html>