<?php
    session_start();
    include("php/config.php");

    $remembered_user = isset($_COOKIE['remember_user']) ? $_COOKIE['remember_user'] : '';
    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $remember = isset($_POST['rmbUserData']);
        // $username = $_POST['username'];
        // $password = $_POST['password'];

        //$result = mysqli_query($con,"SELECT * FROM users WHERE username='$username' AND password='$password'") or die("Select Error");
        //the prepared statement
        $stmt = $con->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();
        //$row = mysqli_fetch_assoc($result);

        /*if($result && $row = $result->fetch_assoc())){
            $_SESSION['valid'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            header("Location: ./home.php");
        } else{
            echo "<div class='message'>
                    <p>Username or password incorrect!! D:< </p>
                </div> <br>";
            echo "<div class='btn'>
                    <a href= 'index.php'><button class='btn btn-primary'>Back</button>
                </div>";
        }*/
        
        if($row = $result->fetch_assoc()){
            $hashed_password = $row["password"];
            if(password_verify($password, $hashed_password)){
                $_SESSION['valid'] = $row['email'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['id'] = $row['id'];

                $stmt->close();
                $con->close();
                header("Location: ./home.php");
                exit();
            } else{
                echo "<div class='message'>
                    <p>Username or password incorrect!! D:< </p>
                    </div> <br>";
                echo "<div class='btn'>
                    <a href= 'index.php'><button class='btn btn-primary'>Back</button>
                    </div>";
            }
        }
        
    }else{
?>
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
        flex:1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login_box{
        width: 30vw;
        height: auto;
        border: 2px solid;
        border-radius: 28px;
        background-color: white;
    }

    h2{
        margin-top: 20px;
        font-size: 36px;
        text-align: center;
        animation: colorFul 5s infinite alternate ease-in;
    }

    @keyframes colorFul {
        0%{
            color: black;
        }
        20%{
            color: #F67280;
        }
        40%{
            color: #A1C349;
        }
        60%{
            color: #FFB347;
        }
        80%{
            color: #8E44AD;
        }
        100%{
            color: #16A085;
        }
    }

    .login_box .userbox{
        position: relative;
        width: 90%;
        height: 50px;
        margin: 30px 20px;
    }

    .userbox input{
        width: 100%;
        height: 100%;
        border: 2px solid;
        border-radius: 40px;
        font-size: 16px;
        padding: 20px 45px 20px 20px;
    }

    .userbox input::placeholder{
        color: black;
    }

    .userbox i{
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 25px;
    }

    .login_box .rmb-frgt{
        display: flex;
        justify-content: space-between;
        font-size: 14.5px;
        margin: -25px 25px 25px;
    }

    .login_box{
        box-shadow: 3px 3px 3px black;
    }

    .rmb-frgt label input{
        margin-right: 3px;
    }

    .rmb-frgt label input:hover{
        cursor: pointer;
        border: 3px solid blue;
        transition: 0.5s;
        transform: scale(1.1);
    }

    .rmb-frgt a{
        text-decoration: none;
        color: black;
        font-weight: bold;
    }

    .rmb-frgt a:hover{
        color: blue;
        transition: 0.5s ease;
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

    .registerLink{
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    .registerLink a{
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
        /* display: flex;
        justify-content: right; */
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

    @media screen and (max-width:992px) {
        .login_box{
            width: 60vw;
        }
    }

    @media screen and (max-width:768px) {
        .login_box{
            width: 80vw;
        }

        h2{
            margin-top: 10px;
        }
    }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="login_box">
            <h2>Login</h2>
            <form action="home.php" method="POST">
                <div class="userbox">
                    <input type="text" placeholder="username" onfocus="this.placeholder=''" onblur="this.placeholder='Username'" name="username" id="username" value="<?php echo htmlspecialchars($remembered_user); ?>" required>
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="userbox">
                    <input type="password" placeholder="password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'" name="password" id="password" required>
                    <i class="bi bi-lock-fill"></i>
                </div>
                <div class="rmb-frgt">
                    <label><input type="checkbox" id="remember" name="rmbUserData" <?php if ($remembered_user) echo 'checked'; ?>>Remember me</label>
                    <a href="https://youtu.be/xvFZjo5PgG0?si=l0oGkNAwGYB5PULl" target="_blank" >Forgot Password?</a>
                </div>
                <div class="bttn">
                    <button type="submit" class="btn btn-primary" name="submit">Login</button>
                </div>
                <div class="registerLink">
                    <p>Don't have an account? <a href="signup.php"><b>Register</b></a></p>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
    <footer>
        <p> &#169; The Happy Project Managers Team. All right reserved.</p>
    </footer>
</body>
</html>