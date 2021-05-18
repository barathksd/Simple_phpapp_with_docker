<body>
  <script>
    $(document).ready(function(){
      var emp = "off";
      $('#see').on('click', function(){
          if (emp === "off"){
              emp = "on";
              document.getElementById("exampleInputPassword1").type = "text";
          }
          else{
              emp = "off";
              document.getElementById("exampleInputPassword1").type = "password";
          }
      });
    });
  </script>
  <div id="top" ><p>Hi, welcome to the login page !!</p></div>
  <div class="form1">
      <form method="POST" action="connect.php">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="emailID">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
          <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="see">
                        <label class="form-check-label" for="see">覗く</label>
          </div>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">I'm not a robot</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>