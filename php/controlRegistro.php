<?php
	require_once("./clases/UserClass.php");

	if(filter_has_var(INPUT_POST, "user") && filter_has_var(INPUT_POST, "mail") && filter_has_var(INPUT_POST, "pass") ){

		$newUser = new User();

		$mail = filter_input(INPUT_POST, "mail");
		$username = filter_input(INPUT_POST, "user");
		$password = filter_input(INPUT_POST, "pass");
		//$edad = filter_input(INPUT_POST, "edad");

		$newUser->setUsername($username);
		$newUser->setId($mail);
		$newUser->setPassword($password);
		$newUser->setCodActivacion(base64_encode($mail));
		$newUser->setActivado(0);
		//$newUser->setEdad($edad);
		$returnLogin = $newUser->guardarUser();
		$newUser->enviaEmailConfirm();
		echo json_encode(array( "notice"=>$returnLogin));
		
		
	}
	if(filter_has_var(INPUT_GET, "verificar")){
	      $codActivacion = filter_input(INPUT_GET, "verificar");
	      
	      $email = base64_decode($codActivacion);
	      
	      $user = new User();
	      $user->setId($email);
	      $user->cogeValoresSegunId();
	      
	      $user->activarUser();
	      
	      header("../location:index.html");
	      
	}
	


?>