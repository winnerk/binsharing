<html>
<head>
<script type="text/javascript" src="js/func.js"></script>
</head>
<body>

<?php
$con = mysql_connect("au-cdbr-azure-southeast-a.cloudapp.net","bcde0439f22304","c4367224");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }mysql_select_db("binshare", $con);
  
  if($_POST['submit']=true)
  {   
      $username = $_POST['name01'];
	  $useremail = $_POST['email01'];
	  $userphone = $_POST['phone'];
      
      $nsql="select name from user where name='$username'";
      $esql="select email from user where name='$useremail'";
      $psql="select phone from user where name='$userphone'";
      
      $nquery=mysql_query($nsql);
	  $equery=mysql_query($esql);
	  $pquery=mysql_query($psql);
	  
      $nrows = mysql_num_rows($nquery);
	  $erows = mysql_num_rows($equery);
	  $prows = mysql_num_rows($pquery);
	  
      if($nrows > 0){
           echo "<script type='text/javascript'>alert('Name already exist');location='javascript:history.back()';</script>";
      }else if ($erows > 0){
		  echo "<script type='text/javascript'>alert('Email already exist');location='javascript:history.back()';</script>";
	  }else if($prows > 0){
		   echo "<script type='text/javascript'>alert('Phone number already exist');location='javascript:history.back()';</script>";
	  }else{
		  $sql="INSERT INTO user(name,email,phone,address,postcode,bintype,binsize,spareroom,message,book) VALUES
		  
		  ('$_POST[name01]','$_POST[email01]','$_POST[phone]','$_POST[street]','$_POST[postcode]','$_POST[selectBin]','$_POST[selectBinsize]','$_POST[selectBinroom]','$_POST[message]','0')";
  if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  } 
echo "<script>location.href='postsuccess.html';</script>";
	  }
  }
mysql_close($con)
?>


</body>
</html>
