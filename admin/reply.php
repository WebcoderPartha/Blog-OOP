<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php";  ?>

<?php
    if (!isset($_GET['id']) || $_GET['id'] == NULL){
        header('Location: inbox.php');
    }else{
        $id = $_GET['id'];
    }
?>
<?php
$query = "SELECT * FROM contact WHERE id = '$id'";
$contact = $db->select($query);
$result = mysqli_fetch_array($contact);
?>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Reply Message</h2>
            <div class="block">
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply'])){
                        $to = $fm->validation($_POST['to']);
                        $from = $fm->validation($_POST['from']);
                        $subject = $fm->validation($_POST['subject']);
                        $message = $fm->validation($_POST['message']);

                        $send = mail($to, $subject, $message, $from);
                        if ($send){
                            echo "Mail sent successfully";
                        }else{
                            echo "Something went wrong!";
                        }
                    }
                ?>
                <form method="POST" action="reply.php?id=<?php echo $result['id']; ?>">
                    <table class="form">
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="from" placeholder="Enter your email address" class="medium" />
                                <?php
                                    if (isset($from)){
                                        echo $from;
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>

                                <input type="text" name="to" readonly value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" placeholder="Enter subject" class="medium" />
                                <?php
                                if (isset($subject)){
                                    echo $subject;
                                }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea name="message" style="width: 50%" rows="10"></textarea>
                                <?php
                                if (isset($message)){
                                    echo $message;
                                }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="reply" Value="Reply" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php include "inc/footer.php"; ?><?php
