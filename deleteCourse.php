<?php 

include "connection.php";
session_start();
if(!isset($_GET['id']) ){ header("Location: index.php"); exit(); }
if(!isset($_SESSION['user:id'])){
    header("Location: login.php");
}

$course_id = (int)$_GET['id'];
$stm = $conn->prepare(" DELETE FROM `courses` WHERE id = $course_id ");
$stm->execute();
header("Location: courses.php")
?>