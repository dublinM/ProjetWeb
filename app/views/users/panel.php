<div class="mb-3">
	<?php if ( isset( $_SESSION['user'] ) ) : ?>
	<a href="#" id="user-panel" style="display: inline-block" data-toggle="dropdown">
		<?= User::gravatar( $_SESSION['user']['email'], 38, 'monsterid', 'g', true, array( 'alt' => $_SESSION['user']['name'], 'class' => 'img-fluid rounded' ) ); ?>
	</a>

	<div class="dropdown-menu" aria-labelledby="user-panel">
		<a href=<?php echo GENERAL_CONFIG['url']."/users/user/". $_SESSION['user']['id']; ?> class="dropdown-item">@<?= $_SESSION['user']['name']; ?></a>
		<a href=<?php echo GENERAL_CONFIG['url']."/users/edit/". $_SESSION['user']['id']; ?> class="dropdown-item">Editer</a>
		<div class="dropdown-divider"></div>
		<a href=<?php echo GENERAL_CONFIG['url']."/posts"; ?> class="dropdown-item">Posts</a>
		<div class="dropdown-divider"></div>
		<a href=<?php echo GENERAL_CONFIG['url']."/users"; ?> class="dropdown-item">Utilisateurs</a>
		<div class="dropdown-divider"></div>
		<a href=<?php echo GENERAL_CONFIG['url']."/users/sign_out"; ?> class="dropdown-item">Déconnexion</a>
	</div>

	<a href=<?php echo GENERAL_CONFIG['url']."/posts/add"; ?> class="btn btn-primary">Publier un post</a>
	<?php else : ?>
	<a href=<?php echo GENERAL_CONFIG['url']."/users/sign_in"; ?> class="btn btn-primary">Connexion</a>
	<a href=<?php echo GENERAL_CONFIG['url']."/users/sign_up"; ?> class="btn btn-success">Inscription</a>
	<?php endif; ?>
</div>
