<!-- This is a view Result Page!!!!. This will also be our Dynamic page. -->
<?php
require_once("include/header.php");
require_once("include/navigation.php");

?>

<table class="table">
  <thead class="table-primary">
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Election Topic</th>
      <th scope="col">Number Candidates</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

</tbody>


<?php
$FetchingElections = mysqli_query($con, "SELECT * FROM `elections` WHERE Status = 'Expired'")
or die(mysqli_error($con));
$IsAnyResultPublished = mysqli_num_rows($FetchingElections);

if($IsAnyResultPublished > 0)
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
    <td><a href="Viewwinner.php?Election_id=<?=$row['id']  ?>" class="btn btn-sm btn-success">View-Result</a></td>

<?php
}
}else
{
    ?>
   <td> <?php echo "No any Elections Results  Published";?> </td>;
<?php
}

?>




   
  </tbody>


</table>


<?php
require_once("include/footer.php");
?>