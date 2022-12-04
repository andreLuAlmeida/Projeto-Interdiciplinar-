<?php
$conn = new PDO("mysql:host=localhost;dbname=social-network", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
