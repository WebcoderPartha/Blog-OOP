<?php

include "../lib/Session.php";
Session::init();
Session::checkLogin();
include "../config/config.php";
include "../lib/Database.php";
include "../helpers/Format.php";
$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
    <section id="content">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $email = $fm->validation($_POST['email']);
            $email = mysqli_real_escape_string($db->link, $email);

            if (empty($email)){
                echo "<span style='color:red;font-size: 18px'>Email Must not be empty!</span>";
            }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo "<span style='color:red;font-size: 18px'>Invalid email address!</span>";
            }else{

                $email_query = "SELECT * FROM users WHERE email = '$email' limit 1";
                $checkEmail = $db->select($email_query);

                if ($checkEmail != false){

                    $result = $checkEmail->fetch_assoc();
                    $username = $result['username'];
                    $id = $result['id'];
                    $text = substr($email, 0, 3);
                    $random = rand(10000, 99999);
                    $password = "$text$random";
                    $newpassword = md5($password);

                    $query = "UPDATE users SET password = '$newpassword' WHERE id = '$id'";
                    $update = $db->update($query);
                    if ($update){
                        $to     = "$email";
                        $headers = array(
                            'From' => 'parthadev76@gmail.com',
                            'Reply-To' => 'parthadev76@gmail.com',
                            'X-Mailer' => 'PHP/' . phpversion()
                        );
                        $subject = "Password Recovered mail";
                        $message = '
                                    <html>
                                    <head>
                                      <title>Password recovery</title>
                                    </head>
                                    <body>
                                      <p>Here is your new password Info</p>
                                      <table>
                                        <tr><th>Email:</th> <th>'.$email.'</th></tr>
                                        <tr><th>Username:</th> <th>'.$username.'</th></tr>
                                        <tr><th>New Password:</th> <th>'.$password.'</th></tr>
                                      </table>
                                    </body>
                                    </html>
                                    ';
                        $sendMail = mail($to, $subject, $message, $headers);
                        if ($sendMail){
                            echo "<span style='color:green;font-size: 18px'>Password Recover mail sent to successfully!</span>";
                        }else{
                            echo "<span style='color:red;font-size: 18px'>Mail not sent!</span>";
                        }
                    }else{
                        echo "<span style='color:red;font-size: 18px'>Password not updated!</span>";
                    }

                }else{
                    echo "<span style='color:red;font-size: 18px'>Email not found!</span>";
                }

            }

        }
        ?>
        <form action="forget-password.php" method="post">
            <h1>Password Recovery</h1>
            <div>
                <input type="text" placeholder="Enter registered email" required="" name="email"/>
            </div>
            <div>
                <input type="submit" name="login" value="Send Mail" />
            </div>
        </form><!-- form -->
        <div class="button">
            <a href="login.php">Login</a>
        </div><!-- button -->
        <div class="button">
            <a href="#">Training with live project</a>
        </div><!-- button -->
    </section><!-- content -->
</div><!-- container -->
</body>
</html>