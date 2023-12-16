<?php

$first_name = '';
$last_name = '';
$email = '';
$message = '';

$first_name_err = '';
$last_name_err = '';
$email_err = '';
$message_err = '';

$mail_successfully_sent = false;

if($_SERVER['REQUEST_METHOD'] == 'POST') { // if inputs are empty, we will declare a statement, else we will assign the $_POST to a var

    if(empty($_POST['first_name'])) {
        $first_name_err = 'Please fill out your first name';
    } else {
        $first_name = $_POST['first_name'];
    }

    if(empty($_POST['last_name'])) {
        $last_name_err = 'Please fill out your last name';
    } else {
        $last_name = $_POST['last_name'];
    }

    if(empty($_POST['email'])) {
        $email_err = 'Please fill out your email';
    } else {
        $email = $_POST['email'];
    }

    if(empty($_POST['messages'])) {
        $message_err = 'Please leave a message';
    } else {
        $message = $_POST['messages'];
    }

    if(isset($_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['messages'])) {

        $to = 'jrussell6078@gmail.com';
        $subject = 'test email on '.date('m/d/y, h i A');
        $body = '
    First Name: '.$first_name.' '.PHP_EOL.'
    Last Name: '.$last_name.' '.PHP_EOL.'
    Email: '.$email.' '.PHP_EOL.'
    messages: '.$message.' '.PHP_EOL.'
    ';

        $headers = array(
            'From' => 'noreply@cascademusicschool.com',
        );
        // we will be adding an if statement - this email form will work ONLY if all fields are filled out

        if(!empty(
            $first_name && $last_name && $email && $message
        )) {
            mail($to, $subject, $body, $headers);
            $mail_successfully_sent = true;
        }
    } // end isset
} // closing server request method
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Cascade Music School</title>
</head>

<body>
    <header>
        <h1 class="page-header"><a href="index.html">Cascade Music School</a></h1>
        <nav class="topnav">
            <a href="about.html">About</a>
            <a href="gallery.html">Gallery</a>
            <a href="events.html">Performances</a>
            <a href="classes.html">Classes</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>
    <div class="wrapper">
        <?php if ($mail_successfully_sent) { 
            echo '<p id="thanks">Thank you for your message. You will hear from us soon!</p>';
          } else {  ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <fieldset>
                <legend>
                    Contact Cascade Music School
                </legend>
                <label>First Name</label>
                <input type="text" name="first_name" value="<?php if(isset($_POST['first_name']))
                    echo htmlspecialchars($_POST['first_name']); ?>">
                <span>
                    <?php echo $first_name_err; ?>
                </span>

                <label>Last Name</label>
                <input type="text" name="last_name" value="<?php if(isset($_POST['last_name']))
                    echo htmlspecialchars($_POST['last_name']); ?>">
                <span>
                    <?php echo $last_name_err; ?>
                </span>

                <label>Email</label>
                <input type="email" name="email" value="<?php if(isset($_POST['email']))
                    echo htmlspecialchars($_POST['email']); ?>">
                <span>
                    <?php echo $email_err; ?>
                </span>

                <label>Message</label>
                <textarea name="messages"><?php if(isset($_POST['messages']))
                    echo htmlspecialchars($_POST['messages']); ?></textarea>
                <span>
                    <?php echo $message_err; ?>
                </span>

                <input type="submit" value="Send">

                <p><a href="">Reset</a></p>

            </fieldset>

        </form>
        <?php } ?>
        <footer>
            <small>&copy; 2023 by
                Jennifer Russell, All Rights Reserved ~
                <a id="html-checker" href="#" target="_blank">Check HTML</a> ~
                <a id="css-checker" href="#" target="_blank">Check CSS</a></small>

            <script>
                document.getElementById("html-checker").setAttribute("href", "https://validator.w3.org/nu/?doc=" + location.href);
                document.getElementById("css-checker").setAttribute("href", "https://jigsaw.w3.org/css-validator/validator?uri=" + location.href);
            </script>
        </footer>
    </div>
</body>

</html>