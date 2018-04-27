#!/usr/bin/env php
<?php
exec_command('IN_TESTING=true vendor/bin/phpmig migrate');
function exec_command($command)
{
    echo "[exec] {$command}\n";
    passthru($command);
}