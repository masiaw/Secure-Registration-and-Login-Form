<html>
    <head>
        <title>PHP ReCAPTCHA</title>
    </head>
    <body>
        <form action="loginImprovedCheck.php" method="post">
            <input type="text" name="vrUsername" placeholder="Username:">
            </br>
            <input type="password" name="vrPassword" placeholder="Password:">
            <input type="submit" name="submit" value="Login">
            <div class="g-recaptcha" data-sitekey="6LeieQkaAAAAAPjLU0LVnujaD_RjitbNpDq_-BLg"></div>
        </form>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </body>
</html>