<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Project Name]: Student Productivity Browser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="./image/icon.png" type="image/x-icon">
    <style>
    *{
        margin: 0;
        padding: 0;
    }
    
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        min-height: 100vh;
        background-color: #FFEEE4;
    }

    .wrapper{
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .signupForm{
        width: 30vw;
        height: auto;
        border: 2px solid;
        border-radius: 28px;
        box-shadow: 3px 3px 3px black;
        background-color: white;
    }

    h2{
        margin-top: 20px;
        font-size: 36px;
        text-align: center;
        animation: colorful 5s infinite alternate ease;
    }

    @keyframes colorful {
        0%{
            color: black;
        }
        20%{
            color: #39FF14;
        }
        40%{
            color: #FF073A;
        }
        60%{
            color: #0FF0FC;
        }
        80%{
            color: #FF6EC7;
        }
        100%{
            color: #FFFF33;
        }
    }

    .signupForm .newUserbox{
        position: relative;
        width: 90%;
        height: 50px;
        margin: 30px 20px;
    }

    .newUserbox input{
        width: 100%;
        height: 100%;
        border: 2px solid;
        border-radius: 40px;
        font-size: 16px;
        padding: 20px 45px 20px 20px;
    }

    .bttn button{
        width: 90%;
        height: 50px;
        margin: 0 20px;
        border-radius: 40px;
        border-style: solid;
        border-color: black;
        box-shadow: 1px 1px 1px black;
        color: white;
        font-size: 20px;
        font-weight: bold;
    }

    .accExistedLink{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
    }

    .accExistedLink a{
        font-weight: bold;
        text-decoration: none;
    }

    .message{
        text-align: center;
        font-size: 16px;
        padding: 20px;
    }

    .btn{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn button{
        width: auto;
        height: 50px;
        margin: 0 20px;
        border-radius: 40px;
        border-style: solid;
        border-color: black;
        box-shadow: 1px 1px 1px black;
        color: white;
        font-size: 20px;
        font-weight: bold;
    }

    footer{
        display: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        text-align: right;
        width: 100vw;
        min-height: 3vh;
        background-color: black;
        color: white;
    }

    @media screen and (max-width:992px){
        .signupForm{
            width: 60vw;
        }

        h2{
            margin-top: 10px;
        }
    }

    @media screen and (max-width:768px) {
        .signupForm{
            width: 80vw;
        }
    }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="signupForm">
            <?php
                include("./php/config.php");
                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
    
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
                    //verify the email structure
                    //$verify_query = mysqli_query($con,"SELECT email FROM users WHERE email='$email'");
                    $verify_stmt = $con->prepare("SELECT email FROM users WHERE email =?");
                    $verify_stmt->bind_param("s", $email);
                    $verify_stmt->execute();
                    $verify_stmt->store_result();
    
                    if($verify_stmt->num_rows > 0){
                        echo "<div class='message'>
                                    <p>This email is registered in our website, please use another one.</p>
                                </div> <br>";
                        echo "<div class='btn'>
                                <a href= 'javascript:self.history.back()'><button class='btn btn-primary'>Go Back</button>
                                </div>";
                    } else{
                        //mysqli_query($con,"INSERT INTO users(username,email,password) VALUES('$username','$email','$password')") or die ("Error Occured");
                        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $con->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
                        $stmt->bind_param("sss", $username, $email, $hashed_password);
                        $stmt->execute();
    
                        echo "<div class='message'>
                                    <p>Account registered!</p>
                                </div> <br>";
                        echo "<div class='btn'>
                        <a href= 'index.php'><button class='btn btn-primary'>Login now!</button>
                        </div>";
                    }
                    
                    $verify_stmt-> close();
                    $con->close();
                } else{
            ?>
            <h2>Sign up</h2>
            <form action="" method="POST">
                <div class="newUserbox">
                    <input type="text" placeholder="username" onfocus="this.placeholder=''" onblur="this.placeholder='Username'" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="newUserbox">
                    <input type="email" placeholder="email" onfocus="this.placeholder=''" onblur="this.placeholder='Email'" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="newUserbox">
                    <input type="password" placeholder="password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="bttn">
                    <button type="submit" class="btn btn-primary" name="submit" value="Register">Register</button>
                </div>
                <div class="accExistedLink">
                    <p>Already have an account? <a href="index.php">Login</a></p>
            </form>
            </div>
            <?php }; ?>
        </div>
    </div>
    <footer>
        <p> &#169; The Happy Project Managers Team. All right reserved.</p>
    </footer>
</body>
</html>