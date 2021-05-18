<?php
    function str2html($string) :string {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
    function select($dbh,$uid){
        if ($uid>0) $sql = 'SELECT uid,t,pName,camName,rx,ry FROM xylog WHERE uid=:uid';
        else $sql = 'SELECT uid,t,pName,camName,rx,ry FROM xylog';
        
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":uid",$uid,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    # display the data
    function display($dbh){
        $sqlcmd = 'SELECT uid,t,pName,camName,rx,ry FROM xylog';
        $statement = $dbh->query($sqlcmd);
        $i = 0;
        echo "<table style='width:70%;'><tr>";
        echo "<th>Update</th> <th>uid</th> <th>t</th> <th>pName</th> <th>camName</th> <th>rx</th> <th>ry</th>";
        
        while ($row = $statement->fetch()){
            echo "</tr><tr>";
            echo "<td><a href='connect.php?uid=".$row["uid"]."'>update</td>";
            for($i=0;$i<6;$i++){
                echo "<td>".str2html($row[$i])."</td>";
            }
        }
        echo "</tr></table>";
    }	
    # insert data
    function insert($dbh,$arr){
        $sql = 'INSERT INTO xylog (t,pName,camName,rx,ry) VALUES (:t,:pName,:camName,:rx,:ry);';
        $stmt = $dbh->prepare($sql);
        $rx = (int) $arr['rx'];
        $ry = (int) $arr['ry'];
        $t = $arr['pdate']." ".$arr['ptime'].":00";
        $stmt->bindParam(":t",$t,PDO::PARAM_STR);
        $stmt->bindParam(":pName",$arr['pName'],PDO::PARAM_STR);
        $stmt->bindParam(":camName",$arr['camval'],PDO::PARAM_STR);
        $stmt->bindParam(":rx",$ry,PDO::PARAM_INT);
        $stmt->bindParam(":ry",$rx,PDO::PARAM_INT); 
        $stmt->execute();
    }

    function update($dbh,$arr){
        $sql = 'UPDATE xylog SET t = :t, pName = :pName, camName = :camName, rx = :rx, ry = :ry WHERE uid = :uid;';
        $stmt = $dbh->prepare($sql);
        $rx = (int) $arr['rx'];
        $ry = (int) $arr['ry'];
        $t = $arr['pdate']." ".$arr['ptime'].":00";
        $stmt->bindParam(":t",$t,PDO::PARAM_STR);
        $stmt->bindParam(":pName",$arr['pName'],PDO::PARAM_STR);
        $stmt->bindParam(":camName",$arr['camval'],PDO::PARAM_STR);
        $stmt->bindParam(":rx",$rx,PDO::PARAM_INT);
        $stmt->bindParam(":ry",$ry,PDO::PARAM_INT); 
        $stmt->bindParam(":uid",$arr['uid'],PDO::PARAM_INT); 
        $stmt->execute();
    }

    #validate data
    function validate($arr){
        $res = false;
        $out = "";
        if(empty($arr['pName'])){
            $out = $out."<div style='color:red;'><b>Name is required</b></div>";
            $res = true;
        }
        if(empty($arr['pdate'])){
            $out = $out."<div style='color:red;'><b>Date is required</b></div>";
            $res = true;
        }
        if(empty($arr['ptime'])){
            $out = $out."<div style='color:red;'><b>Time is required</b></div>";
            $res = true;
        }
        if(empty($arr['camval'])){
            $out = $out."<div style='color:red;'><b>Camera Name is required</b></div>";
            $res = true;
        }
        if(empty($arr['rx'])){
            $out = $out."<div style='color:red;'><b>rx is required</b></div>";
            $res = true;
        }
        if(empty($arr['ry'])){
            $out = $out."<div style='color:red;'><b>ry is required</b></div>";
            $res = true;
        }
        if($res){
            echo $out;
            exit;
        }
        $rx = (int) $arr['rx'];
        $ry = (int) $arr['ry'];
        preg_match('/\A\d{0,4}\z/u',$rx);
        preg_match('/\A\d{0,4}\z/u',$ry);
        preg_match('/\A[[:^cntrl:]]{1:21}\z/u',$arr['pName']);
    }
    function db_open():PDO {
        $user = "root";
        $pass = "sqlpass";
        $dbname = "demodb";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
        ];
        $dbh = new PDO('mysql:host=mysql;port=3306;dbname=demodb',$user,$pass,$opt);
        return $dbh;
    }
?>