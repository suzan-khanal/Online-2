<div class="row my-3">
     <div class="col-12">
        <h3>Elections</h3>
        <table class="table">
            <thead>
            <tr>
             <th scope="col">S.No</th>
             <th scope="col">Election Name</th>
             <th scope="col">No of Candidates</th>
             <th scope="col">Starting Date</th>
             <th scope="col">Ending Date</th>
             <th scope="col">Status</th>
             <th scope="col">Action</th>



            </tr>
            </thead>
                <tbody>
                    <?php
                        $FetchData = mysqli_Query($con, "SELECT * FROM elections") or die(mysqli_error($con));
                        $IsAnyElectionAdded = mysqli_num_rows($FetchData);

                        if($IsAnyElectionAdded > 0)
                        {
                            $sno = 1;
                                while($row = mysqli_fetch_assoc($FetchData))
                                {
                                    $election_id = $row['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $sno++; ?></td>
                                        <td><?php echo $row['Election_Topic']; ?></td>
                                        <td><?php echo $row['No_of_Candidates']; ?></td>
                                        <td><?php echo $row['Starting_Date']; ?></td>
                                        <td><?php echo $row['Ending_Date']; ?></td>
                                        <td><?php echo $row['Status']; ?></td>
                                        <td>
                                            <a href="index.php?viewResults=<?php echo $election_id; ?> " class="btn btn-sm btn-success"> View Results </a>

                                        </td>




                                        

                                        
                                    
                                    </tr>
                                    <?php
                                 }
                        }else{
                            ?>
                            <tr>
                                <td colspan="7"> No any election is added yet. </td>
                        </tr>
                            <?php
                        }
                        
                    ?>
   
                </tbody>
        </table>
    </div>
</div>


