<?php
require_once("include/connect.php");
require_once("include/header.php");
$id =$_GET['updateid'];
$sql = "SELECT * FROM `candidate_details` WHERE id = $id LIMIT 1";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>


<?php
if(isset($_POST['updateCandidate_Btn']))
{
    $Candidate_Name = mysqli_real_escape_string($con, $_POST['Name_of_candidate']);
    $Candidate_Details = mysqli_real_escape_string($con, $_POST['Candidate_Details']);
    $Inserted_By = $_SESSION['username'];
    $Inserted_on = date("y-m-d");
    //$Candidate_Image = $_FILES($con, $_POST['Candidate_Photo']);
    $target_Folder = "../assets/images/candidate_photo/";
    $Candidate_Photo = $target_Folder . rand(1111111111,99999999999) ."_".rand(1111111111,99999999999). $_FILES['Candidate_Photo']['name'];   
    $Candidate_Photo_tmp_name = $_FILES['Candidate_Photo']['tmp_name'];  
    
    
    
     // Validation to only insert images.pathinfo() is a function in php
     $Candidate_Photo_type = strtolower(pathinfo($Candidate_Photo, PATHINFO_EXTENSION));
     $allowed_type = array("jpg", "png", "jpeg");
     $img_size = $_FILES['Candidate_Photo']['size'];  
 
     //echo $img_size;
 
     if($img_size < 2000000)//2000000 = 2MB.
     {
     $allowed_type = array("jpg", "png", "jpeg");
             if(in_array($Candidate_Photo_type, $allowed_type ))
             {
                     if(move_uploaded_file($Candidate_Photo_tmp_name, $Candidate_Photo ))
                     {
                             
                     // Inserting into Database
                     $sql = "UPDATE `candidate_details` SET `Candidate_Name`='$Candidate_Name',`Candidate_Details`='$Candidate_Details',`Candidate_Photo`='$Candidate_Photo',`inserted_by`='$Inserted_By',`inserted_on`='$Inserted_on' WHERE id=$id";
                    $result = mysqli_query($con,$sql);

if($result){
    //    echo "Data Updated Succesfully!!!!";
        ?>
    
    <script> location.assign("index.php?AddCandidatesPage=1&Updated=1");</script>
?>
<?php
}


}else
    {
        
        echo "<script> location.assign('index.php?AddCandidatesPage=1&largeFile=1'); </script>";
    }
    
    
    


































       
    
     }
     
     else{
      die(mysqli_error($con));
     }
    
     }
    
    ?>
    <?php
}
?>

<div class="row my-3">
    <div class="col-8">
        <h3>Update Candidates</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">


           
               

            <div class="form-group">
                <input type="text" name="Name_of_candidate" placeholder="Enter Name of Candidate" class="form-control" value="<?php echo $row['Candidate_Name']; ?>" required />
            </div> <br />

            <div class="form-group">
                <input type="file" name="Candidate_Photo" class="form-control" value="<?php echo $row['Candidate_Photo'];?>" required />
            </div><br />

            <div class="form-group">
                <input type="text" name="Candidate_Details" placeholder="Input Candidate Details" class="form-control"  value="<?php echo $row['Candidate_Details'];?>"  required />
            </div><br />
            <input type="submit" value="Update Candidate" name="updateCandidate_Btn" class="btn btn-success" />
        </form>
    </div>
</div>

<?php

require_once("include/footer.php");
   
?>