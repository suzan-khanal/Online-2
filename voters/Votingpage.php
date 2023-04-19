<?php
require_once("include/header.php");
$id = $_GET['Election_id'];
$sql = "SELECT * FROM `elections` WHERE id = '$id' LIMIT 1";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

?>
<?php
$Name = $row['Election_Topic'];
$Election_id = $row['id'];

?>

<div class="row my-3">
<div class="col-12">
    <h3>Voters Panel</h3>
    <table class="table ">
    <thead>
        <tr class="bg_green ">
            <th colspan="4" class="text-white"><h4> ELECTION TOPIC: <?php echo strtoupper($Name);  ?> <h4></th>
        </tr>
        <tr>
            <th> Candidate Photo</th>
            <th> Candidate Details</th>
            <th> Votes</th>
            <th> Action</th>

        </tr>
</thead>
<tbody>
        <?php
            $FetchingCandidates = mysqli_query($con, "SELECT * FROM candidate_details WHERE election_id = '". $Election_id."'") or die(mysqli_error($con));
        
        //print_r($FetchingCandidates);
        while($candidateData = mysqli_fetch_assoc($FetchingCandidates))
        {
            $candidate_id = $candidateData['id'];
            $candidate_Photo = $candidateData['Candidate_Photo'];

            // Fetching Candidate Votes.
            $FetchingVotes = mysqli_query($con, "SELECT * FROM votings WHERE candidate_id = '". $candidate_id ."'") or die(mysqli_error($con));
            $TotalVotes = mysqli_num_rows($FetchingVotes);
		
        //echo $_SESSION['user_id'];
            ?>
                <tr>
                    <td><img src="<?php echo $candidate_Photo ?> " class="Candidate_photo"></td>
                    <td><?php echo "<b>".$candidateData['Candidate_Name'] ."</b><br />" .$candidateData['Candidate_Details'];  ?></td>
                    <td><?php echo $TotalVotes; ?> </td>
                    
                     <td>
                        <?php
                        $CheckIfVoteCasted = mysqli_query($con, "SELECT * FROM votings WHERE voters_id = '". $_SESSION['user_id'] ."' AND election_id = '". $Election_id."'")
                         or die(mysqli_error($con));
                         $IsVoteCasted = mysqli_num_rows($CheckIfVoteCasted);

                        if($IsVoteCasted > 0)
                        {
                            $voteCastedData = mysqli_fetch_assoc($CheckIfVoteCasted);
                            $voteCastedToCandidate = $voteCastedData['candidate_id'];

                            if($voteCastedToCandidate == $candidate_id)
                            {
                                ?>
                                <img src="../assets/images/v.png"width="100px;">
                                <?php
                            }
                          

                        }else{
                           
                            ?>
                            <button class="btn btn-md btn-success" onclick="castvote(<?php echo  $Election_id;?>, 
                            <?php  echo $candidate_id;?>, <?php  echo $_SESSION['user_id'];?> )"> Vote </button>  
  


                            <?php
                        }

?>
                          <!-- <button class="btn btn-md btn-success" onclick="castvote()"> Vote </button>  -->
                         
                        
                     </td>

                </tr>
            <?php
        }
        ?>
     </tbody>
</table>

</div>
</div>
<script>
// const castvote = () =>
// {
//     console.log("Working!!!");
// }



    const castvote = (election_id, candidate_id, voters_id) =>
    {
       //console.log(election_id + "-" + candidate_id + "-" +   voters_id);
      $.ajax({
       type: "POST",
       url: "include/Ajaxcalls.php",
       data: "e_id=" +  election_id + "&c_id="  + candidate_id + "&v_id=" +  voters_id,
       success: function(response){
          //console.log(response);
        if(response ==  "Success")
            {
                location.assign("Votingpage.php?VoteCasted=1&Election_id=" + election_id);
            }
            else{
                location.assign("Votingpage.php?VoteNotCasted=1&Election_id=" + election_id);

            }
        }
      });

    }
</script>



<?php
require_once("include/footer.php");
?>