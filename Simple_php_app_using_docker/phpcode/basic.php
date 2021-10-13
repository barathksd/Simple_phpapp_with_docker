<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $emailid = htmlspecialchars($_POST['emailid'],ENT_QUOTES,'UTF-8');
        $password = htmlspecialchars($_POST['password'],ENT_QUOTES,'UTF-8');
        $exlist = [
            2 => "20",
            4 => "40",
            6 => "60",
            "8" => 80
        ];
        $exlist[10] = 100;
        $a1D = [1,3,5,7,9];
        $a2D = [['name' => 'A', 'height' => 150],['name' => 'B', 'height' => 170],['name' => 'C', 'height' => 160]];

        if ($emailid){
            echo "Hello <b>".$emailid."</b> Your password is ".$password."<br>";
        } else{
            echo "Hello <b>User</b><br>";
        }
        function square($num){
            return $num**2;
        }

        for ($i =1;$i<5;$i++){
            echo $a1D[$i]."-".square($a1D[$i])."<br>";
        }

        foreach($a2D as $value){
            foreach($value as $key => $value2){
                echo " ".$key."=".$value2;
            }
            echo ",";
        }
        echo "<br>";
        foreach($exlist as $key => $value){
            echo $key."-".$value." ";
        }
        echo "<br>qwerty - ".password_hash('qwerty',PASSWORD_DEFAULT)."<br>"
    ?>
</body>
</html>