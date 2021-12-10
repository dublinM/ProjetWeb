<section class="card mt-3 mb-3">
	<div class="card-body">
		<h1 class="card-title">Posts</h1>

		<?php User::panel(); ?>

		<?php if ( ! empty( $posts ) ) : ?>
		<table class="table table-striped mb-0">
			<thead>
				<tr>
					<th>Couverture</th>
					<th><a href=<?php echo GENERAL_CONFIG['url']."/posts/?sort=title"; ?> >Titre</a></th>
					<th><a href=<?php echo GENERAL_CONFIG['url']."/posts/?sort=time"; ?> >Date</a></th>
					<th><a href=<?php echo GENERAL_CONFIG['url']."/posts/?sort=content"; ?>>Contenu</a></th>
					<th><a href=<?php echo GENERAL_CONFIG['url']."/posts/?sort=author"; ?>>Auteur</a></th>
					<?php if ( User::login() ) : ?>
					<th>Actions</th>
					<?php endif; ?>
				</tr>
			</thead>

			<tbody>
				<?php foreach ( $posts as $post ) : ?>
				<tr>
					<td>
						<?php if ( $post['post_cover'] ) : ?>
						<a href=<?php echo GENERAL_CONFIG['url']."/posts/post/". $post['post_id']; ?>>
							<img src=<?php echo GENERAL_CONFIG['url']."/". $post['post_cover']; ?> alt="<?= $post['post_title']; ?>" class="img-fluid rounded" style="height: 32px">
						</a>
						<?php endif; ?>
					</td>

					<td><a href=<?php echo GENERAL_CONFIG['url']."/posts/post/". $post['post_id']; ?>><?= mb_strimwidth( $post['post_title'], 0, 16, '...' ); ?></a></td>

					<td>
						<time datetime="<?= Time::get( $post['post_created'], $post['post_updated'], 'c' ); ?>">
							<?= Time::get( $post['post_created'], $post['post_updated'], 'Y-m-d H:i' ); ?>
						</time>
					</td>

					<td><?= mb_strimwidth( strip_tags( $post['post_content'] ), 0, 32, '...' ); ?></td>

					<td>
						<a href=<?php echo GENERAL_CONFIG['url']."/users/user/".$post['user_id']; ?> data-toggle="tooltip" data-placement="left" title="<?= $post['user_name']; ?>">
							<?= User::gravatar( $post['user_email'], 32, 'monsterid', 'g', true, array( 'alt' => $post['user_name'], 'class' => 'img-fluid rounded' ) ); ?>
						</a>
					</td>

					<?php if ( User::login() ) : ?>
					<td>
						<?php if ( User::author( $post['post_author'] ) || User::role( array( 'admin', 'editor' ) ) ) : ?>
						<a href=<?= GENERAL_CONFIG['url']."/posts/edit/".$post['post_id']; ?> class="btn btn-success btn-sm">Editer</a>
							<?php if ( User::author( $post['post_author'] ) || User::role( array( 'admin' ) ) ) : ?>
							<a href=<?= GENERAL_CONFIG['url']."/posts/delete/".$post['post_id']; ?> class="btn btn-danger btn-sm" onclick="return confirm( 'Etes vous sûr de vouloir supprimer le post <?= $post['post_title']; ?>?' );">Supprimer</a>
							<?php endif; ?>
						<?php endif; ?>
					</td>
					<?php endif; ?>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php Site::pagination( $pagination ); ?>

		<?php else : ?>
		<div class="alert alert-warning mb-0">Vide.</div>
		<?php endif; ?>
	</div>
</section>
