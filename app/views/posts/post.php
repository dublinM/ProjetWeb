<section class="card mt-3 mb-3">
	<?php if ( ! empty( $post['post_cover'] ) ) : ?>
	<img src=<?= GENERAL_CONFIG['url']. explode('.',$post['post_cover'])[1].'.'.explode('.',$post['post_cover'])[2]; ?> alt="<?= $post['post_title']; ?>" class="card-img-top">
	<?php endif; ?>

	<div class="card-body">
		<?php if ( ! empty( $post ) ) : ?>
		<h1 class="card-title"><?= $post['post_title']; ?></h1>

		<div class="card-text">
			<time datetime="<?= Time::get( $post['post_created'], $post['post_updated'], 'c' ) ?>" class="card-subtitle text-muted">
				le <?= Time::get( $post['post_created'], $post['post_updated'], 'Y-m-d H:i' ) ?>
			</time>
			<span> par <span>
			<a href=<?php echo GENERAL_CONFIG['url']."/users/user/". $post['user_id']; ?>><?= $post['user_name']; ?></a>
		</div>

		<div class="card-text"><?= $post['post_content']; ?></div>

		<div class="mt-3">
			<?php if ( User::author( $post['post_author'] ) || User::role( array( 'admin', 'editor' ) ) ) : ?>
			<a href=<?php echo GENERAL_CONFIG['url']."/posts/edit/". $post['post_id']; ?> class="btn btn-success btn-sm">Editer</a>
				<?php if ( User::author( $post['post_author'] ) || User::role( array( 'admin' ) ) ) : ?>
				<a href=<?php echo GENERAL_CONFIG['url']."/posts/delete/".$post['post_id']; ?> class="btn btn-danger btn-sm" onclick="return confirm( 'Etes vous sûr de vouloir supprimer le poste <?= $post['post_title']; ?> ?' );">Supprimer</a>
				<?php endif; ?>
			<?php endif; ?>
			<a href=<?php echo GENERAL_CONFIG['url']; ?> class="btn btn-light btn-sm">Retour</a>
		</div>
		<?php else : ?>
		<div class="alert alert-warning mb-0">Vide</div>
		<?php endif; ?>
	</div>
</section>
