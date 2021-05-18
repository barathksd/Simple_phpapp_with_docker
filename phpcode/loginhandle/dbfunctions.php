<?php
    function str2html($string) :string {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
    function selectfromemail($dbh,$emailID){
        if (!empty($emailID)){
            $sql = 'SELECT uid,name,emailID,hash,password FROM users WHERE emailID=:emailID';
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(":emailID",$emailID,PDO::PARAM_STR);
            $stmt->execute();
        }
        else{
            $sql = 'SELECT uid,emailID,hash FROM users';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
        } 
        
        $result = $stmt->fetch();
        return $result;
    }
    # display the data
    function display($dbh){
        $sqlcmd = 'SELECT uid,emailID,hash FROM users';
        $statement = $dbh->query($sqlcmd);
        $i = 0;
        echo "<table style='width:70%;margin-left:20px;'><tr>";
        echo "<th>uid</th> <th>emailID</th> <th>hash</th>";
        
        while ($row = $statement->fetch()){
            echo "</tr><tr>";
            //echo "<td><a href='connect.php?uid=".$row["uid"]."'>update</td>";
            for($i=0;$i<6;$i++){
                echo "<td>".str2html($row[$i])."</td>";
            }
        }
        echo "</tr></table>";
    }

    function verify($dbh,$arr){
        $emailID= (string) $arr['emailID'];
        $res = selectfromemail($dbh,$emailID);
        $isMatch = password_verify($arr['password'],$res['hash']);
        return $isMatch;
    }

    # insert data
    function insert($dbh,$arr){
        if (!token_check($arr)){
            return false;
        }
        $sql = 'INSERT INTO users (name,emailID,hash,password) VALUES (:name,:emailID,:hash,:password);';
        $hash = password_hash($arr['password'],PASSWORD_DEFAULT);
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":name",$arr['uname'],PDO::PARAM_STR);
        $stmt->bindParam(":emailID",$arr['emailID'],PDO::PARAM_STR);
        $stmt->bindParam(":hash",$hash,PDO::PARAM_STR);
        $stmt->bindParam(":password",$arr['password'],PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }

    function update($dbh,$arr){
        if (!token_check($arr)){
            return false;
        }
        $sql = 'UPDATE xylog SET emailID = :emailID, hash = :hash, password = :password WHERE uid = :uid;';
        $hash = password_hash($arr['password'],PASSWORD_DEFAULT);
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":emailID",$arr['emailID'],PDO::PARAM_STR);
        $stmt->bindParam(":password",$arr['password'],PDO::PARAM_STR);
        $stmt->bindParam(":hash",$hash,PDO::PARAM_STR);
        $stmt->bindParam(":uid",$arr['uid'],PDO::PARAM_INT); 
        $stmt->execute();
        return true;
    }

    #validate data
    function validate($arr){
        $res = false;
        $out = "";
        if(empty($arr['emailID'])){
            $out = $out."<div style='color:red;margin-left:30px;'><b>Email ID is required</b></div>";
        }
        if(empty($arr['password'])){
            $out = $out."<div style='color:red;margin-left:30px;'><b>Password is required</b></div>";
        }
        if ($out !== ""){
            return $out;
        }
        $checkmail = preg_match('/([a-z0-9]{3,10})@([a-z]{2,10}).([a-z]{2,3})(.[a-z]{2,3})?/',$arr['emailID']);
        $checkpass = preg_match('/\A[[:^cntrl:]]{6,21}\z/u',$arr['password']);
        if (!$checkmail || !$checkpass){
            $out = $out."<div style='color:red;margin-left:30px;'><b>Invalid email or password format</b></div>";
        }
        return $out;
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
    function isloggedin(){
        return !empty($_SESSION['connect']);
    }
    function token_check($arr){
        if (!isset($_SESSION)){
            session_start();
        }
        return (hash_equals($_SESSION['token'],$arr['token']));
    }
?>