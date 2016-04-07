<?php
$link=mysqli_connect("au-cdbr-azure-southeast-a.cloudapp.net","bcde0439f22304","c4367224","binshare");

$action=$_POST["action"];
if($action=="showroom"){
    $query="SELECT * FROM binuser";
    $show=mysqli_query($link,$query);
    while($row=mysqli_fetch_array($show)){
        echo "<li>$row['address']</li>";
    }
}
?>