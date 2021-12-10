<section class="card mt-3 mb-3">
	<div class="card-body">
		<h1 class="card-title">Inscription</h1>

		<?php Errors::get( $errors ); ?>

		<form action="" method="POST">
			<div class="form-group">
				<label for="user-name">Nom</label>
				<input type="text" name="user-name" id="user-name" class="form-control" max="255" required>
			</div>

			<div class="form-group">
				<label for="user-email">E-mail</label>
				<input type="email" name="user-email" id="user-email" class="form-control" max="255" required>
			</div>

			<div class="form-group">
				<label for="user-password">Mot de passe</label>
				<input type="password" name="user-password" id="user-password" class="form-control" max="255" required>
			</div>

			<button type="submit" name="sign-up" class="btn btn-success">S'inscrire</button>
			<a href=<?php echo GENERAL_CONFIG['url']; ?> class="btn btn-light">Annuler</a>
		</form>

		<p class="card-text text-center mt-3">Déjà inscrit ? <a href=<?php echo GENERAL_CONFIG['url']."/users/sign_in"; ?>>Se connecter</a>.</p>
	</div>
</section>
