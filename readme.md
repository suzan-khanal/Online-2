This is a readme section of our project.
144. while($row = mysqli_fetch_assoc($FetchData))
                                {
                                    $election_id = $row['id'];
                                    ?><tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['Election_Topic']; ?></td>
                                        <td><?php echo $row['No_of_Candidates']; ?></td>
                                        <td><?php echo $row['Starting_Date']; ?></td>
                                        <td><?php echo $row['Ending_Date']; ?></td>
                                        <td><?php echo $row['Status']; ?></td>
                                        <td>
                                           <a href="update.php?updateid=<?= $row['id'] ?>" class="btn btn-sm btn-warning"> Edit </a>
                                            <button class="btn btn-sm btn-danger" onclick="DeleteData(<?php echo 
                                            $election_id;?>)"> Delete </button>

                                        </td>
                                        </tr>  }
