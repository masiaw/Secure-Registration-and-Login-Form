<html>
    <head>
        <title>PHP ReCAPTCHA</title>
    </head>
    <body>
        <form action="registrationImprovedCheck.php" method="post">
            <input type="text" name="vrForename" placeholder="Forename:">
            </br>
            <input type="text" name="vrSurname" placeholder="Surname:">
            </br>
            <input type="text" name="vrUsername" placeholder="Username:">
            </br>
            <input type="text" name="vrEmail" placeholder="Email:">
            </br>
            <input type="date" name="DOB" required pattern = '\d{4} - \d{2} -\d{2}' placeholder="Date of Birth:">
            </br>
            <input type="text" name="vrAddress" placeholder="'Postcode, house no':">
            </br>
            <input type="password" name="Password" placeholder="Password:">
            </br>
            <input type="password" name="conPassword" placeholder="Confirm password:">
            </br>

            <input type="submit" name="submit" value="Register">
            <div class="g-recaptcha" data-sitekey="6LeieQkaAAAAAPjLU0LVnujaD_RjitbNpDq_-BLg"></div>
        </form>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </body>
</html>