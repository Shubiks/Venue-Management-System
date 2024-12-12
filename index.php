<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container" id="signup_form" style="display: none;">
        <h1 class="form-title">Sign Up</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <input type="text" name="signup_name" id="signup_name" placeholder="Name">
            </div>
            <div class="input-group">
                <input type="email" name="signup_email" id="signup_email" placeholder="Email">
            </div>
            <div class="input-group">
                <input type="password" name="signup_pass" id="signup_pass" placeholder="Password">
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signup_form">
        </form>
        <p class="or">
        -------------------or-------------------
        </p>
        <div class="links">
            <p>Already Have an Account?</p>
            <button id="login_button">Log In</button>
        </div>
    </div>

    <div class="container" id="login_form">
        <h1 class="form-title">Log In</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <input type="text" name="name" id="login_name" placeholder="Name or Email">
            </div>
            <div class="input-group">
                <input type="password" name="password" id="login_password" placeholder="Password">
            </div>
            <div class="input-group">
                <select name="account_type" id="account_type">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <input type="submit" class="btn" value="Log In" name="login_form">
        </form>
        <p class="or" id = "orfield">
        -------------------or-------------------
        </p>
        <div class="links">
            <p id="signup_prompt">Don't Have an Account?</p>
            <button id="signup_button">Sign Up</button>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
