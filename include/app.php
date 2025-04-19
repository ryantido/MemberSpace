<?php

    $bd = new PDO("mysql:host=localhost;dbname=PHP-INIT", 'ryan', 'Leslyspurple3.0');
    $bd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
