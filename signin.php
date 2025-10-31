<?php
session_start();
include 'db_connect.php'; // Ensure this file connects to your database

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, trim($_POST["username"]));
    $password = $_POST["password"];

    // Check in admins table
    $sql_admin = "SELECT * FROM admins WHERE username='$username'";
    $result_admin = mysqli_query($conn, $sql_admin);

    if ($result_admin && mysqli_num_rows($result_admin) == 1) {
        $adminRow = mysqli_fetch_assoc($result_admin);
        if ($password == $adminRow['password']) {
            $_SESSION['admin'] = $username;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Incorrect password for admin!";
        }
    } else {
        // Check in users table
        $sql_user = "SELECT * FROM users WHERE username='$username'";
        $result_user = mysqli_query($conn, $sql_user);

        if ($result_user && mysqli_num_rows($result_user) == 1) {
            $userRow = mysqli_fetch_assoc($result_user);
            if (password_verify($password, $userRow['password'])) {
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                $error = "Incorrect password for user!";
            }
        } else {
            $error = "Username not found in admins or users!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f5f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signin-container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        .signin-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-group input[type="text"],
        .input-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            background-color: #e9f0ff;
        }

        .password-toggle {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: -8px;
            margin-bottom: 15px;
        }

        .signin-btn {
            width: 100%;
            padding: 10px;
            background-color:rgb(222, 122, 41);
            border: none;
            border-radius: 4px;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .signin-btn:hover {
            background-color: #45a049;
        }

        .signup-link {
            text-align: center;
            margin-top: 15px;
        }

        .signup-link a {
            color: orange;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="signin-container">
        <form class="signin-form" method="POST" action="">
            <h2>Sign In</h2>

            <?php if (!empty($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="password-toggle">
                <input type="checkbox" id="show-password">
                <label for="show-password">Show Password</label>
            </div>

            <button type="submit" class="signin-btn">Sign In</button>

            <p class="signup-link">Don't have an account? <a href="signup.php">Sign Up</a></p>
        </form>
    </div>

    <script>
        const passwordInput = document.getElementById("password");
        const showPasswordCheckbox = document.getElementById("show-password");

        showPasswordCheckbox.addEventListener("change", function () {
            if (this.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    </script>
</body>
</html>
