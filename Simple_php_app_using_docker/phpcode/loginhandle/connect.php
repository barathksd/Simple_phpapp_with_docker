<?php
  require_once __DIR__.'/dbfunctions.php';
  $fname = "connect";
  $out = "";

  if (!isset($_SESSION)){
      session_start();
  }
  $token = bin2hex(random_bytes(20));
  $_SESSION['token'] = $token;

  try{
        $dbh = db_open();
        if (!empty($_POST)){
            $out = validate($_POST);
            if ($out === ""){
                $isMatch = verify($dbh,$_POST);
                $islin = isloggedin();
                if (!$islin && $isMatch){
                    session_regenerate_id(true);
                    $_SESSION[$fname] = ['emailID' => $_POST['emailID']];
                    header("Location: account.php" );
                }
                else if (!$isMatch){
                    $out = "<div style='color:red;margin-left:20px;'><b>Login failed, please try again</b></div>";
                }
            }
        }
    } catch (PDOException $e){
        echo "Error!: ".$e->getMessage()."<br>";
        exit;
    }
    include __DIR__.'/header.php';
    include __DIR__.'/login.php';
    if (!empty($_SESSION[$fname])){
        if (empty($_POST)){
            $out = "<div style='color:green;margin-left:20px;'><b>Already logged in!!</b></div>";
        }
        else{
            $out = "<div style='color:red;margin-left:20px;'><b>Please logout before logging in!!</b></div>";
        }
    }
    if ($out !== ""){
        echo $out;
    }
    include __DIR__."/footer.php";
?>       