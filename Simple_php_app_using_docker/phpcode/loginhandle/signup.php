<?php
    if (!isset($_SESSION)){
        session_start();
    }
    $token = bin2hex(random_bytes(20));
    $_SESSION['token'] = $token;
    require_once __DIR__.'/dbfunctions.php';
    $islin = isloggedin();
    $dbh = db_open();
    $message = "";
    if ($islin){
        $message = $message."<div style='color:green;margin-left:30px;'><b>You are already logged in!!</b></div>";
    }
    if (!empty($_POST)){
        if ($islin){
            $message = "<div style='color:red;margin-left:30px;'><b>Please logout before signing up</b></div>";
        }
        else{
            if(empty($_POST['emailID'])){
                $message = $message."<div style='color:red;margin-left:30px;'><b>Email ID is required</b></div>";
            }
            if(empty($_POST['uname'])){
                $message = $message."<div style='color:red;margin-left:30px;'><b>Name is required</b></div>";
            }
            $_POST['emailID'] = $_POST['emailID'].'@gmail.com';
            $res = selectfromemail($dbh,$_POST['emailID']);
            if (!empty($res)){
                $message = $message."<div style='color:red;margin-left:30px;'><b>Email already exists</b></div>";
            }
            $message = $message.validate($_POST);
            if ($_POST['password'] !== $_POST['password2']){
                $message = $message."<div style='color:red;margin-left:30px;'><b>Passwords don't match</b></div>";
            }
            if ($message === ""){
                //$_POST['token'] = $token;
                if (insert($dbh,$_POST)){
                    header("Location: connect.php");
                }
                else{
                    $message = "<div style='color:red;margin-left:30px;'><b>Token Expired!</b></div>";
                }
            }
        }

    }
    include __DIR__.'/header.php';
?>
    <body>
        <script>
            $(document).ready(function(){
                var emp = "off";
                $('#see').on('click', function(){
                    if (emp === "off"){
                        emp = "on";
                        document.getElementById("exampleInputPassword1").type = "text";
                        document.getElementById("exampleInputPassword2").type = "text";
                    }
                    else{
                        emp = "off";
                        document.getElementById("exampleInputPassword1").type = "password";
                        document.getElementById("exampleInputPassword2").type = "password";
                    }
                });
            });
         </script>
        <div id="top" ><p>Hi, welcome to the signup page !!</p></div>
        <div class="form1">
            <form method="POST" action="signup.php">
            <input type="hidden" id="token" value = '<?php echo $token; ?>' name="token">
            <div class="form-group">
                <label for="uname">Name</label>
                <input type="text" class="form-control" id="uname" placeholder="Enter name" name="uname">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <div class="form-inline">
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="emailID">
                    @gmail.com
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword2">Confirm Password</label>
                <div class="form-inline">
                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password" name="password2" style="width:100%">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="see" onclick="">
                        <label class="form-check-label" for="see">覗く</label>
                    </div>
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="">
                <label class="form-check-label" for="exampleCheck1">I'm not a robot</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <b><div id="message" style='color:red;margin-left:30px;'></div></b>

<?php
    if ($message !== ""){
        echo $message;
        exit;
    }
    include __DIR__."/footer.php"; 
?>