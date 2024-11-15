<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="Eventz LOGO AI-04.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventzPlan | Be One of Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            background-color: rgba(0, 0, 0, 0.500);
            backdrop-filter: blur(2px);
            color: aqua;
            width: 450px;
            padding: 1.5rem;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0 20px 35px rgba(0,0,1,0.9);
        }

        .container img {
            width: 150px; 
            height: 150px; 
            margin-top: .1rem;
            margin-bottom: .1rem;
            filter: invert(100%);
        }
    </style>
</head>

<body>

    <div id="preloader"></div>
    
    <header class="header">
        <nav class="navbar">
            <h1 class="logo">
                <a href="#"><img src="Eventz LOGO AI-01.png" alt="logo" class="glowing-image"></a>
            </h1>
        </nav>
    </header>

    <div class="video-container">
        <video autoplay loop muted playsinline id="background-video">
            <source src="Background_Vid.mp4" type="video/mp4">
        </video>
        <div class="overlay"></div>
    </div>

    <div class="container" id="signUp" style="display: none;">
        <a><img src="Eventz LOGO AI-04.png" alt="logo"></a>
        <h1 class="form-title">Ultimate Event Planner<br>Sign up </h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fname" id="fname" placeholder="First Name" required>
                <label for="fname">First name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lname" id="lname" placeholder="Last Name" required>
                <label for="lname">Last name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="signUpPassword" placeholder="Password" required>
                <label for="signUpPassword">Password</label>
                <div class="eye" id="signUpEye">
                    <b class="fas fa-eye-slash fa-xs" onclick="togglePassword('signUpPassword', this)"></b>
                </div>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
                <label for="confirmPassword">Confirm Password</label>
                <div class="eye" id="confirmEye">
                    <b class="fas fa-eye-slash fa-xs" onclick="togglePassword('confirmPassword', this)"></b>
                </div>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <p class="or">or Log In with</p>
        <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>
        <div class="term">
            <a>By continuing, you agree to EventzPlan's 
                <br> Terms of Service and Privacy Policy </a>
        </div>
        <div class="links">
            <p>Already a member?</p>
            <button id="signInButton">Sign In</button>
        </div>
    </div>

    <div class="container" id="signIn">
        <a><img src="Eventz LOGO AI-04.png" alt="logo"></a>
        <h1 class="form-title">Welcome to EventzPlan</h1>
        <h2 class="tile" id="tile-text">Let's Plan an Eventzing!!!<br></h2>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="signInEmail" placeholder="Email" required>
                <label for="signInEmail">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="signInPassword" placeholder="Password" required>
                <label for="signInPassword">Password</label>
                <div class="eye" id="signInEye">
                    <b class="fas fa-eye-slash fa-xs" onclick="togglePassword('signInPassword', this)"></b>
                </div>
            </div>
            <p class="recover">
                <a href="home.php">Recover Password</a>
            </p>
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <p class="or">or Log In with</p>
        <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>
        <div class="term">
            <a>By continuing, you agree to EventzPlan's
                <br> Terms of Service and Privacy Policy </a>
        </div>
        <div class="links">
            <p>Not on EventzPlan yet?</p>
            <button id="signUpButton">Sign Up</button>
        </div>
    </div>

    <script src="script.js"></script>

    <footer style="background-color: rgba(0, 255, 247, 0.60)">
        <div class="footer">
            Author: John Sherloun Espero <br>
            &copy; COPYRIGHT REVERSED (2024) <br>
        </div>
    </footer>

    <script>
        var loader = document.getElementById('preloader');
        
        window.addEventListener('load', function(){
            loader.style.display = 'none';
        });

        document.getElementById('signUpButton').addEventListener('click', function() {
            showAlert();
        });

        function showAlert() {
         alert("                                          PLEASE BE NOTED:\n\n" +
          "By proceeding further on the sign-up page, you acknowledge and accept the terms and conditions. " +
          "This means that you agree to comply with the rules, guidelines, and policies outlined. " +
          "You understand your rights and responsibilities as a user. " +
          "Please review the terms and conditions thoroughly to ensure you understand and consent to them before continuing.");
        }
    </script>
  
</body>
</html>