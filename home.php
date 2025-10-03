<?php
    session_start();

    include ("php/config.php");
    if(isset($_SESSION['valid'])){
        header("Location: index.php");
    }
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
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        nav{
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 20px;
            background-color: aqua;
        }

        nav button{
            padding: 10px 20px;
            background-color: aqua;
            border: none;
            font-weight: bold;
            font-size: 20px;
        }

        nav button:hover{
            text-decoration: underline wavy;
        }

        main{
            padding-top: 20vw;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        h1{
            font-size: 100px;
            animation: warningEmphasize 5s infinite alternate;
        }

        p span{
            font-size: 30px;
            opacity: 1;
            color: black;
            display: inline-block;
            animation: warningHighlight 1s infinite alternate;
        }

        span:nth-child(1){
            animation-delay: 0.2s;
        }

        span:nth-child(2){
            animation-delay: 0.4s;
        }

        span:nth-child(3){
            animation-delay: 0.6s;
        }

        span:nth-child(4){
            animation-delay: 0.8s;
        }

        span:nth-child(5){
            animation-delay: 1s;
        }

        span:nth-child(6){
            animation-delay: 1.2s;
        }

        span:nth-child(7){
            animation-delay: 1.4s;
        }

        @keyframes warningEmphasize {
            0%{
                color: black;
                font-size: 100px;
            }
            50%{
                color: red;
                font-size: 150px;
            }
            100%{
                color: black;
                font: 100px;
            }
        }

        @keyframes warningHighlight {
            to{
                color: yellow;
            }
        }

        footer{
            display: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: right;
            background-color: black;
            color: white;
        }

    </style>
</head>
<body>
    <nav>
        <a href="./php/logout.php"><button><i class="bi bi-person-walking"></i> Sign Out</button></a>
    </nav>
    <main>
        <div class="constructiongif">
            <img src="./image/working.gif" width="200px" height="200px" alt="A worker working the webpage">
        </div>
        <h1>SORRY!</h1>
        <p>
            <span>This </span>
            <span>page </span>
            <span>is </span>
            <span>under </span>
            <span>construction </span>
            <span>right </span>
            <span>now.</span>
        </p>
    </main>
    <footer>
        <p> &#169; The Happy Project Managers Team. All right reserved.</p>
    </footer>
</body>
</html>