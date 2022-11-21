<?php
session_start();
echo "Hi " .$_SESSION['studentname'];
if(!isset($_SESSION['studentid']))
{
    header("location:login.php");
}

echo "<a href='change-password.php'> Change Password</a> |";
echo "<a href='logout.php'> Logout</a>";
?>