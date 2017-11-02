<?php
  require("./connect.php");

  $name = $_GET["name"];

  $delete_sql = "delete from member where name = '$name'";

  if(mysql_query($delete_sql)){
           echo 1;
       }else{
           echo 0;
       };


?>