<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script>
        $(document).ready(function(){
            $('#clist a').on('click', function(){  
                document.getElementById("camName").innerHTML = $(this).text();  
                document.getElementById("camval").value = $(this).text();
            });
            //initialize(5,'a','Cam2','2021-05-05','10:10',200,500,'Update'); 
        });
        function initialize(uid,nval,cnval,dval,tval,rxval,ryval,txt){
            document.getElementById("uid").value = uid;
            document.getElementById("ptime").value = tval;
            document.getElementById("pName").value = nval;
            document.getElementById("pdate").value = dval;
            document.getElementById("rx").value = rxval;
            document.getElementById("ry").value = ryval;
            
            document.getElementById("formsubmit").innerHTML = txt;
            document.getElementById("formhead").innerHTML = txt + " Form";
            document.getElementById("camName").innerHTML = cnval;
            document.getElementById("camval").value = cnval;
            document.getElementById("submit_type").value = txt;
        }
    </script>
    <title>Document</title>
    <h2 style="text-align:center;">DB connect</h2>
</head>
<body>
    <div class="form1" style="width:300px;margin-left:30px;margin-top:50px;">
        <b><div id="formhead"> Insert Form</div></b> 
        <form method="POST" action="connect.php" >
            <input type="hidden" class="form-control" id="uid" name="uid" value=0>
            <div class="form-group">
                <label for="pName">Name</label>
                <input type="text" class="form-control" id="pName" placeholder="Enter name" name="pName">
            </div>
            <div class="form-group">
                <label for="pdate">Date</label>
                <input type="date" class="form-control date" id="pdate" name="pdate" value="2021-05-05">
            </div>
            <div class="form-group">
                <label for="ptime">Time</label>
                <input type="time" class="form-control" id="ptime" min="07:00" max="20:00" value="10:10" name="ptime">
            </div>
            <div class="form-group" id="camdd">
                <label for="camName">Camera Name</label><br>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="camName" name="camName" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:300px;background-color:white;color:black;">
                    Cam1
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="clist" name="clist" style="width:300px;">
                    <a class="dropdown-item" value=1>Cam1</a>
                    <a class="dropdown-item" value=2>Cam2</a>
                    <a class="dropdown-item" value=3>Cam3</a>
                    <a class="dropdown-item" value=4>Cam4</a>
                    <a class="dropdown-item" value=5>Cam5</a>
                    <a class="dropdown-item" value=6>Cam6</a>
                    <a class="dropdown-item" value=7>Cam7</a>
                    <a class="dropdown-item" value=8>Cam8</a>
                </div>
                <input id="camval" name="camval" value="cam1" type="hidden">
            </div>
            <div class="form-group">
                <label for="rx">rx</label>
                <input type="number" class="form-control" id="rx" placeholder="Enter rx" name="rx">
            </div>
            <div class="form-group">
                <label for="ry">ry</label>
                <input type="number" class="form-control" id="ry" placeholder="Enter ry" name="ry">
            </div>
            <div>
                <button type="submit" class="btn btn-primary" id="formsubmit">Insert</button>
                <input id="submit_type" name="submit_type" value="Insert" type="hidden">
            </div>
        </form>

    </div>