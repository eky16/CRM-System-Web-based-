<?php
//fetch.php;
$connect = mysqli_connect("localhost", "root", "@Cassa123", "cassa_project");
if(isset($_POST["view"]))
{
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE tbl_notif SET status_baca=2 WHERE status_baca=1";
  mysqli_query($connect, $update_query);
 }
 $query = "SELECT * FROM tbl_notif ORDER BY id_notif DESC LIMIT 5";
 $result = mysqli_query($connect, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <li>
    <a href="#">
     <strong>'.$row["dari"].'</strong><br />
     <small><em>'.$row["noted"].'</em></small>
    </a>
   </li>
   <li class="divider"></li>
   ';
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
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