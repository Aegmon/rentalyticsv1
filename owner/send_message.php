<?php
include('session.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Get data from the POST request
   $tenant_id = $_POST['tenant_id'];
   $message = $_POST['message'];

   // Insert the message into the database
   $insertSql = "INSERT INTO message (tenant_id, owner_id, message, message_from, date) 
                 VALUES ('$tenant_id','$id','$message', 'owner', NOW())";

   if ($conn->query($insertSql) === TRUE) {
      // Return a success message or any response you want
      echo 'Message sent successfully!';
   } else {
      // Return an error message
      echo 'Error sending message: ' . $conn->error;
   }
}
?>
