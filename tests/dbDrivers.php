<?php

// Check mysqli driver //
echo "mysqli driver:\t\t";
echo class_exists('mysqli') ? "OK\n" : "No driver\n";

// Check PDO driver //
echo "PDO driver:\t\t";
echo class_exists('PDO') ? "OK\n" : "No driver\n";

// Check Memcached driver //
echo "Memcached driver:\t";
echo class_exists('Memcached') ? "OK\n" : "No driver\n";
