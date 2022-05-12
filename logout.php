<?php
session_start();
session_destroy();
setcookie("id", $id, time()-3600*10*500);

header('location: /project1/');
