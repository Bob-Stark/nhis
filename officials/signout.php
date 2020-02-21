<?php

    session_start();
    unset($_SESSION['official_id']);
    session_destroy();

    header('Location: ..\officials.php');