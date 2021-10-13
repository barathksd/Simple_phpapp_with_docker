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
        $fp = fopen('/code/csvfiles/xylog.csv','r');
        function disptable($fp){
            if ($fp === false ){
                echo "file not found";
            }
            else{
                $rownames = fgetcsv($fp);
                $i = 0;
                echo "<table style='width:50%'><tr>";
                foreach($rownames as $value){
                    echo "<th>".$value."</th>";
                }
                
                while(($row = fgetcsv($fp)) && ($i<100)){
                    echo "</tr><tr>";
                    $i++;
                    foreach($row as $value){
                        echo "<td>".htmlspecialchars($value,ENT_QUOTES,'UTF-8')."</td>";
                    }
                }
                echo "</tr></table>"; 
            }
        }
        disptable($fp);

    ?>
