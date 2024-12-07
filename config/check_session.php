<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['USERNAME']) && isset($_SESSION['MEMBER_ID']) && isset($_SESSION['MEMBER_IMAGE']);
$username = $_SESSION['USERNAME'] ?? '';
$memberID = $_SESSION['MEMBER_ID'] ?? '';
$memberImage = $_SESSION['MEMBER_IMAGE'] ?? '';

// if (!$isLoggedIn) {
//     header("Location: index.php");
//     exit();
// }
