<?php
if(isset($_GET['added']))
{
?>

<div class="alert alert-success my-3" role="alert">
  ******Candidate has been added Successfully.******
</div>
<?php
}else if(isset($_GET['delete_id']))
{
    $Delete_id = $_GET['delete_id'];
    mysqli_query($con, "DELETE FROM candidate_details WHERE id = '". $Delete_id."'")
    or die(mysqli_error($con));
    ?>
<div class="alert alert-danger my-3" role="alert">
  ******Candidate has been Deleted Successfully.******
</div>



<?php
}else if(isset($_GET['largeFile'])){
    ?>
<div class="alert alert-danger my-3" role="alert">
  ******Candidate image is too Large, Upload Small Size Image i.e. <=2MB.******
</div>

    <?php
}else if(isset($_GET['InvalidFile']))
        {
            ?>
            <div class="alert alert-danger my-3" role="alert">
  ****** Invalid image type(only .jpg, .png, jpeg files are allowed) ******
</div>
            <?php
        }else if(isset($_GET['Failed']))
        {
            ?>
                    <div class="alert alert-danger my-3" role="alert">
  ****** Image uploading Failed. Try Again!!!! ******
</div>
       
            <?php
        }

?>

<div class="row my-3">
    <div class="col-4">
        <h3>Add New Candidates</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">


            <select class="form-control" name="Election_id" required >
                <option value=""> Select Election </option>
                <?php
                $FetchElections = mysqli_query($con, "SELECT * FROM elections") OR die(mysqli_error($con));
                $IsAnyElectionAdded = mysqli_num_rows($FetchElections);
                if($IsAnyElectionAdded > 0)
                {
                        while($row = mysqli_fetch_assoc($FetchElections))
                        {
                            $Election_id = $row['id'];
                            $Election_name = $row['Election_Topic'];
                            $Allowed_Candidates = $row['No_of_Candidates'];// Contains Permission for Candidate in an Election.

                            //Now checking how many candidates are added in the Election.
                            $fetchingCandidate = mysqli_query($con, "SELECT * FROM candidate_details WHERE election_id = '". $Election_id ."'")
                            or die(mysqli_error($con));
                            //Calculating the Number of rows from the Above Query.
                            $added_candidates = mysqli_num_rows($fetchingCandidate);// Contains How many Candidates are there in a Election checks by counting rows as election has a unique ID.

                            if($added_candidates < $Allowed_Candidates)
                            {
                                
                            
                            ?>

                            <option value="<?php echo $Election_id; ?>"><?php echo $Election_name; ?></option>

                            <?php
                            }
                        }
                    
                }else{
                    ?>
                    <option value="">  No any election is added. </option>

                    <?php

                }
                ?>
            </select><br />
            </div>
           
               

            <div class="form-group">
                <input type="text" name="Name_of_candidate" placeholder="Enter Name of Candidate" class="form-control" required />
            </div> <br />

            <div class="form-group">
                <input type="file" name="Candidate_Photo"class="form-control" required />
            </div><br />

            <div class="form-group">
                <input type="text" name="Candidate_Details" placeholder="Input Candidate Details" class="form-control" required />
            </div><br />
            <input type="submit" value="Add Candidate" name="AddCandidate_Btn" class="btn btn-success" />
        </form>
    </div>
    
    <div class="col-8">
        <h3>Candidate Details</h3>
        <table class="table">
            <thead>
            <tr>
             <th scope="col">S.No</th>
             <th scope="col">Photo</th>
             <th scope="col">Name</th>
             <th scope="col">Details</th>
             <th scope="col">Election</th>
             <th scope="col">Action</th>



            </tr>
            </thead>
                <tbody>
                    <?php
                        $FetchData = mysqli_Query($con, "SELECT * FROM candidate_details") or die(mysqli_error($con));
                        $IsAnyCandidateAdded = mysqli_num_rows($FetchData);

                        if($IsAnyCandidateAdded > 0)
                        {
                            $sno = 1;
                                while($row = mysqli_fetch_assoc($FetchData))
                                {
                                   

                                    $Election_id = $row['election_id'];
                                    $fetchingElectionName = mysqli_query($con, "SELECT * FROM elections WHERE id ='". $Election_id."'") or
                                    die(mysqli_error($con));
                                    $execFetchingElectionNameQuery = mysqli_fetch_assoc($fetchingElectionName);
                                    $election_name = $execFetchingElectionNameQuery['Election_Topic'];
                                    $candidate_photo = $row['Candidate_Photo'];
                                    
                                    $Candidate_id = $row['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $sno++; ?></td>
                                        <td> <img src="<?php echo $candidate_photo; ?>" class="Candidate_photo"  />  </td>
                                        <td><?php echo $row['Candidate_Name'] ?></td>
                                        <td><?php echo $row['Candidate_Details'] ?></td>
                                        <td><?php echo  $election_name ?></td>

                                        


                                        
                                        <td>
                                            <a href="updatecandidate.php?updateid=<?= $row['id'] ?>" class="btn btn-sm btn-warning"> Edit </a>
                                            <!-- <a href="#" class="btn btn-sm btn-danger"> Delete </a> -->
                                            <button class="btn btn-sm btn-danger" onclick="DeleteData(<?php echo 
                                            $Candidate_id;?>)"> Delete </button>

                                        </td>




                                        

                                        
                                    
                                    </tr>
                                    <?php
                                 }
                        }else{
                            ?>
                            <tr>
                                <td colspan="7"> No any Candidate is added yet. </td>
                        </tr>
                            <?php
                        }
                        
                    ?>
   
                </tbody>
        </table>
    </div>
