<?php

header("Content-Type:application/json");

$output = [];

@$phone = @$_REQUEST['phone'];
if(empty($phone))
{
    echo '[]';
    return;
}

$conn = mysqli_connect('127.0.0.1','root','','kaifanla');
$sql = 'SET NAMES UTF8';
mysqli_query($conn,$sql);

$sql = "SELECT kf_order.oid,kf_order.user_name,kf_order.order_time,kf_dish.img_sm FROM kf_order,kf_dish WHERE kf_order.did=kf_dish.did AND kf_order.phone='$phone'";
$result = mysqli_query($conn,$sql);

while(true)
{
    $row = mysqli_fetch_assoc($result);
    if(!$row)
    {
        break;
    }
    $output[] = $row;
}

echo json_encode($output);

?>