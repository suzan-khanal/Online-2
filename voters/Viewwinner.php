<!-- This is a Dynamic Page Showing Winning Candidate!!! -->
<?php
require_once("include/header.php");


?>
<?php
$Election_id = $_GET['Election_id'];
$query = mysqli_query($con, "SELECT * FROM elections WHERE id = '". $Election_id ."'") or
die(mysqli_error($con));


while($data = mysqli_fetch_assoc($query))
{
  $Election_Topic = $data['Election_Topic'];
}
?>


        <tr>
            <th><h4 style="color:green;text-align:center;"> Election Results Of: <?php echo strtoupper($Election_Topic);  ?> <h4></th>
        </tr>
        
<table class="table">
    

        <thead class="table-primary">
    <tr>
      <th scope="col">Candidate ID</th>
      <th scope="col">Candidate Photo</th>
      <th scope="col">Candidate Name</th>
      <th scope="col">Votes</th>
      <!-- <th scope="col">Status</th> -->
        </tr>

  </thead>






   


    <tbody>
    

        <?php
            $FetchingCandidates = mysqli_query($con, "SELECT * FROM candidate_details WHERE election_id = '".$Election_id."'") or die(mysqli_error($con));
            $Candidates = mysqli_num_rows($FetchingCandidates);
            if($Candidates > 0)
            {
        //print_r($FetchingCandidates);
        while($candidateData = mysqli_fetch_assoc($FetchingCandidates))
        {

            $candidate_id = $candidateData['id'];
            $candidate_Photo = $candidateData['Candidate_Photo'];

            // Fetching Candidate Votes.
            //This query goes to votings table and brings all votes of candidates of a particular Candidate according to ID.
            $FetchingVotes = mysqli_query($con, "SELECT * FROM votings WHERE candidate_id = '". $candidate_id ."'") or die(mysqli_error($con));
           
            //Since, Double voting permission is not allowed in one Election. So,How Many Rows that much Votes.so,$TotalVotes is created to count votes.
            $TotalVotes = mysqli_num_rows($FetchingVotes);
		
        //echo $_SESSION['user_id'];
            ?>
                <tr>
                <td><?php echo $candidate_id; ?></td>
                <td><img src="<?php echo $candidate_Photo ?> " class="Candidate_photo"></td>
                    <td><?php echo "<b>".$candidateData['Candidate_Name'] ."</b><br />" .$candidateData['Candidate_Details'];  ?></td>
                    <td><?php echo $TotalVotes; ?> </td>
                    
                     

                </tr>
            <?php
        }
        ?>
    

    

        
        




      
        
<?php
    }else{
        ?>
      <td><?php echo "No Candidate Details Available!!!";?></td>
        <?php
    }
    ?>


    
</div>

</div>
</tbody>
</table>


<?php
require_once("include/footer.php");
?>