<?php

include'includes/connection.php';

$sql = "UPDATE notification SET status='1'";
$res = mysqli_query($db, $sql);
if ($res) {
  echo "Success";
} else {
  echo "Failed";
}
?>