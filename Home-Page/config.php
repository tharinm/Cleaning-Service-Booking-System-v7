<?php
	// Database configuration 	
	$hostname = "localhost"; 
	$username = "root"; 
	$password = ""; 
	$dbname   = "dcsms5";
	 
	// Create database connection 
	$conn = new mysqli($hostname, $username, $password, $dbname); 
	 
	// Check connection 
	if ($conn->connect_error) { 
	    die("Connection failed: " . $conn->connect_error); 
	}
	
    
	
?>