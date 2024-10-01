<?php
	#Demarer la session
	session_start();
	try {
		$connexion=new PDO('mysql:dbname=musosa; host=localhost', 'root', '');
		} catch (Exception $e) {
			echo $e->getMessage();
		}

