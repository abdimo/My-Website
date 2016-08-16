<?php
include 'dbConfig.php';

$type=$_POST['type'];
$id=$_POST['id'];

if(isset($_COOKIE['rateLikeChnage'."_".$id]))
    echo "error|| You Already Voted";
else{
    if($type=='like'){
       $fieldName='like_count';
    }elseif($type=='dislike'){
       $fieldName='dislike_count';
    }else{
       die();
    }
    $query="update  YOUR_TABLE_NAME set $fieldName=$fieldName+1 where id='$id'";
    $res=mysql_query($query);
    
    $query="select $fieldName from  YOUR_TABLE_NAME where id='$id'";
    $res=mysql_query($query);
    $result=mysql_fetch_array($res);
    $count=$result[$fieldName];
    
    $expire=time()+60*60*24*30;
    setcookie("rateLikeChnage"."_".$id, "rateLikeChnage"."_".$id, $expire);
    echo "success||".$count;
}
?>