<?php
require_once("");

$username=$_REQUEST['username'];
$password=$_REQUEST['password'];

if($username=="" or $password=="")
{
	echo "用户名或者密码不正确";

}
else
{
	
}

session_start();
$_SESSION['s_username']=$username;
$query_user="select * from pb_user where username = '$username' and password = '$password'";

$db=new mysql();
$result = $db->query_exec($query_user);
$num_results=$result->num_rows;
?>

