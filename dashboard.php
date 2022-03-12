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

.contact-box{
    background-color:lightgray;
}
</style>


  </head>
  <?php 
   session_start();
   $userId = $_SESSION["userid"];
        if( $_SESSION["userid"] == '' )
        {
            header("Location: ./login.php");
        }
  ?>
  <body>
    <?php include './include/header.php'; ?>
    <?php include './include/connect.php' ?>
  

    <?php 

$name = '';
$mobile_no =  '';
$email =  '';
$userId =  $_SESSION["userid"];

if(isset($_POST['editvalues']))
{
    if(isset($_POST['name']))
    {
        $name =  $_POST['name'];
        $mobile_no =  $_POST['mobile_no'];
        $email =  $_POST['email'];
        $userId =  $_SESSION["userid"];
        $editid = $_POST['editid'];
    }

}



        if(isset($_POST['Submit']))
        {
           $name =  $_POST['name'];
           $mobile_no =  $_POST['mobile_no'];
           $email =  $_POST['email'];
           $userId =  $_SESSION["userid"];


            if($userId != '' )
            if($name != '' || $mobile_no != '' || $email != '')
            {
            {
                $sql = "INSERT INTO mycontacts (userid,name,phone_no,email)
                VALUES ('$userId', '$name','$mobile_no','$email')";
     
                if ($conn->query($sql) === TRUE) {
                    ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Record Updated Successfully</strong> Please login to access the application
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
     
            }
        }
        }


        if(isset($_POST['Update']))
        {
           $name =  $_POST['name'];
           $mobile_no =  $_POST['mobile_no'];
           $email =  $_POST['email'];
           $editid = $_POST['editid'];
           $userId =  $_SESSION["userid"];


            if($userId != '' )
            if($name != '' || $mobile_no != '' || $email != '')
            {
            {
                $sql = "INSERT INTO mycontacts (userid,name,phone_no,email)
                VALUES ('$userId', '$name','$mobile_no','$email')";

$sql = "UPDATE mycontacts SET name='$name' , phone_no = '$mobile_no' , email = '$email' WHERE userid='$userId' and id = '$editid' ";
    //  echo $sql;
                if ($conn->query($sql) === TRUE) {
                    ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Record Updatted Successfully</strong> Please login to access the application
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
     
            }
        }
        }
    ?>


    <div class="container" >
    <h3> Contact Form and Contact List Page </h3>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 login-box" >
             
                <form method="post" >
  
                    <div class="form-floating m-3">
                    <input type="text" class="form-control" name="name" value="<?= $name; ?>" placeholder="Name">
                    <label for="floatingPassword">Name</label>
                    </div>
                    <div>

                    <div class="form-floating m-3">
                    <input type="number" class="form-control" name="mobile_no" value="<?= $mobile_no; ?>"  placeholder="Phone Number">
                    <label for="floatingPassword">Phone Number</label>
                    </div>
                    <div>
                    <div class="form-floating m-3">
                    <input type="email" class="form-control" name="email" value="<?= $email; ?>" placeholder="email">
                    <label for="floatingPassword">Email</label>
                    </div>
                    <div>
                    <input type="hidden" name="editid" value="<?= $editid ?>" />
                     
                        <?php 
if(isset($_POST['editvalues']))
{
    ?>
 <input class="btn btn-warning m-3" type="submit" name="Update" value="Update" />
    <?php
}
else{
    ?>
    <input class="btn btn-primary m-3" type="submit" name="Submit" value="submit" />
    <?php
}
                        ?>
                    </div>
                </form>
        </div>

    </div>


    <div class="container mt-5 contact-box" >

    <h3>My Contacts </h3>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
    <form method="post" >
        <input type="hidden" name="editvalues" value="editvalues" />
            <table class="table table-hover" >
                <tr>
                    <th>Sl.no</th>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM mycontacts where userid = '$userId' ";
                $result = $conn->query($sql);
                $i = 1;
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                      
                ?>
                  <input type="hidden" name="editvalues" value="editvalues" />
                  <input type="hidden" name="editid" value="<?= $row['id'] ?>" />
                <tr>
                   
                    <td><?= $i; ?></td>
                    <td id="name<?= $row['id'] ?>" ><?= $editName = $row['name'] ?></td>
                    <td id="ph_no<?= $row['id'] ?>" ><?= $row['phone_no'] ?></td>
                    <td id="email<?= $row['id'] ?>" ><?= $row['email'] ?></td>
                    <td>
                        <?php $id = $row['id']; ?>
                        <button id="swith<?= $row['id'] ?>" class="btn btn-primary btn-sm m-2" onClick="edit_record('<?php echo $id;?>');" >Edit</button>
                        <!-- <a class="btn btn-danger btn-sm m-2" href="dashboard.php?delete_id=<?= $row['id'] ?>" >Delete</a> -->
                        <!-- <input type="submit" value="<?= $row['id'] ?>" name="delete_id" /> -->
                    </td>
                
                </tr>
                <?php 
                $i = $i + 1;
                 }
                } else {
                  echo "0 results";
                }
                ?>
            </table>
            </form>
    </diV>
</div>
    
<?php 
if(isset($_POST['delete_id']))
{
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM mycontacts WHERE id='$id' ";

if ($conn->query($sql) === TRUE) {
    header("Location: ./dashboard.php");
} else {
  echo "Error deleting record: " . $conn->error;
}
}
?>

<script>
function edit_record(id)
{
  
    let name = document.getElementById('name'+id).innerHTML;
    let ph_no = document.getElementById('ph_no'+id).innerHTML;
    let email = document.getElementById('email'+id).innerHTML;

    document.getElementById('name'+id).innerHTML = `<input type="text" class="form-control" name="name" value="${name}" placeholder="Name">`;
    document.getElementById('ph_no'+id).innerHTML = `<input type="number" class="form-control" name="mobile_no" value="${ph_no}"  placeholder="Phone Number">`;
    document.getElementById('email'+id).innerHTML = `<input type="email" class="form-control" name="email" value="${email}" placeholder="email">`;
    // document.getElementById('swith'+id).innerHTML = `<input type="submit" name="Submit" value="submit" />`;

}
</script>

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