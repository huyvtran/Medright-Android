<?php

require_once('config.php');

$request_arr = json_decode( file_get_contents('php://input') );


$page = $_GET["PageNumber"];
$items_per_page = 10; 
$offset = ($page - 1) * $items_per_page;
$UserId = $request_arr->Angular_UserId;

$result = mysqli_query($con, "SELECT tbl_users.UserId, tbl_users.FirstName, tbl_users.LastName, notes.* FROM notes INNER JOIN tbl_users ON tbl_users.UserId=notes.PatientId WHERE notes.UserId='$UserId' LIMIT $offset, $items_per_page");

$PatientNotes = array();

while ($row = mysqli_fetch_array($result)) {
   $PatientNotes[] = $row;
}

echo json_encode($PatientNotes);
?>