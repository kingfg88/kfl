<?php
header("Content-Type:application/json");

$output = [];

$user_name = $_REQUEST['user_name'];
$phone = $_REQUEST['phone'];
$addr = $_REQUEST['addr'];
$sex = $_REQUEST['sex'];
$did = $_REQUEST['did'];
$order_time = time()*1000;

if(empty($user_name) || empty($phone)
|| empty($addr) || empty($did) || empty($sex))
{
    echo '[]';
    return;
}

$conn = mysqli_connect('127.0.0.1','root','','kaifanla');
$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);

$sql = "INSERT INTO kf_order VALUES(NULL,'$phone','$user_name','$sex','$order_time','$addr','$did')";
$result = mysqli_query($conn,$sql);

$arr = [];

if($result)
{
  $arr['msg'] = 'succ';
  $arr['oid'] =  mysqli_insert_id($conn);
}
else
{
   $arr['msg'] = 'err';
   $arr['reason'] = "SQL���ִ��ʧ��:$sql";
}

$output[] = $arr;

echo json_encode($output);

?>


