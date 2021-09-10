<?php

$insert = false;
$update = false;
$delete = false;


// Connect to the database code:

$servername = "localhost";
$username = "root";
$password = "";
$database = "covid_hospital_db";


// Create a connection
$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("Sorry we failed to connect :" . mysqli_connect_error());
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  // Update of the record into the database
  if(isset($_POST['snoEditPatients'])){
    $sno = $_POST['snoEditPatients'];
    $editFirstName = $_POST['editFirstName'];
    $editLastName = $_POST['editLastName'];
    $editAge = $_POST['editAge'];
    $editPhoneNumber = $_POST['editPhoneNumber'];
    $editCity = $_POST['editCity'];
    $editLevel = $_POST['editLevel'];

    $sql =  "UPDATE `covid_patient_details` 
     SET `first_name` = '$editFirstName', `last_name` = '$editLastName', `age` = '$editAge', `phone_number` = '$editPhoneNumber', `city` = '$editCity', `level` = '$editLevel'
     WHERE `covid_patient_details`.`sno` = $sno;";

    $result = mysqli_query($conn , $sql);
    if($result){
      $update = true;
    }else{
      echo "Not Updated";
    }
  }else{

  // Inserting of record into the database
  $insertfirstName = $_POST['insertfirstName'];
  $insertlastName = $_POST['insertlastName'];
  $insertAge = $_POST['insertAge'];
  $insertPhoneNumber = $_POST['insertPhoneNumber'];
  $insertCity = $_POST['insertCity'];
  $insertLevel = $_POST['insertLevel'];

  // Sql query to be executed
  $sql = "INSERT INTO `covid_patient_details` (`first_name`, `last_name`, `age`, `phone_number`, `city`, `level`)
  VALUES ('$insertfirstName', '$insertlastName', '$insertAge', '$insertPhoneNumber', '$insertCity', '$insertLevel');";
  $result = mysqli_query($conn,$sql);

  if($result){
    // echo "Successfull";
    $insert = true;
  }else{
    echo "not successfull";
  }
  }
}



