<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link src="./../include/style.css" />
    <title>CONTACT SAVER</title>
<style>
.login-box{
    background-color: lightblue;
    padding:20px;
    margin:20px;
}
</style>


  </head>
  <body>
    <?php include './include/header.php'; ?>
    <?php include './include/connect.php' ?>
  

    <?php 

        if(isset($_POST['Submit']))
        {
           $email =  $_POST['email'];
           $password =  $_POST['password'];



           $sql = "SELECT * FROM register where email = '$email' and password = '$password' ";
           $result = $conn->query($sql);
           
           if ($result->num_rows > 0) {
             // output data of each row
             while($row = $result->fetch_assoc()) {
                session_start();
                $_SESSION["userid"] = $email;
                header("Location: ./dashboard.php");
             }
           } else {
          ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Invalid User name or Password</strong> Please login to access the application
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
          <?php
           }



        }
    ?>


    <div class="container" >
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 login-box " >
                <h1>Login </h1>
                <form method="post" >
                            <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                    </div>
                    <div>
                        <input class="btn btn-primary m-3" type="submit" name="Submit" value="submit" />
                    </div>
                </form>
        </div>

    </div>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>