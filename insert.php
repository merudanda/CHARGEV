<?php 
require "connection.php";
    $name = $_POST['customer_name'];
    $phone = $_POST['phone_number'];
    $vehicle = $_POST['vehicle_number'];
    $amount = $_POST['amount'];

    $sql ="insert into visits (customer_name , phone_number, vehicle_number ,amount) 
     values 
     ('$name' , '$phone' , '$vehicle' , '$amount' )";

     if (mysqli_query($conn, $sql))
        {
           echo "New record created successfully";
        }
        else {
            echo "Error: ". mysqli_error($conn);
        }

        mysqli_close($conn);
        ?>