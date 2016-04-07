<?php
$con = mysqli_connect("localhost","","");
if (!$con)
{
    die('Could not connect: ' . mysqli_error());
}
echo "success";
?>