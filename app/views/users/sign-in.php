<section class="card mt-3 mb-3">
	<div class="card-body">
		<h1 class="card-title">Connexion</h1>

		<?php Errors::get( $errors ); ?>

		<form action="" method="POST">
			<div class="form-group">
				<label for="user-name">Nom</label>
				<input type="text" name="user-name" id="user-name" class="form-control" max="255" required>
			</div>

			<div class="form-group">
				<label for="user-password">Mot de passe</label>
				<input type="password" name="user-password" id="user-password" class="form-control" max="255" required>
			</div>

			<button type="submit" name="sign-in" class="btn btn-primary">Se connecter</button>
			<a href=<?php echo GENERAL_CONFIG['url']; ?> class="btn btn-light">Annuler</a>
		</form>

		<p class="card-text text-center mt-3">Vous n'avez pas de compte ? <a href=<?php echo GENERAL_CONFIG['url']."/users/sign_up"; ?>>S'inscrire</a>.</p>
	</div>
</section>
