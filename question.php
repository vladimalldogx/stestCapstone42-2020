<?php
                 require_once("connection.php");
				 $error_message = "";
				 $error = false;
				 $id = "";
				 $quemain = "";
				 $queopt1 = "";
				 $queopt2 = "";
				 $queopt3 = "";
				 $queopt4 = "";
				 $queans = "";
				 $html = "";
				
				 
				 
				 if(isset($_POST['btnadd'])){
                 $id = $_POST['txtid'];
				 $quemain = $_POST['txtmain'];
				 $queopt1 = $_POST['txtopt1'];
				 $queopt2 = $_POST['txtopt2'];
				 $queopt3 = $_POST['txtopt3'];
				 $queopt4 = $_POST['txtopt4'];
				 $queans = $_POST['txtans'];
				 
				 if(empty($id) && empty($queopt1) && empty($queopt2) && empty($queopt3) && empty($queopt4) && empty($queans)){
				 $error_message = "No record to add";
				 $error = true;
				 }
				 else{
				 $query = "SELECT * FROM questions";
				 mysqli_query($con, $query);
				 $result = mysqli_query($con, $query);
				 while($rows = mysqli_fetch_assoc($result)){
				 if($rows['queID']==$id){
				 $error_message = "Record already Exist";
				 $error = true;
				 }
				 }
				 if(!$error){
				 $query = "INSERT INTO questions(queID, queMain, queOpt1, queOpt2, queOpt3, queOpt4, queAns)VALUES('$id', '$quemain', '$queopt1', '$queopt2', '$queopt3', '$queopt4', '$queans')";
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
				 $query = "DELETE FROM questions WHERE queID = $id";
				 mysqli_query($con, $query);
				 $error_message = "Record successfully deleted!";
				 $error = false;
				 }
				 }
				 if(isset($_POST['btnedit'])){
				 $id = $_POST['txtid'];
				 $quemain = $_POST['txtmain'];
				 $queopt1 = $_POST['txtopt1'];
				 $queopt2 = $_POST['txtopt2'];
				 $queopt3 = $_POST['txtopt3'];
				 $queopt4 = $_POST['txtopt4'];
				 $queans = $_POST['txtans'];
				 
				 if(empty($id) && empty($quemain) && empty($queopt1) && empty($queopt2) && empty($queopt3)  && empty($queopt4)  && empty($queans)){
				 $error_message = "No record to edit";
				 $error = true;
				 }
				 else{
				 $query = "UPDATE questions SET queID = '$id', queMain = '$quemain', queOpt1 = '$queopt1', queOpt2 = '$queopt2', queOpt3 = '$queopt3', queAns =' $queans'    WHERE queID = '$id'"; 
				 $result = mysqli_query($con, $query);
				 $error_message = "Record Successfully Updated!";
				 $error = false;
				 }
				 }
				 
				 if(isset($_POST['btnsearch'])){
				   $id = $_POST['txtid'];
				  $query = "SELECT * FROM questions WHERE queID = '$id'";
				  $result = mysqli_query($con, $query);
				  $rows = mysqli_fetch_assoc($result);
				  if(($rows) > 0){
				  $error_message = "Record Found";
				 $error = false;
				 $id = $rows['queID'];
				$quemain = $rows['queMain'];
				 $queopt1 = $rows['queOpt1'];
				 $queopt2 = $rows['queOpt2'];
				 $queopt3 = $rows['queOpt3'];
				 $queopt4 = $rows['queOpt4'];
				 $queans = $rows['queAns'];
				 $html .= '<tr>
				               <td>'.$id.'</td>
							   <td>'.$quemain.'</td>
							   <td>'.$queopt1.'</td>
							   <td>'.$queopt2.'</td>
							   <td>'.$queopt3.'</td>
							   <td>'.$queopt4.'</td>
							   <td>'.$queans.'</td>
				                </tr>';
				 
				  }
				  else{
				  $id = "";
				  $error_message = "No record found";
				  $error = true;
				  }
				 }
				 
				 else{
				 $query = "SELECT * FROM questions";
				 $result = mysqli_query($con, $query);
				 while($rows = mysqli_fetch_assoc($result)){
				 
				 $html .= "<tr class='table'>
				               <td>".$rows['queID']."</td>
							   <td>".$rows['quemain']."</td>
							   <td>".$rows['queOpt1']."</td>
							   <td>".$rows['queOpt2']."</td>
							   <td>".$rows['queOpt3']."</td>
							   <td>".$rows['queOpt4']."</td>
							   <td>".$rows['queAns']."</td>
							  
				                </tr>";
				 }
				
				 }
				 
?>
<html>
<head>
<title>Practice</title>
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
      <a class="nav-link" href="">QUIT as Orphan </a>
    </span>
  </div>
</nav>
<div id = "wrapper">
<form method = "POST" action = "question.php">
<div id = "firstbox">
<table>
                            <tr>
							<td><label>ID</label></td>
							<td><input type = "text" name = "txtid"<?php if($error){echo "autofocus";} if(isset($_POST['btnsearch'])){if(!$error){echo "value = '".$id."'";}}?>></td>
							</tr>
							<tr>
							<td><label>QUESTION MAIN</label></td>
							<td><input type = "text" name = "txtmain" value = "<?php if(isset($_POST['btnsearch'])){echo $quemain;}?>"></td>
							</tr>
							<tr>
							<td><label>QUESTION OPT1</label></td>
							<td><input type = "text" name = "txtopt1" value = "<?php if(isset($_POST['btnsearch'])){echo $queopt1;}?>"></td>
							</tr>
							<tr>
							<td><label>QUESTION OPT2</label></td>
							<td><input type = "text" name = "txtopt2" value = "<?php if(isset($_POST['btnsearch'])){echo $queopt2;}?>"></td>
							</tr>
							<tr>
							<td><label>QUESTION OPT3</label></td>
							<td><input type = "text" name = "txtopt3" value = "<?php if(isset($_POST['btnsearch'])){echo $queopt3;}?>"></td>
							</tr>
							<tr>
							<td><label>QUESTION OPT4</label></td>
							<td><input type = "text" name = "txtopt4" value = "<?php if(isset($_POST['btnsearch'])){echo $queopt4;}?>"></td>
							</tr>
							<tr>
							<td><label>QUESTION ANS</label></td>
							<td><input type = "text" name = "txtans" value = "<?php if(isset($_POST['btnsearch'])){echo $queans;}?>"></td>
							</tr>
							
							
</div>
</table>
                             <div style ="float:right; margin-top: -100px;">
							 <button class="btn btn-primary" type = "submit" name = "btnadd">ADD</button>
							 <button class="btn btn-danger" type = "submit" name = "btndelete">DELETE</button>
							 <button class="btn btn-edit" type = "submit" name = "btnedit">UPDATE</button>
							 <button class="btn btn-primary" type = "submit" name = "btnsearch">SEARCH</button><br><br>
							 <div class='alert alert-primary' role='alert'>
							 <?php
							 if($error_message !=""){
							 echo $error_message;
							 }
							 ?>
							 </div>
							 </div>
</form><br><br>
							  <table class="table">
							  <thead class="thead-dark" style="background-color:#060000;">
							  <th width = "10%">ID</th>
							  <th width = "20%">QUESTION MAIN</th>
							  <th width = "20%">QUESTION OPTION1</th>
							  <th width = "20%">QUESTION OPTION2</th>
							  <th width = "20%">QUESTION OPTION3</th>
							  <th width = "20%">QUESTION OPTION4</th>
							  <th width = "20%">QUESTION ANSWER</th>
							  
							  </thead>
							  <tbody>
							  <?php
							  echo $html;
							  ?>
							  </tbody>
							  </table>
</div>

</body>
<a href = "home.php">back</a>
</html>