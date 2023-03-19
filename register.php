<?php

require("db.php");

if(isset($_POST['submit'])){
    $name = $_POST["name"];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $role = $_POST['role'];


    $result = $db->query("SELECT * FROM users WHERE email = '$email' && password = '$pass' ");

    if($result->fetchColumn() > 0){

        $error[] = 'user already exist!';

    }else{

        if($pass != $cpass){
            $error[] = 'password not matched!';
        }else{
            $insert = "INSERT INTO users(name, email, password, role) VALUES('$name','$email','$pass','$role')";
            $db->query($insert);
            header('location:login.php');
        }
    }

};
$roles = $db->query("SELECT * FROM roles")->fetchAll(2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="form-container">

    <form action="" method="post">
        <h3>register now</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
        };
        ?>
        <input type="text" name="name" required placeholder="enter your name">
        <input type="email" name="email" required placeholder="enter your email">
        <input type="password" name="password" required placeholder="enter your password">
        <input type="password" name="cpassword" required placeholder="confirm your password">
        <select name="role" id="">
            <?php foreach($roles as $role): ?>
                <option value="<?php echo $role['id'];?>">
                    <?php echo $role['name'] ?>
                </option>
            <?php endforeach;?>
        </select>
        <input type="submit" name="submit" value="register now" class="form-btn">
        <p>already have an account? <a href="login.php">login now</a></p>
    </form>

</div>

</body>
</html>