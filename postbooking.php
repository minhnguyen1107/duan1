<?php
require_once "data/db.php";
session_start();
$id=$_POST['room'];
$soluong=$_POST['quantity'];
$date1 =  $_POST['checkout_date'];
$date2 = $_POST["checkin_date"];
$diff = abs(strtotime($date1) - strtotime($date2));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    echo $id;	
if($soluong==""|| $date1==""|| $date2==""|| $id==""){
	header("Location:./index.php?alert=bạn chưa nhập đủ thông tin");
}
if($days=0){
	header("Location:./index.php?alert=ngày checkout phải sau ngày checkin");

}
else{
	header("Location:./booking.php?id=$id && date1=$date1 && date2=$date2 && soluong=$soluong");
}