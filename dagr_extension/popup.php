<?php

  if (isset($_POST['addPage'])){} 

      printf("helllllo");
      // Create SQL connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      } 
  
      directory_upload($conn, $_POST['path']);

      $conn->close();
    }
?>