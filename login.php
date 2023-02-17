<?php
require 'header.php';
?>
<body>
<h1 style="color:white">Se connecter</h1>
	<div class="container">
		<form action='login_post.php' method='post'>
			<div class='form-group'>
				<label for="identifiant">Votre e-mail</label>
				<input type='text' name='email'id='email' class='form-control' placeholder="Veuillez mettre votre e-mail" required/>
			</div>
			<div class='form-group'>
				<label for="mot de passe">Votre mot de passe</label>
				<input type='password' name='mdp'id='mdp' class='form-control' placeholder="Veuillez mettre votre mot de passe" required />
			</div>
      <a style ='color: white' href="inscription.php">Si vous n'avez pas de compte, inscrivez-vous ici !</a>
      <br><br>
			<div class='form-group'>
        <button type="submit" class="btn btn-primary">Connexion</button>
			</div>
			<br>
		</form>
		<p><img style='width: 45%; height: 45%;' src="img/smile.jpg"></p>
	</div>
</body>
</html>
