<?php
require_once './bootstrap/bootstrap_doctrine.php';
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);