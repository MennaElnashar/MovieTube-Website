<?php

session_start();
$connection = new mysqli("localhost", "root","","movies");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  //something was posted
  $firstname = $_POST["txt1"];
  $lastname = $_POST["txt2"];
  $email = $_POST["email"];
  $password = $_POST["pswd"];

  if (!empty($email) && !empty($password)) {
    $query = "select email,password from person where email = '$email' && password='$password'";
    $result = mysqli_query($connection, $query);

    if ($result) {

      if ($result && mysqli_num_rows($result) > 0) {
        echo ("<script>
             alert('This user already exists, please login');
             window.location.href='index.php';
             </script>"); 
        die;
      } 
      else {
        $stmt = $connection->prepare("insert into person(first_name,last_name,email,password) values(?,?,?,?)");
        $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);
        $stmt->execute();
        echo ("<script>
             alert('Registration was successful');
             window.location.href='Home.php';
             </script>"); 
        die;
      }
    }
    die;
  }
}
?>