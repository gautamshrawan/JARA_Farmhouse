<?php 

        $con = mysqli_connect("localhost-8080","root","","impulse101");
      
        if (mysqli_connect_errno()) {
                echo "Failed to connect to MySql " . mysqli_connect_error();
        }
