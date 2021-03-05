<?php
    // message variables
    $msg = '';
    $msgClass = '';

    

    // check for submit
    if(filter_has_var(INPUT_POST, 'submit')) {
            
        // get form data
           $name = htmlspecialchars($_POST['name']); 
           $email = htmlspecialchars($_POST['email']);
           $message = htmlspecialchars($_POST['message']); 

        // check required fields 
        if(!empty($name) && !empty($email) && !empty($message)) {
            // passed

            //check email
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    
                    // passed
                    // recipient email
                    $toMyEmail = 'maxirexy16@yahoo.com';
                    //email subject
                    $subject = 'Contact Request From'. $name;
                    // email body
                    $body = '<h2>Contact Request</h2>
                            <h4>Name</h4><p>'. $name. '</p>
                            <h4>Email</h4><p>'. $email. '</p>
                            <h4>Message</h4><p>'. $message. '</p>';
                    // Html Email Headers
                    $headers ='MIME-Version: 1.0' . '\r\n';
                    $headers .='Content-type:text/html;charset=UTF-8' . '\r\n';
                    // Additional Headers
                    $headers .= 'From:' . $name. '<'. $email. '>'. '\r\n';  
                    // send mail
                    if (mail($toMyEmail,$subject,$body,$headers)) {
                        // email sent
                         $msg = 'email sent';
                         $msgClass = 'alert-success';
                    } else {
                         $msg = 'email was not sent';
                         $msgClass = 'alert-danger';
                    }
                
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
                  <div class='navbar-header'>
                       <a class='navbar-brand' href='index.php'>Contact Form</a>
                  </div>
                 
                  <?php if($msg != ''): ?>
                      <div class='alert <?php echo $msgClass; ?>'>
                           <?php echo $msg; ?>
                      </div>
                  <?php endif; ?>  
              </div>
         </nav>
         <form method='post' action='<?php echo $_SERVER['PHP_SELF'] ?>'>
                <div class='form-group'>
                    <label>Name</label>
                    <input type='text' name='name' class='form-control' value='<?php echo isset($_POST['name']) ? $name : '' ; ?>' >
                </div>
                <div class='form-group'>
                    <label>Email</label>
                    <input type='text' name='email' class='form-control' value='<?php echo isset($_POST['email']) ? $email : '' ; ?>' >
                </div>
                <div class='form-group'>
                    <label>Message</label>
                    <textarea name='message' class='form-control' placeholder='your message here ...' ><?php echo isset($_POST['message']) ? $message : '' ;  ?></textarea>
                </div>
                <br>
                <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
                <button type='reset' name='clear' class='btn btn-primary'>Clear</button>
         </form>
    </body>
</html>