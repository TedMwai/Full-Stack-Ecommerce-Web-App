<?php include './includes/session.php' ?>
<?php
if (isset($_SESSION['user'])) {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./css/login.css" />
    <title>Sign In</title>
</head>

<body>
    <div class="container">
        <div class="image">
            <img src="./images/login-air.jpg" alt="nike" />
        </div>
        <div class="content">
            <form action="verify.php" method="post" class="form" id="form">
                <div class="title">
                    <h1>MR. CARTER</h1>
                </div>
                <div class="inputfield">
                    <label>Email</label><br>
                    <input type="email" class="input" id="email" name="email" placeholder="Email" />
                </div>
                <div class="inputfield">
                    <label>Password</label>
                    <br>
                    <input type="password" class="input" id="password" name="password" placeholder="Password" />
                </div>
                <div class="policy">
                    <p>By logging in, you agree to JumpMan's Privacy Policy and Terms of Use.</p>
                </div>
                <div class="inputBtn">
                    <button type="submit" class="btn" name="login">SIGN IN</button>
                </div>
                <div class="sign-in">
                    <p>Not a member?</p>
                    <a href="signup.php">Join US</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>