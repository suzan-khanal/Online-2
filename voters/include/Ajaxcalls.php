<?php
require_once("../../admin/include/connect.php");


if(isset($_POST['e_id']) AND ($_POST['c_id'])  AND ($_POST['v_id']))
{
    $VOTE_DATE = date("Y-m-d");
    $VOTE_TIME = date("h:i:s a");

    mysqli_query($con, "INSERT INTO votings (election_id, voters_id, candidate_id, vote_date, vote_time) VALUES ('". $_POST['e_id']."', '". $_POST['v_id']."', '". $_POST['c_id']."', '".  $VOTE_DATE."', '".  $VOTE_TIME."')") or die(mysqli_error($con));
    echo "Success";
}

// This Is New Comments.

?>