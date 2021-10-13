<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <h2 style="text-align:center;">Api handling</h2>
</head>
<body>
    <p>
        <form action="process_api.php" method="get">
            <label style="margin:10px;">Enter zipcode : </label>
            <input type="text" name="zipcode">
            <br />
            <button type="submit" style="margin:10px;color:white;background-color:navy;width:60px;height:30px;">submit</button>
        </form>
    </p>
    <?php
        $zipcode = htmlspecialchars($_GET['zipcode'],ENT_QUOTES);
        $rtn = preg_match('/\d{7}/u',$zipcode,$match);
        
        if (isset($zipcode) && sizeof($match)===1){
            $url = "http://zipcloud.ibsnet.co.jp/api/search?zipcode=".$zipcode;
            $res = file_get_contents($url);
            $res = json_decode($res,true);
            echo "<br>";
            foreach($res['results'] as $key=>$val){
                $i = 0;
                foreach($val as $key=>$val2){
                    $i++;
                    echo $val2."&nbsp";
                    if ($i === 3 || $i===7){
                        echo "<br>";
                    }
                }
            }
        }
        else{
            echo "invalid zipcode";
        }
        
    ?>
</body>
</html>