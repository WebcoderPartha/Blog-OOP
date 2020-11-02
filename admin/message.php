<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>View Message</h2>
            <div class="block">
                 <table width="100%">
                     <?php
                        if (!isset($_GET['view']) || $_GET['view'] == NULL){
                            header('Location: inbox.php');
                        }else{
                            $id = $_GET['view'];
                            $query = "SELECT * FROM contact WHERE id = $id ";
                            $message = $db->select($query);
                            $result = mysqli_fetch_array($message);
                        }

                     ?>
                     <tr>
                         <td width="10%">Name:</td>
                         <td width="30%"><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
                     </tr>
                     <tr>
                         <td width="10%">Email:</td>
                         <td width="30%"><?php echo $result['email']; ?></td>
                     </tr>
                     <tr>
                         <td width="10%">Message:</td>
                         <td width="30%"><?php echo $result['message']; ?></td>
                     </tr>
                 </table>

            </div>
        </div>
    </div>


<?php include "inc/footer.php"; ?>