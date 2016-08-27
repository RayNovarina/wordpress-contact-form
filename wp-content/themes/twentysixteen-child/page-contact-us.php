<?php

  //response generation function
  $response = "";

  //function to generate response
  function my_contact_form_generate_response($type, $message){

    global $response;

    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";

  }
  //response messages
  $not_human       = "Human verification incorrect.";
  $missing_name    = "Please supply a name.";
  $missing_message = "Please supply a message.";
  $missing_human   = "Please answer the human verification question.";
  $missing_content = "Please supply all information including the human verification question.";
  $email_invalid   = "Email Address Invalid.";
  $message_unsent  = "Message was not sent. Try Again.";
  $message_sent    = "Thanks! Your message has been sent.";

  //user posted variables
  $name = isset( $_POST['message_name'] ) ? $_POST['message_name'] : '';
  $email = isset( $_POST['message_email'] ) ? $_POST['message_email'] : '';
  $message = isset( $_POST['message_text'] ) ? $_POST['message_text'] : '';
  $human = isset( $_POST['message_human'] ) ? $_POST['message_human'] : 0;

  //php mailer variables
  $to = get_option('admin_email');
  $subject = "Someone sent a message from ".get_bloginfo('name');
  $headers = 'From: '. $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";

  // Human verification, i.e. verify that human submitted this form.
  if(!$human == 0){
    if($human != 2) my_contact_form_generate_response("error", $not_human); //not human!
    else
    {
      //validate email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        my_contact_form_generate_response("error", $email_invalid);
      }
      else //email is valid
      {
        //validate presence of name
        if(empty($name)){
          my_contact_form_generate_response("error", $missing_name);
        }
        else // name is valid
        {
          // validate presence of message
          if(empty($message)){
            my_contact_form_generate_response("error", $missing_message);
          }
          else // message is valid
               //ready to go!
          {
            //send email
            $sent = wp_mail($to, $subject, strip_tags($message), $headers);
            if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
            else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
          }
        }
      }
    }
  }
  else if (isset( $_POST['submitted']) ? $_POST['submitted'] : false) my_contact_form_generate_response("error", $missing_content);

?>

<?php get_header(); ?>

  <div id="primary" class="site-content">
    <div id="content" role="main">

      <?php while ( have_posts() ) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
              <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
              <?php the_content(); ?>

              <style type="text/css">
                .error{
                  padding: 5px 9px;
                  border: 1px solid red;
                  color: red;
                  border-radius: 3px;
                }

                .success{
                  padding: 5px 9px;
                  border: 1px solid green;
                  color: green;
                  border-radius: 3px;
                }

                form span{
                  color: red;
                }
              </style>

             <div id="respond">
               <?php echo $response; ?>
               <form action="<?php the_permalink(); ?>" method="post">
                 <p><label for="name">Name: <span>*</span> <br><input type="text" name="message_name" value="<?php echo isset( $_POST['message_name'] ) ? esc_attr($_POST['message_name']) : ''; ?>"></label></p>
                 <p><label for="message_email">Email: <span>*</span> <br><input type="text" name="message_email" value="<?php echo isset( $_POST['message_email'] ) ? esc_attr($_POST['message_email']) : ''; ?>"></label></p>
                 <p><label for="message_text">Message: <span>*</span> <br><textarea type="text" name="message_text"><?php echo isset( $_POST['message_text'] ) ? esc_textarea($_POST['message_text']) : ''; ?></textarea></label></p>
                 <p><label for="message_human">Human Verification: <span>*</span> <br><input type="text" style="width: 60px;" name="message_human"> + 3 = 5</label></p>
                 <input type="hidden" name="submitted" value="1">
                 <p><input type="submit"></p>
               </form>
             </div>

            </div><!-- .entry-content -->

          </article><!-- #post -->

      <?php endwhile; // end of the loop. ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
