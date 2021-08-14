<?php

$conn = new mysqli("localhost", "root", "", "image searcher");

if ($conn->connect_error) {die("fout: ".$conn->connect_error);}