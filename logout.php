<?php

setcookie("Login", "", time() - 3600, '/');
header("Location: index.html");
exit();

?>