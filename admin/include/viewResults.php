<!-- This will be our Dynamic Page. -->
<?php
$Election_id = $_GET['viewResults'];
?>

<div class="row my-3">
<div class="col-12">
    <h3>Election Results </h3>

    <?php
    $FetchingActiveElections = mysqli_query($con, "SELECT * FROM elections WHERE id = '". $Election_id ."'") or
     die(mysqli_error($con));
     $TotalActiveElections = mysqli_num_rows($FetchingActiveElections);

     if($TotalActiveElections > 0)
     {
        while($data = mysqli_fetch_assoc($FetchingActiveElections))
        {
            $Election_id = $data['id'];
            $Election_Topic = $data['Election_Topic'];
            ?>

<table class="table ">
    <thead>
        <tr class="bg_green ">
            <th colspan="4" class="text-white"><h4> ELECTION TOPIC: <?php echo strtoupper($Election_Topic);  ?> <h4></th>
        </tr>
        <tr>
            <th> Candidate Photo</th>
            <th> Candidate Details</th>
            <th> Votes</th>
            <!-- <th> Action</th> -->

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
                    
                     

                </tr>
            <?php
        }
        ?>
     </tbody>

    </table>

            <?php
        }
        
        

     }else{
        echo "No any Active Elections Available";
     }
    ?>

<hr>
<h3> Voting Details </h3>

    <?php
    $fetchingvotedetails = mysqli_query($con, "SELECT * FROM votings WHERE election_id = '". $Election_id."'");
    $Number_Of_Votes = mysqli_num_rows($fetchingvotedetails);

    if($Number_Of_Votes > 0)
    {
        $sno = 1;
        ?>
<table class="table">
    <tr>
        <th> S.No</th>
        <th>Voter Name </th>
        <th> Contact No.</th>
        <th> Voted To </th>
        <th>Date</th>
        <th>Time</th>

    </tr>

        <?php
        while($data = mysqli_fetch_assoc($fetchingvotedetails))
        {
            $voters_id = $data['voters_id'];
            $Candidate_id = $data['candidate_id'];

            $fetchingUserName = mysqli_query($con, "SELECT * FROM users WHERE id = '". $voters_id."'")
            or die(mysqli_error($con));
            $IsDataAvailable = mysqli_num_rows($fetchingUserName);
            $userData = mysqli_fetch_assoc($fetchingUserName);
            if($IsDataAvailable > 0)
            {
                
                $username = $userData['username'];
                $contact_no = $userData['mobile'];
            }
            else{
                $username = "No_Data";
                $contact_no = $userData['mobile'];

            }


            $fetchingCandidateName = mysqli_query($con, "SELECT * FROM candidate_details WHERE id = '". $Candidate_id."'")
            or die(mysqli_error($con));
            $IsDataAvailable = mysqli_num_rows($fetchingCandidateName);
            $CandidateData = mysqli_fetch_assoc($fetchingCandidateName);
            if($IsDataAvailable > 0)
            {
                
                $Candidate_Name = $CandidateData['Candidate_Name'];
               
            }
            else{
                $Candidate_Name = "No_Data";
                

            }
            ?>
            <tr>

            <td><?php echo $sno++;  ?></td>
            <td><?php echo $username;  ?></td>
            <td><?php echo $contact_no;  ?></td>
            <td><?php echo $Candidate_Name;  ?></td>
            <td><?php echo $data['vote_date'];  ?></td>
            <td><?php echo $data['vote_time'];  ?></td>

            </tr>
            <?php

        }
        echo "</table>";

    }else{
        echo "No any Vote   Details is Available!!!!";
    }
    ?>

</table>
    
</div>

</div>