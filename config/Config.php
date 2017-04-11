<?php
//    define('WITRYNA', 'http://localhost/NAZWANASZA/');
    define('E_MAIL_ADMIN', 'WarsawContest@wc.com');
    define('SERVER', 'localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DB','warsawcontest');
    function __autoload($className)
    {
        require 'class/'.$className.'.php';
    }