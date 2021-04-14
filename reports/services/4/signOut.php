<?php

session_start();

$_SESSION['user_id'] = null;
session_commit();

header("Location: signIn.php");