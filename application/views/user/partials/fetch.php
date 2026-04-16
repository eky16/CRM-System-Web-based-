<?php
//fetch.php;
if(isset($_POST["view"]))
{
 include("connect.php");
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE tbl_notif SET status_baca=2 WHERE status_baca=1";
  mysqli_query($connect, $update_query);
 }
 
 $query_1 = "SELECT * FROM tbl_notif WHERE status_baca=1";
 $result_1 = mysqli_query($connect, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>