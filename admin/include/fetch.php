<?php
if($_POST['request'])
{
$request = ($_POST['request']);
$connection = mysqli_connect('localhost', 'root', '', 'onlinevoting');
$query = "Select * from `elections`  where Status = '$request' ";
$row = mysqli_query($connection, $query);



    ?>
     <table class="table">
        <tr>
        <!-- <thead> -->
        <th scope="col">ID</th>
        <th scope="col">Election Name</th>
        <th scope="col">No of Candidates</th>
        <th scope="col">Starting Date</th>
        <th scope="col">Ending Date</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
        </tr>

    <tr><?php
    while($output= mysqli_fetch_assoc($row))
{
    ?>
                <td><?php  echo $output['id']; ?></td>
                <td><?php  echo $output['Election_Topic']; ?></td>
                <td><?php  echo $output['No_of_Candidates']; ?></td>
                <td><?php  echo $output['Starting_Date']; ?></td>
                <td><?php  echo $output['Ending_Date']; ?></td>
                <td><?php  echo $output['Status']; ?></td>
                <td>
                                           <a href="update.php?updateid=<?= $row['id'] ?>" class="btn btn-sm btn-warning"> Edit </a>
                                            <button class="btn btn-sm btn-danger" onclick="DeleteData(<?php echo 
                                            $election_id;?>)"> Delete </button>

                                        </td>





            </tr>
            <?php endwhile;?>  
            
        <!-- <tbody> -->
                    <?php
                       // $FetchData = mysqli_query($con, "SELECT * FROM elections") or die(mysqli_error($con));
                       // $IsAnyElectionAdded = mysqli_num_rows($FetchData);

                        //if($IsAnyElectionAdded > 0)
                       // {
                           
                               



                                        

                                        
                                    
                                 ?>   
                                    <?php
                               
                       // }else{
                            ?>
                            <!-- <tr> -->
                                <!-- <td colspan="7"> No any election is added yet. </td> -->
                        <!-- </tr> -->
                            <?php
                        //}
                        
                    ?>
   
                <!-- </tbody> -->






        <!-- </table> -->
            <?php
}

}



?>