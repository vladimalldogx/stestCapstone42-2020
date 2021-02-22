<?php
                 require_once("connection.php");
				 $error_message = "";
				 $error = false;
				 $id = "";
				 $firstname = "";
				 $lastname = "";
				 $middlename = "";
				 $html = "";
				
				 
				 
				 if(isset($_POST['btnadd'])){
                 $id = $_POST['txtid'];
				 $firstname = $_POST['txtfirst'];
				 $lastname = $_POST['txtlast'];
				 $middlename = $_POST['txtmid'];
				 
				 if(empty($id) && empty($firstname) && empty($lastname) && empty($middlename)){
				 $error_message = "No record to add";
				 $error = true;
				 }
				 else{
				 $query = "SELECT * FROM students";
				 mysqli_query($con, $query);
				 $result = mysqli_query($con, $query);
				 while($rows = mysqli_fetch_assoc($result)){
				 if($rows['studID']==$id){
				 $error_message = "Record already Exist";
				 $error = true;
				 }
				 }
				 if(!$error){
				 $query = "INSERT INTO students(studID, studFname, studMname, studLname)VALUES('$id', '$firstname', '$lastname', '$middlename')";
				 mysqli_query($con, $query);
				 $error_message = "Record successfully saved!";
				 $error = false;
				 }
				 }
				 }
				 
				 if(isset($_POST['btndelete'])){
				 $id = $_POST['txtid'];
				 if($id ==""){
				 $error_message = "No record to delete";
				 $error = true;
				 }
				 else{
				 $query = "DELETE FROM students WHERE studID = $id";
				 mysqli_query($con, $query);
				 $error_message = "Record successfully deleted!";
				 $error = false;
				 }
				 }
				 if(isset($_POST['btnedit'])){
				 $id = $_POST['txtid'];
				 $firstname = $_POST['txtfirst'];
				 $lastname = $_POST['txtlast'];
				 $middlename = $_POST['txtmid'];
				 
				 if(empty($id) && empty($firstname) && empty($lastname) && empty($middlename)){
				 $error_message = "
				 No Records to be Added!
			   		";
				 $error = true;
				 }
				 else{
				 $query = "UPDATE students SET studID = '$id', studFname = '$firstname', studLname = '$lastname', studMname = '$middlename' WHERE studID = '$id'"; 
				 $result = mysqli_query($con, $query);
				 $error_message = "Record Successfully Updated!";
				 $error = false;
				 }
				 }
				 
				 if(isset($_POST['btnsearch'])){
				   $id = $_POST['txtid'];
				  $query = "SELECT * FROM students WHERE studID = '$id'";
				  $result = mysqli_query($con, $query);
				  $rows = mysqli_fetch_assoc($result);
				  if(($rows) > 0){
				  $error_message = "Search Found";
				 $error = false;
				 $id = $rows['studID'];
				 $firstname = $rows['studFname'];
				 $lastname = $rows['studLname'];
				 $datestart = $rows['studMname'];
				 $html .= "<tr class ='table thead-dark'>
				               <td>'.$id.'</td>
							   <td>'.$firstname.'</td>
							   <td>'.$lastname.'</td>
							   <td>'.$middlename.'</td>
							   <td> <a href='quiz.php' class='button'>Quiz</a>
							   
							  
							   
							   
							   
							   </td>
				                </tr>";
				 
				  }
				  else{
				  $id = "";
				  $error_message = "No record found";
				  $error = true;
				  }
				 }
				 
				 else{
				 $query = "SELECT * FROM students";
				 $result = mysqli_query($con, $query);
				 while($rows = mysqli_fetch_assoc($result)){
				 
				 $html .= "<tr>
				               <td>".$rows['studID']."</td>
							   <td>".$rows['studFname']."</td>
							   <td>".$rows['studMname']."</td>
							   <td>".$rows['studLname']."</td>
							   <td> <a href='quiz.php' class='button'>Quiz</a>
							   
							   </td>
				                </tr>";
				 }
				
				 }
				 
?>
<html>
<head>
<title>Skillstest</title>
 <!-- Required meta tags -->
 <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="public/js/jquery.min.js" ></script>
      <script src="public/js/bootstrap.min.js" ></script>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="public/css/bootstrap.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">BNHS Portal </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
     
     
    </ul>
    <span class="navbar-text">
      <a class="nav-link" href="index.php">QUIT as Orphan </a>
    </span>
  </div>
</nav>
	<br> <br>
	<!--add Data-->
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            	</div>
            <div class="modal-body">
				<form method = "POST" action = "index.php">
							<div class="form-group">
							<label for="exampleInputEmail1">ID</label>
							<input type = "text" name = "txtid" class="form-control"<?php if($error){echo "autofocus";} if(isset($_POST['btnsearch'])){if(!$error){echo "value = '".$id."'";}}?>>
							</div>
							<div class="form-group">
							<label for="exampleInputEmail1">FIRSTNAME</label>
							<input type = "text" class="form-control" name = "txtfirst" value = "<?php if(isset($_POST['btnsearch'])){echo $firstname;}?>">
							</div>
							<div class="form-group">
							<<label for="exampleInputEmail1">MIDDLENAME</label>
							<input type = "text" class="form-control" name = "txtmid" value = "<?php if(isset($_POST['btnsearch'])){echo $middlename;}?>">
							</div>
							<div class="form-group">
							<label for="exampleInputEmail1">LASTNAME</label>
							<input type = "text" class="form-control" name = "txtlast" value = "<?php if(isset($_POST['btnsearch'])){echo $lastname;}?>">
							</div>
							
							 <button type = "submit" name = "btnadd">ADD</button>
							 </div>

                </form>
            </div>
            </div>
        </div>
		</div>
		<!--end modal -->
<div id = "wrapper">
<form method = "POST" action = "home.php">
<div id = "firstbox">	

                            
							<label>ID</label>
							<input type = "text" name = "txtid"<?php if($error){echo "autofocus";} if(isset($_POST['btnsearch'])){if(!$error){echo "value = '".$id."'";}}?>>
							
							
							<label>FIRSTNAME</label>
							<input type = "text" name = "txtfirst" value = "<?php if(isset($_POST['btnsearch'])){echo $firstname;}?>">
							
							
							<label>MIDDLENAME</label>
							<input type = "text" name = "txtmid" value = "<?php if(isset($_POST['btnsearch'])){echo $middlename;}?>">
							
							
							<label>LASTNAME</label>
							<input type = "text" name = "txtlast" value = "<?php if(isset($_POST['btnsearch'])){echo $lastname;}?>">
							
							
							
							


                             
							 <button class="btn btn-danger" type = "submit" name = "btndelete">DELETE</button>
							 <button class="btn btn-primary" type = "submit" name = "btnedit">UPDATE</button>
							 <button class="btn btn-warning" type = "submit" name = "btnsearch">SEARCH</button><br><br>
							 <div class='alert alert-primary' role='alert'>
							 <?php
							 if($error_message !=""){
							 echo "
							 
								 $error_message	";;
							 }
							 ?>
							 </div>
							 </div>
		 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add Data
        </button>							 
</form><br><br>
                              <table class="table">
							  <thead class="thead-dark" style="background-color:#060000;">
							  <th >ID</th>
							  <th >FIRSTNAME</th>
							  <th >LASTNAME</th>
							   <th >MIDDLENAME</th>
							  <th>Take Quiz</th>
							   
							  
							  </thead>
							  <tbody>
							  <?php
							  echo $html;
							  ?>
							  </tbody>
							  </table>
</div>

</body>
<a href = "question.php">add question</a>
</html>