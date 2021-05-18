<?php
   if (!isset($_SESSION)){
        session_start();
    }
    require_once __DIR__.'/dbfunctions.php';
    include __DIR__.'/header.php';
    $dbh = db_open();
    if (!isloggedin()){
        echo "<div style='margin-left:30px;'>Please <a href='connect.php'>login</a> to see your information</div>";
        exit;
    }
?>
<body>
    <div id="top" ><p>Account Info</p></div>
    <div class="form1">
        <div class="form-group">
            <div class="form-inline">
                <label>Hi&nbsp;</label>
                <b><div id="greeting"></div></b>
            </div>
        </div>   
        <div class="form-group">
            <label>Your email is </label>
            <b><div id="mailinfo"></div></b>
        </div>   
        <div class="form-group">
            <label>Your password is </label>
            <b><div id="passinfo"></div></b>
        </div>
        <div class="form-group">
            <label>Your hash is </label>
            <b><div id="hashinfo"></div></b>
        </div> 
        <div class="form-group">
            <div id="logout">Click here to <a href="logout.php">logout</a></div>
        </div> 
    </div>
    <?php
        if (isloggedin()){
            $emailID = $_SESSION['connect']['emailID'];
            $res = selectfromemail($dbh,$emailID);
            echo "<script type='text/javascript'>
                document.getElementById('greeting').innerHTML='".$res['name']."';
                document.getElementById('mailinfo').innerHTML='".$res['emailID']."';
                document.getElementById('passinfo').innerHTML='".$res['password']."';
                document.getElementById('hashinfo').innerHTML='".$res['hash']."';
            </script>";
            
        }
        include __DIR__."/footer.php";
    ?>