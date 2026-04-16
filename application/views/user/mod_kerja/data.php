<?php
    $connect = mysqli_connect('localhost', 'root', '@Cassa123', 'tbl_test');;
    $sql = mysqli_query($connect, "SELECT * FROM tb_test");
    $result = array();
    
    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = $row;
    }

    echo json_encode(array("result" => $data));
?>