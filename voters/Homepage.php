<?php
require_once("include/header.php");
require_once("include/navigation.php");

?>




<table class="table">
  <thead class="table-primary">
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Election Topic</th>
      <th scope="col">Number of Candidates</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php
$FetchingElections = mysqli_query($con, "SELECT * FROM `elections` WHERE Status = 'Active'")
or die(mysqli_error($con));
$IsAnyActiveElection = mysqli_num_rows($FetchingElections);

if($IsAnyActiveElection > 0)
{
$sno = 1;
while($row = mysqli_fetch_assoc($FetchingElections)){
    $Election_Id = $row['id'];
    $Election_Topic = $row['Election_Topic'];
    $Number_Of_Candidates = $row['No_of_Candidates'];
    $Status = $row['Status'];



?>

<tr>
    <td><?php echo $sno++;?></td>
    <td><?php echo $Election_Topic;?></td>
    <td><?php echo $Number_Of_Candidates;?></td>
    <td><?php echo $Status;?></td>
    <!-- <td><button class="btn btn-md btn-success"> Visit </button></td></tr> -->
    <td><a href="Votingpage.php?Election_id=<?=$row['id']  ?>" class="btn btn-sm btn-success">Participate</a></td>

<?php
}
}else
{
    ?>
   <td> <?php echo "No any Active Elections Available";?> </td>;
<?php
}

?>




    <!-- <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr> -->
  </tbody>
</table>


<!-- This is a Homepage showing Mutiple Elections in a Table!!!!!!!. -->



<?php
require_once("include/footer.php");
?>