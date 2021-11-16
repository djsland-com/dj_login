# dj_login
PHP Login and Registration Script

To function this script requires you put your MySQL info into both login.php and register.php, and have the table included installed in your selected database

On login session variables are set, they're used as follows

dj_logged_in is to check whether or not the user is logged in, use it with isset() for the best use.

dj_userid is pretty self explanatory, it is the user id generated on registration.

dj_username is also easy to understand, as it is just the up to 32 char username set on registration. ALWAYS wrap this variable with htmlspecialchars() to prevent use of malicious html tags or php in the name such as <script>.
