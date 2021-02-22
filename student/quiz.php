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
				 $query = "UPDATE questions SET queID = '$id', queMain = '$quemain', queOpt1 = '$queopt1', queOpt2 = '$queopt2', queOpt3 = '$queopt3', $queAns = '$queans'  WHERE queID = '$id'"; 
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
				 
				 $html .= '<tr>
				               <td><br>'.$rows['queID'].'</br></td>
							   <td><br><u>'.$rows['quemain'].'</u></br></td>
							   <td><input required type="radio" name="rdo1"<br>'.$rows['queOpt1'].'</br></td>
							   <td><input required type="radio"name ="rdo2"<br>'.$rows['queOpt2'].'</br></td>
							   <td><input required type="radio" name="rdo3"<br>'.$rows['queOpt3'].'</br></td>
							   <td><input required type="radio" name="rdo 4"<br>'.$rows['queOpt4'].'</br></td>
							   <td>&nbsp;&nbsp;<br>
							   </td>
							  
				                </tr>';
				 }
				
				 }
				 
?>
<html>
<head>
<title>Practice</title>
</head>

<body>
<div id = "wrapper">
<form method = "POST" action = "quiz.php">
<div id = "firstbox">
<table>
                          <!--  <tr>
							<td><label>ID</label></td>
							<td><input type = "text" name = "txtid"<?php if($error){echo "autofocus";} if(isset($_POST['btnsearch'])){if(!$error){echo "value = '".$id."' $quemain;";}}?>></td>
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
							-->
							
</div>
</table>
<!--
                             <div style ="float:right; margin-top: -100px;">
							 <button type = "submit" name = "btnadd">ADD</button>
							 <button type = "submit" name = "btndelete">DELETE</button>
							 <button type = "submit" name = "btnedit">UPDATE</button>
							 <button type = "submit" name = "btnsearch">SEARCH</button><br><br>
							 <textarea style ="margin:0px; height:70px; width:200px;">
							 <?php
							 if($error_message !=""){
							 echo $error_message;
							 }
							 ?>
							 </textarea>
							 </div>
							 -->
</form><br><br>
                             <!-- <table style = "text-align: center;" border = "1">
							  <thead border = "0" style = "background-color: white; color:green;">
							  <th width = "10%">ID</th>
							  <th width = "20%">QUESTION MAIN</th>
							  <th width = "20%">QUESTION OPTION1</th>
							  <th width = "20%">QUESTION OPTION2</th>
							  <th width = "20%">QUESTION OPTION3</th>
							  <th width = "20%">QUESTION OPTION4</th>
							  <th width = "20%">QUESTION ANSWER</th>
							  -->
							  
							  </thead>
							  <tbody>
							  <?php
							  echo $html;
							  ?>
							  </tbody>
							  </table>
</div>

</body>
<a href = "index.php">back to home</a> &nbsp;&nbsp;&nbsp;&nbsp; <button type="button">Submit!</button>

<bu
</html>