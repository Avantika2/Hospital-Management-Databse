<?php

$insert = false;
$update = false;
$delete = false;


$servername = "localhost";
$username = "root";
$password = "";
$database = "covid_hospital_db";

$conn = mysqli_connect($servername,$username,$password,$database);


if(!$conn){
    die("Sorry we failed to connect to the database : " . mysqli_connect_error());
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if(isset($_POST['snoEdit'])){
    // Update the record

    $sno = $_POST['snoEdit'];
    $editName = $_POST['editName'];
    $editWard = $_POST['editWard'];
    $editPatientsNumber = $_POST['editPatientsNumber'];

    $sql = "UPDATE `covid_hospital_details` 
    SET `doctor_name` = '$editName', `ward_number` = '$editWard', `number_of_patients` = '$editPatientsNumber'
    WHERE `covid_hospital_details`.`sno` = $sno;";

    $result = mysqli_query($conn,$sql);
    if($result){
      $update = true;
    }else{
      echo "We could not update the record successfully";
    }
  }else{
    // Insert Code
    $insertName = $_POST['insertName'];
    $insertWard = $_POST['insertWard'];
    $insertPatientNumber = $_POST['insertPatientNumber'];
  
    // Sql query to be executed
    $sql = "INSERT INTO `covid_hospital_details` 
    (`doctor_name`, `ward_number`, `number_of_patients`)
    VALUES ('$insertName', '$insertWard', '$insertPatientNumber');";
  
    $result = mysqli_query($conn,$sql);
  
    if($result){
      // echo "Successfully inserted into the database";
      $insert = true;
    }else{
      echo "The record was not successfully inserted due to " . mysqli_error($conn);
    }
  }
}


// Delete the database record
if(isset($_GET['deleteHospital'])){
  $sno = $_GET['deleteHospital'];
  $sql = "DELETE FROM `covid_hospital_details` WHERE `covid_hospital_details`.`sno` = $sno;";
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
    

    <title>Covid Hospital Details!</title>
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
        
  <h2>HOSPITAL DETAILS</h2>

   <!-- EDITModal -->
   <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Your Details Here</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

            <form action="/Crud_app/crude-app/covid_hospital.php" method="POST">
              <div class="modal-body">
                <input type="hidden" name="snoEdit" id="snoEdit">
                <div class="form-group">
                  <label for="name">Doctor Name</label>
                  <input type="text" class="form-control" id="editName" name="editName">
                </div>
                <div class="form-group">
                    <label for="ward">Ward Number</label>
                    <input type="text" class="form-control" id="editWard" name="editWard">
                  </div>
                  <div class="form-group">
                    <label for="patientsNumber">Patients number</label>
                    <input type="number" class="form-control" id="editPatientsNumber" name="editPatientsNumber">
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

  <!-- DELETEModal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete Your Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            
          </button>
        </div>
            <form action="/Crud_app/crude-app/covid_hospital.php" method="GET">
        <div class="modal-body">
        <input type="hidden" name="deleteHospital" id="deleteHospital">
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

  <div class="container my-4">
    <h2>Enter Your Information</h2>
    <form action="/Crud_app/crude-app/covid_hospital.php" method="POST">
                <div class="form-group">
                    <label for="name">Doctor Name</label>
                  <input type="text" class="form-control" id="insertName" name="insertName" placeholder="Enter Doctor Name">
                </div>
                <div class="form-group">
                    <label for="ward">Ward Number</label>
                    <input type="text" class="form-control" id="insertWard" name="insertWard" placeholder="Enter Ward Number" >
                  </div>
                  <div class="form-group">
                    <label for="patientsNumber">The Number of Patients</label>
                    <input type="number" class="form-control" id="insertPatientNumber" name="insertPatientNumber" placeholder="Enter the number of patients in the ward">
                  </div>
          <button type="submit" class="btn btn-primary">Add Your Information</button>
      </form>
  </div>


  <div class="container my-4">

<table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Doctor Name</th>
          <th scope="col">Ward Number</th>
          <th scope="col">Number of Patients</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
      $sql = "SELECT * FROM `covid_hospital_details`";
      $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['doctor_name'] . "</td>
            <td>". $row['ward_number'] . "</td>
            <td>". $row['number_of_patients'] . "</td>
            <td> <button class='editHospitalDatabase btn btn-sm btn-warning' id=".$row['sno'].">Edit</button> <button class='deleteHospitalDatabase btn btn-sm btn-danger' id=d".$row['sno'].">Delete</button>  </td>
            
          </tr>";
        } 
          ?>


      </tbody>
    </table>


  </div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
     integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
     crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" 
    crossorigin="anonymous"></script>

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
      $('#myTable').DataTable();

    });
  </script>
  <script>
    editHospital = document.getElementsByClassName('editHospitalDatabase');
    Array.from(editHospital).forEach((element) => {
      element.addEventListener("click" , (e) => {
        console.log("editHospitalDatabase" , );
        tr = e.target.parentNode.parentNode;
        doctor_name = tr.getElementsByTagName("td")[0].innerText;
        ward_number = tr.getElementsByTagName("td")[1].innerText;
        patients_number = tr.getElementsByTagName("td")[2].innerText;
        console.log(doctor_name,ward_number,patients_number);
        editName.value = doctor_name;
        editWard.value = ward_number;
        editPatientsNumber.value = patients_number;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');
      })
    })



    deleteHospitalRecords = document.getElementsByClassName('deleteHospitalDatabase');
    Array.from(deleteHospitalRecords).forEach((element) => {
      element.addEventListener("click" , (e) => {
        console.log('deleteHospitalRecords' , );
        $('#deleteModal').modal('toggle');
        sno = e.target.id.substr(1);
        deleteHospital.value = sno;
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