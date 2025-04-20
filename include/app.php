<?php

    $bd = new PDO("mysql:host=localhost;dbname=PHP-INIT", 'root', '');
    $bd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