// Delete the database record
if(isset($_GET['deletePatients'])){
  $sno = $_GET['deletePatients'];
  $sql = "DELETE FROM `covid_patient_details` WHERE `covid_patient_details`.`sno` = $sno;";
  $result = mysqli_query($conn, $sql);

  if($result){
    // echo "Your data has been deleted successfully";
    $delete = true;
  }else{
    echo "We could not delete your record";
  }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    

    <title>Covid Patients Details!</title>
    <style>
            
    body {
      background: url(./data.jpg);
      min-height: 100vh;
      background-size: cover;
      
      }
       h2{
         color: #000;
        text-align: center;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-family: "Poppins", sans-serif;
        font-weight: 700;
        margin-top: 1.5rem;
      }
      header {
        display: flex;
        align-items: center;
        flex-direction: column;
        color: rgb(88, 84, 84);
        background: radial-gradient(#ffffff, #aaaaaa);
      }
      .back a{ 
        background: radial-gradient(#ffffff, #fce5e5);
        border-radius: 3px;
        margin: 1rem;
        padding: 1rem;
        font-weight: 700;
        font-family: "Poppins", sans-serif;
        color: rgb(46, 43, 43);
        text-decoration: none;

      }
      a {
        text-decoration: none;
        color: rgb(51, 30, 30);
        display: grid;
        justify-content: center; 
        text-align: center;
        align-items: center;
        }     
    a:hover {
      color: #fff;
      color: #000;
      letter-spacing: 3px;
      opacity: 1 !important;
    }

    </style>

  </head>
  <body>
  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your information has been taken...Thanks for sharing....
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your information has been updated......
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your information has been deleted......
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <header id="top">
    <h1>SSA HOSPITAL</h1>
    <h3>PERSONALISING HEALTHCARE</h3>
  </header>
        
  <h2>PATIENT DETAILS</h2>
  
  <!-- INSERTModal -->
  <div class="modal fade" id="insertPatientsModal" tabindex="-1" aria-labelledby="insertPatientsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="insertPatientsModalModalLabel">Insert Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/Crud_app/crude-app/covid_patients.php" method="POST">
          <div class="modal-body">
            
                <div class="form-group">
                  <label for="firstName">Enter First Name</label>
                  <input type="text" class="form-control" id="insertfirstName" name="insertfirstName" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                    <label for="lastName">Enter Last Name</label>
                    <input type="text" class="form-control" id="insertlastName" name="insertlastName" placeholder="Enter Last Name" >
                  </div>
                  <div class="form-group">
                    <label for="age">Enter Age</label>
                    <input type="number" class="form-control" id="insertAge" name="insertAge" placeholder="Enter Age" >
                  </div>
                  <div class="form-group">
                    <label for="phonenumber">Enter PhoneNumber</label>
                    <input type="text" class="form-control" id="insertPhoneNumber" name="insertPhoneNumber" placeholder="Enter PhoneNumber">
                  </div>
                  <div class="form-group">
                    <label for="city">Enter City</label>
                    <input type="text" class="form-control" id="insertCity" name="insertCity" placeholder="Enter City">
                  </div>
                  <div class="form-group">
                    <label for="level">Enter Level</label>
                    <input type="text" class="form-control" id="insertLevel" name="insertLevel" placeholder="Enter Level">
                  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
              </form>
      </div>
    </div>
  </div>

   <!-- EDITModal -->
   <div class="modal fade" id="editPatientsModal" tabindex="-1" aria-labelledby="editPatientsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editPatientsModalLabel">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/Crud_app/crude-app/covid_patients.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="snoEditPatients" id="snoEditPatients" >
                <div class="form-group">
                  <label for="firstName">Enter First Name</label>
                  <input type="text" class="form-control" id="editFirstName" name="editFirstName" placeholder="Edit First Name">
                </div>
                <div class="form-group">
                    <label for="lastName">Enter Last Name</label>
                    <input type="text" class="form-control" id="editLastName" name="editLastName" placeholder="Edit Last Name" >
                  </div>
                  <div class="form-group">
                    <label for="age">Enter Age</label>
                    <input type="number" class="form-control" id="editAge" name="editAge" placeholder="Edit Age" >
                  </div>
                  <div class="form-group">
                    <label for="phonenumber">Enter PhoneNumber</label>
                    <input type="text" class="form-control" id="editPhoneNumber" name="editPhoneNumber" placeholder="Edit PhoneNumber">
                  </div>
                  <div class="form-group">
                    <label for="city">Enter City</label>
                    <input type="text" class="form-control" id="editCity" name="editCity" placeholder="Edit City" >
                  </div>
                  <div class="form-group">
                    <label for="level">Enter Level</label>
                    <input type="text" class="form-control" id="editLevel" name="editLevel" placeholder="Edit Level" >
                  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update changes</button>
        </div>
              </form>
      </div>
    </div>
  </div>

<!-- DELETEModal -->
<div class="modal fade" id="deletePatientsModal" tabindex="-1" aria-labelledby="deletePatientsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletePatientsModalLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          
        </button>
      </div>
      <form action="/Crud_app/crude-app/covid_patients.php" method="GET">
      <div class="modal-body">
        <input type="hidden" name="deletePatients" id="deletePatients" >
            <h1>Are you sure you want to delete?</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Delete</button>
      </div>
    </form>
    </div>
  </div>
</div>

    <div class = "row">
        <div class="col-md-12 text-right">
        <button class="insertPatients btn btn-success badge-pill"data-toggle="modal" data-target="#insert" style ="width:100px;height:75px;font-size:1.5rem">INSERT</button>
    </div>
    <!-- <div class="dropdown">
      <div class="col-md-12 text-right"></div>
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Search By
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">First</a>
        <a class="dropdown-item" href="#">LastName</a>
        <a class="dropdown-item" href="#">Age</a>
        <a class="dropdown-item" href="#">City</a>
        <a class="dropdown-item" href="#">Level</a>
      </div>
      </div> -->
    </div>
    <br>

    

  <div class="container my-4">

    <table class="table" id="myPatientsTable">
          <thead>
            <tr>
              <th scope="col" >S.No</th>
              <th scope="col" >First Name</th>
              <th scope="col" >Last Name</th>
              <th scope="col" >Age</th>
              <th scope="col" >Phone Number</th>
              <th scope="col">City</th>
              <th scope="col" >Level</th>
              <th scope="col" >Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
          $sql = "SELECT * FROM `covid_patient_details`";
          $result = mysqli_query($conn, $sql);
              $sno = 0;
              while($row = mysqli_fetch_assoc($result)){
                $sno = $sno + 1;
                echo "<tr>
                <th scope='row'>". $sno . "</th>
                <td>". $row['first_name'] . "</td>
                <td>". $row['last_name'] . "</td>
                <td>". $row['age'] . "</td>
                <td>". $row['phone_number'] . "</td>
                <td>". $row['city'] . "</td>
                <td>". $row['level'] . "</td>
                <td> <button class='editPatientDatabase btn btn-sm btn-warning' id=".$row['sno'].">Edit</button> <button class='deletePatientDatabase btn btn-sm btn-danger' id=d".$row['sno'].">Delete</button>  </td>
              </tr>";
            } 
              ?>
    
    
          </tbody>
        </table>
    
    
      </div>    

        <?php 
          echo "
          <div class='back'>
            <a href='data.php'> Go Back </a>
          </div>
          ";
        ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    
   
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myPatientsTable').DataTable();
    });
  </script>
  <script> 
  // Inserting script
    insertPatientsData = document.getElementsByClassName('insertPatients');
    Array.from(insertPatientsData).forEach((element) => {
      element.addEventListener("click" , (e) => {
    $('#insertPatientsModal').modal('toggle');
      })
    })


  // Editing script
  editPatient = document.getElementsByClassName('editPatientDatabase');
    Array.from(editPatient).forEach((element) => {
      element.addEventListener("click" , (e) => {
        console.log("editPatientDatabase" , );
        tr = e.target.parentNode.parentNode;
        first_name = tr.getElementsByTagName("td")[0].innerText;
        last_name = tr.getElementsByTagName("td")[1].innerText;
        age = tr.getElementsByTagName("td")[2].innerText;
        phone_number = tr.getElementsByTagName("td")[3].innerText;
        city = tr.getElementsByTagName("td")[4].innerText;
        level = tr.getElementsByTagName("td")[5].innerText;
        console.log(first_name,last_name,age,phone_number,city,level);
        editFirstName.value = first_name;
        editLastName.value = last_name;
        editAge.value = age;
        editPhoneNumber.value = phone_number;
        editCity.value = city;
        editLevel.value = level;
        snoEditPatients.value = e.target.id;
        console.log(e.target.id);
        $('#editPatientsModal').modal('toggle');
      })
    })

    deletePatientRecords = document.getElementsByClassName('deletePatientDatabase');
    Array.from(deletePatientRecords).forEach((element) => {
      element.addEventListener("click" , (e) => {
        console.log('deletePatientDatabase' , );
        $('#deletePatientsModal').modal('toggle');
        sno = e.target.id.substr(1);
        deletePatients.value = sno;
        console.log(sno);

        // if(confirm(deleteHospital)){
        //   window.location = `/Crud_app/crude-app/covid_hospital.php?deleteHospital=${sno}`;
        //   console.log("yes");
        // }else{
        //   console.log("no");
        // }
      })
    })



  </script>

  </body>

</html>