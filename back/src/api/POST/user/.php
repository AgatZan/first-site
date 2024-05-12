<?php
    header('Content-Type: application/json; charset=utf-8');
    $_SESSION['userName'] = $_POST['userName'];
    return json_encode($_SESSION);