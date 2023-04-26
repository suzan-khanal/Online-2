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
        // $candidateData
           
            $candidatesWon= 0; 
            
            $FetchingCandidates = mysqli_query($con, "SELECT * FROM candidate_details WHERE election_id = '".$Election_id."'") or die(mysqli_error($con));
            $Candidates = mysqli_num_rows($FetchingCandidates);
            if($Candidates > 0)
            {
        //print_r($FetchingCandidates);
                    while($candidateData = mysqli_fetch_assoc($FetchingCandidates))
       
        {
           

                     $candidate_id = $candidateData['id'];
                     $candidate_Name = $candidateData['Candidate_Name'];
                     $candidate_Photo = $candidateData['Candidate_Photo'];

            // Fetching Candidate Votes.
            //This query goes to votings table and brings all votes of candidates of a particular Candidate according to ID.
                     $FetchingVotes = mysqli_query($con, "SELECT * FROM votings WHERE candidate_id = '". $candidate_id ."'") or die(mysqli_error($con));
           
            //Since, Double voting permission is not allowed in one Election. So,How Many Rows that much Votes.so,$TotalVotes is created to count votes.
                     $TotalVotes = mysqli_num_rows($FetchingVotes);
                     $candidatevotes[$candidate_id]= $TotalVotes;
           
           
          
        //echo $_SESSION['user_id'];
            ?>
                <tr>
                <td><?php echo $candidate_id; ?></td>
                <td><img src="<?php echo $candidate_Photo ?> " class="Candidate_photo"></td>
                    <td><?php echo "<b>".$candidateData['Candidate_Name'] ."</b><br />" .$candidateData['Candidate_Details'];  ?></td>
                    <td><?php echo $TotalVotes; ?> </td>
                    
 

                </tr>
            <?php
             if($candidatesWon<$candidatevotes[$candidate_id]){
                $candidatesWon=$candidatevotes[$candidate_id];
                   $candidateWonId=$candidate_id;
                   $CandidateName = $candidate_Name;
            }
        }
        ?>
<div class="alert alert-primary" role="alert" style="text-align:center;">
  **********    Candidate with Candidate_ID == <?php  echo $candidateWonId ; ?> && CandidateName == <?php  echo $CandidateName; ?> has Won the Election.     **********
</div> 
        <?php
    //Comment 1
       // echo $candidateWonId;
       
       
       // if($candidatevotes[0]>$candidatevotes[1]){
        // echo "Candidate1 won ";
        // }
        // else{ 
        //     echo"Candidate2 won";
       
        // }

        
       // $candidatesWon= $candidatevotes[0];  
    //     $candidateWonId=0; 
    //    for($i=0;$i<$n;$i++){   
             
    //          if($candidatesWon<$candidatevotes[$i]){
    //         $candidatesWon=$candidatevotes[$i];
    //            $candidateWonId=$i;
    //     }
       
       
     //}
    
      ?>
      <hr>
     <td>
          <?php
        //    echo $candidateData['$candidateWonId'];
        ?>
<!-- <div class="alert alert-primary" role="alert">
  Candidate with Candidate_ID <?php  
//   echo $candidateWonId; ?> has Won the Ellection.
</div> -->
        <?php
        //Comment 2
       // echo $candidateWonId;


        // echo $candidateWonId['Candidate_Name'];
        // $sql =  mysqli_query($con, "SELECT (Candidate_Name) FROM `candidate_details` WHERE id = '". $candidateWonId ."'") or die(mysqli_error($con));
        // $Count= mysqli_num_rows($sql);
        // if($Count > 0)
        // {
        //     while($candidateData = mysqli_fetch_assoc($sql))
        //     {
        //         echo $candidateData ['Candidate_Name'] ;
        //         var_dump($candidateData);
        //     }
        // }

           ?>
           </td>
     <!-- $candidateData[$candidateWonId] -->

<!-- $candidatevotes[i]= $TotelVotes; -->
<!-- i++; -->
<!-- Sandesh Limbu8:22 PM -->
<!-- if($candidatevotes[0]>$candidatevotes[1]){ -->
<!-- echo "Candidate1 won "; -->
<!-- } -->
<!-- else{ -->
<!-- echo"Candidate2 won"; -->
<!-- } -->


<!-- for($i=0;$i<$n;$i++){    $candidatesWon= $cadidate[0];       if($cadidatesWon<$candidate[i]){ -->
<!-- } -->
<!-- $candidatesWon=$candidate[i]; -->
<!-- }
    

    

        
        




      
        
<?php
    }
    else{
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