<?php include 'inc/header.php' ?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fname = $fm->validation($_POST['firstname']);
        $lname = $fm->validation($_POST['lastname']);
        $email = $fm->validation($_POST['email']);
        $message = $fm->validation($_POST['message']);

        $fname = mysqli_real_escape_string($db->link, $fname);
        $lname = mysqli_real_escape_string($db->link, $lname);
        $email = mysqli_real_escape_string($db->link, $email);
        $message = mysqli_real_escape_string($db->link, $message);

        $error = "";
        $error_firstname = "";
        $error_lastname = "";
        $error_email = "";
        $error_message = "";
        if (empty($fname)){
            $error_firstname = "First name must not be empty!";
        }
        if (empty($lname)){
            $error_lastname = "Last name must not be empty!";
        }
        if(empty($email)){
            $error_email = "Email must not be empty!";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error_email = "Invalid Email Address!";
        }
        if (empty($message)){
            $error_message = "Message field must not be empty!";
        }else{
            $query = "INSERT INTO contact(firstname, lastname, email, message) VALUES ('$fname', '$lname', '$email', '$message')";
            $contact = $db->insert($query);
            if ($contact){
                $msg = 'Message sent successfully';
            }
        }

    }
?>


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
                <?php

                    if (isset($msg)){
                        echo "<span style='color:green'>$msg</span>";
                    }
                ?>
                <form action="" method="post">
                    <table>
                    <tr>
                        <td>Your First Name:</td>
                        <td>
                            <input type="text" name="firstname" placeholder="Enter first name" />
                            <?php
                                if (isset($error_firstname)){
                                    echo "<span style='color: red; display: inline-block'>".$error_firstname."</span>";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Your Last Name:</td>
                        <td>
                            <input type="text" name="lastname" placeholder="Enter Last name" />
                            <?php
                            if (isset($error_lastname)){
                                echo "<span style='color: red; display: inline-block'>".$error_lastname."</span>";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Your Email Address:</td>
                        <td>
                            <input type="text" name="email" placeholder="Enter Email Address" />
                            <?php
                            if (isset($error_email)){
                                echo "<span style='color: red; display: inline-block'>".$error_email."</span>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Your Message:</td>
                        <td>
                         <textarea name="message"></textarea>
                            <?php
                            if (isset($error_message)){
                                echo "<span style='color: red; display: inline-block'>".$error_message."</span>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" value="Submit"/>
                        </td>
                    </tr>
                    </table>
                <form>
            </div>
		</div>
        <?php include 'inc/sidebar.php' ?>
	</div>

<?php include 'inc/footer.php' ?>