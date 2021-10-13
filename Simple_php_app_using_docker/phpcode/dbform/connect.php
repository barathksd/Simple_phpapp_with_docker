<?php
    require_once __DIR__.'/dbfunctions.php';
    include __DIR__.'/header.php';
    try{
        $dbh = db_open();
        if (sizeof($_POST)>0){
            validate($_POST);
            if ($_POST['submit_type'] === "Insert"){
                insert($dbh,$_POST);
            }
            else if ($_POST['submit_type'] === "Update"){
                update($dbh,$_POST);
            }
        }
        if (sizeof($_GET)>0){
            $uid = (int) $_GET['uid'];
            $res = select($dbh,$uid);
            if (!empty($res)){
                $rx = (int) $res['rx'];
                $ry = (int) $res['ry'];
                $t = preg_split("/ /", str2html($res['t']));
                $pdate = $t[0];
                preg_match('/\d{2}:\d{2}/u',$t[1],$ptime);
                $s = "<script>initialize(".$uid.",'".str2html($res['pName'])."','".str2html($res['camName'])."','".$pdate."','".$ptime[0]."',".$rx.",".$ry.",'Update');</script>";
                echo "<br>".$s;
            }
            else{
                echo "<div style='color:red;'><b>No entry present with uid=".$uid."</b></div>";
                exit;
            }
        }
        
        echo "<hr><div style='margin-left:20px;'><br><b>Display Data from MySQL</b><br>";
        display($dbh);
        echo "</div>";
        
    } catch (PDOException $e){
        echo "Error!: ".$e->getMessage()."<br>";
        exit;
    }
?>
<?php include __DIR__."/footer.php";?>
