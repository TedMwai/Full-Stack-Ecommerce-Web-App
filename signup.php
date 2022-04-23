<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./css/signup.css" />
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="image">
            <img src="./images/login-air.jpg" alt="nike" />
        </div>
        <div class="content">
            <form action="register.php" method="post" class="form" id="form">
                <div class="title">
                    <h1>BECOME A MR. CARTER MEMBER</h1>
                </div>
                <div class="inputfield">
                    <label>First Name</label>
                    <input type="text" class="input" id="firstName" name="firstName" placeholder="First Name" />
                </div>
                <div class="inputfield">
                    <label>Last Name</label>
                    <input type="text" class="input" id="lastName" name="lastName" placeholder="Last Name" />
                </div>
                <div class="inputfield">
                    <label>Email</label>
                    <input type="email" class="input" id="email" name="email" placeholder="Email" />
            </div>
                <div class="inputfield">
                    <label>Password</label>
                    <input type="password" class="input" id="password" name="password" placeholder="Password" />
                </div>
                <div class="inputfield">
                    <label>Mobile</label>
                    <input type="text" class="input" id="mobile" name="mobile" placeholder="Mobile" />
                </div>
                <div class="inputBtn">
                    <button type="submit" class="btn" name="signup">JOIN US</button>
                </div>
                <div class="sign-in">
                    <p>Already a user?</p>
                    <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/form.js"></script>
</body>

</html>