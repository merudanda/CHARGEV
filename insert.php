<?php 
$servername= "localhost";
$username= "root";
$password="";
$database="chargev";

$conn = mysqli_connect($servername , $username , $password , $database);

if(!$conn)
    {
        die ("connection failed". mysqli_connect_error() );

    }

    $name = $_POST['customer_name'];
    $phone = $_POST['phone_number'];
    $vehicle = $_POST['vehicle_number'];
    $amount = $_POST['amount'];

    $sql ="insert into visits (customer_name , phone_number, vehicle_number ,amount) 
     values 
     ('$name' , '$phone' , '$vehicle' , '$amount' )";

     if (mysqli_query($conn, $sql))
        {
            header ("location: fpmain.html");
            exit();
        }
        else {
            echo "Error". mysqli_error();
        }

        mysqli_close($conn);
        ?>