<?php
    // message variables
    $msg = '';
    $msgClass = '';

    // check for submit
    if(filter_has_var(INPUT_POST, 'submit')) {
            
        // get form data
           $name = $_POST['name']; 
           $email = $_POST['email'];
           $message = $_POST['message']; 

        // check required fields 
        if(!empty($name) && !empty($email) && !empty($message)) {
            // passed

            //check email
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // passed
                
            } else {
                // failed
                $msg = 'Please fill in a valid email address';
                $msgClass = 'alert-danger';
            }
        }else {
            // failed
            $msg = 'Please fill in all fields';
            $msgClass = 'alert-danger';

        }
    }

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Contact Us</title>
        <link rel='stylesheet' href='https://bootswatch.com/4/cosmo/bootstrap.min.css'>
    </head>
    <body>
         <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
             <div class='container'>
                <?php if($msg != ''): ?>
                    <div class='alert <?php echo $msgClass; ?>'>
                        <?php echo $msg; ?>
                    </div>
                <?php endif; ?>
                 <div class='navbar-header'>
                      <a class='navbar-brand' href='index.php'>Contact Form</a>
                 </div>
              </div>
         </nav>
         <form method='post' action='<?php echo $_SERVER['PHP_SELF'] ?>'>
                <div class='form-group'>
                    <label>Name</label>
                    <input type='text' name='name' class='form-control' value='' >
                </div>
                <div class='form-group'>
                    <label>Email</label>
                    <input type='text' name='email' class='form-control' value='' >
                </div>
                <div class='form-group'>
                    <label>Message</label>
                    <textarea name='message' class='form-control'></textarea>
                </div>
                <br>
                <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
         </form>
    </body>
</html>