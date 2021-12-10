<section class="card mt-3 mb-3">
	<?php if ( $user['user_cover'] ) : ?>
	<img src="/<?= $user['user_cover'] ?>" alt="<?= $user['user_name']; ?>" class="card-img-top">
	<?php endif; ?>

	<div class="card-body">
		<?php if ( ! empty( $user ) ) : ?>
		<div class="row">
			<div class="col-lg-3 col-sm-12">
				<?= User::gravatar( $user['user_email'], 256, 'monsterid', 'g', true, array( 'alt' => $user['user_name'], 'class' => 'img-fluid rounded mb-3 w-100' ) ); ?>

				<?php if ( User::author( $user['user_id'] ) || User::role( array( 'admin' ) ) ) : ?>
				<a href=<?php echo GENERAL_CONFIG['url']."/users/edit/".$user['user_id']; ?> class="btn btn-success btn-block">Modifier</a>
					<?php if ( User::author( $user['user_id'] ) ) : ?>
					<a href=<?php echo GENERAL_CONFIG['url']."/users/sign_out"; ?> class="btn btn-outline-danger btn-block">Déconnexion</a>
					<?php endif; ?>
				<?php endif; ?>
				<a href=<?php echo GENERAL_CONFIG['url']; ?> class="btn btn-light btn-block">Retour</a>
			</div>

			<div class="col-lg-9 col-sm-12">
				<h1 class="card-title"><?= $user['user_name']; ?></h1>

				<p class="card-text"><a href="mailto:<?= $user['user_email']; ?>"><?= $user['user_email']; ?></a></p>
				<p class="card-text">Rôle <?= $user['user_role']; ?>.</p>
				<p class="card-text">Inscrit	<?= Time::get( $user['user_created'], $user['user_updated'], 'Y-m-d H:i' ) ?></p>
			</div>
		</div>
		<?php else : ?>
		<div class="alert alert-warning mb-0">L'utilisateur n'existe pas</div>
		<?php endif; ?>
	</div>
</section>
