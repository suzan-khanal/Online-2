<?php
require_once("include/header.php");
require_once("include/navigation.php");

if(isset($_GET['Homepage']))
{
    //echo"Welcome to HomePage!!!";
    require_once("include/Homepage.php");
}else if(isset($_GET['AddElectionPage']))
{
    //echo"Welcome to Election Page!!!";
    require_once("include/Add_Election.php");
}else if(isset($_GET['AddCandidatesPage']))
{
    require_once("include/Add_Candidates.php");
}else if(isset($_GET['viewResults']))
{
    require_once("include/viewResults.php");
}

?>




<?php
require_once("include/footer.php");
?>

