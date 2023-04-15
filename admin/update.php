<?php
require_once("include/connect.php");
require_once("include/header.php");
$id =$_GET['updateid'];
$sql = "SELECT * FROM `elections` WHERE id = $id LIMIT 1";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>

<?php
if(isset($_POST['UpdateElection_Btn']))
{
    $Election_Topic = mysqli_real_escape_string($con, $_POST['Election_Topic']);
    $Number_of_candidates = mysqli_real_escape_string($con, $_POST['Number_of_candidates']);
    $Start_Date = mysqli_real_escape_string($con, $_POST['Start_Date']);
    $End_Date  = mysqli_real_escape_string($con, $_POST['End_Date']);
    $Inserted_By = $_SESSION['username'];
    $Inserted_on = date("y-m-d");


    $date1=date_create($Inserted_on);
$date2=date_create($Start_Date);
$diff=date_diff($date1,$date2);


if((int)$diff->format("%R%a") > 0)
{
    $Status = "InActive";
}else{
    $Status = "Active";
}





    // Inserting into Database.
 $sql = "UPDATE `elections` SET `Election_Topic`=' $Election_Topic',`No_of_Candidates`='$Number_of_candidates',`Starting_Date`='$Start_Date',`Ending_Date`='$End_Date',`Status`='$Status',`Inserted_By`='$Inserted_By',`Inserted_on`='$Inserted_on' WHERE id=$id";
 $result = mysqli_query($con,$sql);
 if($result){
//    echo "Data Updated Succesfully!!!!";
    ?>

<script> location.assign("index.php?AddElectionPage=1&Updated=1");</script>


    <?php

 }
 
 else{
  die(mysqli_error($con));
 }

 }

?>

 <?php
       
 
// mysqli_query($con, "Update  `elections` set id= $id, (Election_Topic,
//  No_of_Candidates, Starting_Date, Ending_Date,Status, Inserted_By, Inserted_on) VALUES('". $Election_Topic."', '". $Number_of_candidates."','". $Start_Date."','". $End_Date."', '". $Status."','". $Inserted_By."','".  $Inserted_on."')") or
// die(mysqli_error($con));
// }
// ?>

<!-- <script> location.assign("index.php?AddElectionPage=1&Updated=1");</script> -->











<div class="row my-3">
    <div class="col-8">
        <h3>Update Election</h3>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="Election_Topic" placeholder="Enter Election Topic" class="form-control" value="<?php echo $row['Election_Topic'];?>" required />
            </div><br />

            <div class="form-group">
                <input type="number" name="Number_of_candidates" placeholder="Enter Number Of Candidates" class="form-control"  value="<?php echo $row['No_of_Candidates'];?>" required />
            </div> <br />

            <div class="form-group">
                <input type="text" onfocus="this.type='Date'" name="Start_Date" placeholder="Enter Starting Date" class="form-control" value="<?php echo $row['Starting_Date'];?>" required />
            </div><br />

            <div class="form-group">
                <input type="text" onfocus="this.type='Date'" name="End_Date" placeholder="Enter Ending Date" class="form-control" value="<?php echo $row['Ending_Date'];?>"required />
            </div><br />
            
            <input type="submit" value="Update Election" name="UpdateElection_Btn" class="btn btn-success " />
           
        </form>
    </div>

<?php
require_once("include/footer.php");
?>

