<?php
    require("./connect.php");

    class Member{
        public $name;
        public $sex;
        public $tel;
    };

    $data = array();

    $select_sql = "select * from member";

    $query_res = mysql_query($select_sql);

    while($res = mysql_fetch_assoc($query_res)){

        $member = new Member();

        $member->name = $res["name"];
        $member->sex  = $res["sex"];
        $member->tel  = $res["tel"];

        $data[]=$member;

    }
    $json = json_encode($data);

    echo "{".'"user"'.":".$json."}";

    mysql_close();






?>