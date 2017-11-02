<?php
  require("./connect.php");

    $user = json_decode($_POST["user"]);

    $name = $user->name;
    $sex = $user->sex;
    $tel = $user->tel;

    $add_sql = "INSERT INTO member (name,sex,tel) VALUES ('$name','$sex','$tel')";

    if(mysql_query($add_sql)){
        echo 1;
    }else{
        echo 0;
    }

    mysql_close();


?>