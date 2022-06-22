
<?php
extract($_REQUEST);
include('conn.php');

$sql = "select * from doc_file where id='$del'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$doc_id = $row['doc_id'];
unlink("upload/$doc_id");
$sql = "delete from doc_file where id='$del'";
mysqli_query($conn, $sql);
header("Location:index.php");
/*
$result = $conn->query($sql);

$row = $result->fetch();
unlink("upload/$row[doc_id]");

mysql_query("delete from doc_file where id='$del'");

header("Location:index.php");
*/
?>
