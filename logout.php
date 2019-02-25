<?php
session_start();
session_unset();
session_destroy();

header('refresh:2;url=index.html');
echo '<p style="text-align:center;">Redirecting....</p><br><p style="text-align:center;">You are getting logged out.</p>';
?>