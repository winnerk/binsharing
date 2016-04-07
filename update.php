<?php
$con = mysql_connect("au-cdbr-azure-southeast-a.cloudapp.net","bcde0439f22304","c4367224");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("binshare", $con);
  if($_POST['update']=true){
  $sql="update user set book='1' where name='$_POST[hidden]'";
  mysql_query($sql,$con);
  echo "<script>location.href='booksuccess.html';</script>";
  }
 
  mysql_close($con)
?>