</div>

<script>
    const DeleteData = (c_id) =>

    {
        let c = confirm("Do You Really want to Delete it?");

        if(c == true)
        {
            //alert("Data Deleted Successfully!!!");
            location.assign("index.php?AddCandidatesPage=1&delete_id=" + c_id );
           

        }
        //alert(e_id);
    }
</script>


<?php
if(isset($_POST['AddCandidate_Btn']))
{
    $Election_id = mysqli_real_escape_string($con, $_POST['Election_id']);
    $Name_of_candidate = mysqli_real_escape_string($con, $_POST['Name_of_candidate']);
    $Candidate_Details = mysqli_real_escape_string($con, $_POST['Candidate_Details']);
    $Inserted_By = $_SESSION['username'];
    $Inserted_on = date("y-m-d");

    // Election_id         Name_of_candidate       Candidate_Photo     Candidate_Details   AddCandidate_Btn

    //start
    //For Image Logic. Form is submitted through POST method but for accessing Images Global Variable i.e. FILES IS a 
    //two Dimensional array that is we have to put [][].
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
                            
                    // Inserting into Database.

                    mysqli_query($con, "INSERT INTO candidate_details(election_id, Candidate_Name, Candidate_Details, Candidate_Photo, inserted_by, inserted_on) VALUES('". $Election_id."', '". $Name_of_candidate."',
                    '". $Candidate_Details."','". $Candidate_Photo."', '". $Inserted_By."','". $Inserted_on."')") or
                    die(mysqli_error($con));
                    echo"<script> location.assign('index.php?AddCandidatesPage=1&added=1'); </script>";
                    
                    }else
                    {
             echo "<script> location.assign('index.php?AddCandidatesPage=1&Failed=1'); </script>";

                    }
            }else{
             echo "<script> location.assign('index.php?AddCandidatesPage=1&InvalidFile=1'); </script>";

            }
    }else
    {
        echo "<script> location.assign('index.php?AddCandidatesPage=1&largeFile=1'); </script>";
    }

    
    
    //echo $Candidate_Photo_type;

    //echo  $Candidate_Photo_tmp_name;    
    die;    
    

    //End



  ?>

  <?php
        
}
?>