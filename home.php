<?php
session_start();
include("connect.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="Eventz LOGO AI-04.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventzPlan | Home</title>
    <link rel="stylesheet" href="style_1.css">
    <style>
        html {
            scroll-behavior: smooth; 
        }

        #welcomePopup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black; 
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        color: aqua;
        font-family: Poppins, sans-serif;
        font-size: 10vmin;
        text-align: center;
        transform: translateY(0);  
        opacity: 1; 
        transition: opacity 1s ease;
        display: none; 
    }

    #welcomePopup.fade-out {
        opacity: 0; 
    }

        .popup-content {
            text-align: center;
            font-weight: bold;
        }

        .popup-logo {
            width: 150px;
            margin-bottom: 20px;
        }

        @media (max-width: 1200px) {
           .hideOnMobile {
              display: none;
            }
        }

    </style>
</head>
<body>
    <?php

    if(isset($_SESSION['email'])){
        $email=$_SESSION['email'];
        $query=mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");
        while($row=mysqli_fetch_array($query)){
            echo $row['firstName'].' '.$row['lastName'];
        }
    }
    ?>


    
    <div id="preloader"></div>
    
    <nav class="navbar">
        <div class="logo">
            <a href="#"><img src="Eventz LOGO AI-01.png" alt="logo"></a>
        </div>
        <ul class="pcbar">
            <li class="hideOnMobile"><a href="#">Home</a></li>
            <li class="hideOnMobile"><a href="#evetype">Event type</a></li>
            <li class="hideOnMobile"><a href="#about">About</a></li>
            <li class="hideOnMobile"><a href="#git">Contact</a></li>
            <li class="hideOnMobile"><a href="planner.php">Planner</a></li>
            <li onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="26px" fill="#e8eaed"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul> 

        <ul class="sidebar">
            <li onclick="hideSidebar()">
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a>
            </li>
            <li><a href="#">Home</a></li>
            <li><a href="#evetype">Event type</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#git">Contact</a></li>
            <li><a href="#" onclick="showPlannerNotification()">Planner</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
    </nav>

    <div id="welcomePopup">
    <div class="popup-content">
        <img src="Loader.gif" alt="Logo" class="popup-logo">
        <p>Welcome to EventzPlan!</p>
    </div>
</div>

<script>
    function showWelcomePopup() {
        const welcomePopup = document.getElementById('welcomePopup');
        welcomePopup.style.display = 'flex'; 
        setTimeout(function() {
            welcomePopup.classList.add('fade-out'); 
        }, 2500); 

        setTimeout(function() {
            welcomePopup.style.display = 'none'; 
            welcomePopup.classList.remove('fade-out'); 
        }, 5000); 
    }

    <?php 
    if (isset($_SESSION['email'])) {
        echo "showWelcomePopup();"; 
    }
    ?>
</script>

        <?php 
        if (isset($_SESSION['email'])) {
            echo "showWelcomePopup();"; 
        }
        ?>
    </script>
    
    <div class="modal-overlay" id="planner-modal">
        <div class="modal">
            <h2>Sorry for the inconvenience</h2>
            <p style="color: red; ">If you are on desktop, access this by clicking on navigation bar.<br>
            <p>By clicking below<br>
                <a style="color: rgb(0, 98, 65); ">We would be delighted to handle your event. Please fill out the form to get started.</a><br><a href="https://forms.gle/aAfQCtCS54ubFMZT8" target="_blank" style="color: black;">CLICK HERE!</a><br><a style="color: rgb(0, 98, 65); "> or </a>
            </p>
            <button onclick="closePlannerNotification()">Close</button>
        </div>
    </div>
    
    <script>
        function showSidebar() {
            document.querySelector('.sidebar').style.display = 'flex';
        }

        function hideSidebar() {
            document.querySelector('.sidebar').style.display = 'none';
        }

        function showPlannerNotification() {
            document.getElementById('planner-modal').style.display = 'flex';
        }

        function closePlannerNotification() {
            document.getElementById('planner-modal').style.display = 'none';
        }
    </script>  

    <script>
            function showSidebar() {
                const sidebar = document.querySelector('.sidebar');
                sidebar.style.display = 'flex';
            }
    
            function hideSidebar() {
                const sidebar = document.querySelector('.sidebar');
                sidebar.style.display = 'none';
            }
    
            function showPlannerNotification() {
                const modal = document.getElementById('planner-modal');
                modal.style.display = 'flex';
            }
    
            function closePlannerNotification() {
                const modal = document.getElementById('planner-modal');
                modal.style.display = 'none';
            }
        </script>

    <header>
        <div id="home" class="header-content">
            <h>Explore the Ultimate<br></h>
            <div class="line"></div>
            <h1>EventzPlan</h1>
            <a href="#git" class="ctn">Get Started</a>
        </div>
    </header>   

    <section id="evetype">
        <div class="title">
            <h2>I</h2>
            <h1>WHAT'S YOUR EVENT?</h1>
            <a>Know what suits your event plans the best</a>
        </div>
        <div class="section-container" id="services">
            <div class="service">
                <img src="Birtday.jpg" alt="Party">
                <h1>PARTY</h1>
                <p>All the parties you can think of: Birthdays, Surprises, Holidays, etc.</p>
            </div>
            <div class="service">
                <img src="Wedding.jpeg" alt="Special Occasions">
                <h1>SPECIAL OCCASION</h1>
                <p>All the once-in-a-lifetime events: Weddings, Jubilees, Graduations, etc.</p>
            </div>
            <div class="service">
                <img src="Corporate.jpg" alt="Corporate Events">
                <h1>EVENT</h1>
                <p>All work-related events: Corporate, Product Launches, Seminars, etc.</p>
            </div>
        </div>
    </section>

    <section id="about" class="container">
        <div class="about-content">
            <h1>ABOUT EVENTZPLAN</h1>
            <p>Where your vision meets our expertise to create unforgettable experiences.
            We are a dedicated team of event planners, designers, and coordinators with a passion for turning ideas into reality. 
            Whether it's a wedding, corporate event, birthday party, or any special occasion, we are here to make it extraordinary.</p>
            <h1>WHY CHOOSE US?</h1>
            <p>
                Experience: With years of experience in the industry, we know what it takes to execute flawless events.<br><br>
                Attention to Detail: We pride ourselves on our meticulous attention to detail, ensuring nothing is overlooked.<br><br>
                Client-Centered Approach: Your satisfaction is our top priority. We listen to your needs and work closely with you to exceed your expectations.<br><br>
                Reliable and Professional: Our team is dedicated, reliable, and professional, ensuring your event runs smoothly from start to finish.
            </p>
        </div>
        <div class="about-img">
            <img src="Marketing.jpg" alt="About Image">
        </div>
    </section>

    <div id="git" class="button">
        <h2>Contact Us</h2>
        <a href="https://forms.gle/aAfQCtCS54ubFMZT8" target="_blank" style="color: black;">By click here to start fill up form</a>
    </div>

    <footer style="background-color: rgba(0, 255, 247, 0.60)">
        <div class="footer">
            Author: John Sherloun Espero <br>
            &copy; COPYRIGHT REVERSED (2024) <br>
        </div>
    </footer>

    <script>
        window.addEventListener('load', function(){
            document.getElementById('preloader').style.display = 'none';
        });
    </script>

    <?php 
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $query = mysqli_query($conn, "SELECT firstName, lastName FROM users WHERE email='$email'");
        if ($query && mysqli_num_rows($query) > 0) {
            $user = mysqli_fetch_assoc($query);
        }
    }
    ?>
</body>
</html>