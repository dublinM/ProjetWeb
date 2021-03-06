<section class="card mt-3 mb-3">
	<div class="card-body">
		<h1 class="card-title">Users</h1>

		<?php User::panel(); ?>

		<?php if ( ! empty( $users ) ) : ?>
		<table class="table table-striped mb-0">
			<thead>
				<tr>
					<th>Profil</th>
					<th><a href=<?php echo GENERAL_CONFIG['url']."/users/?sort=name"; ?>>Nom</a></th>
					<th><a href=<?php echo GENERAL_CONFIG['url']."/users/?sort=email"; ?>>Email</a></th>
					<th><a href=<?php echo GENERAL_CONFIG['url']."/users/?sort=role"; ?>>Rôle</a></th>
					<th><a href=<?php echo GENERAL_CONFIG['url']."/users/?sort=time"; ?> >Inscrit</a></th>
					<?php if ( User::login() ) : ?>
					<th>Actions</th>
					<?php endif; ?>
				</tr>
			</thead>

			<tbody>
				<?php foreach ( $users as $user ) : ?>
				<tr>
					<td>
						<a href=<?php echo GENERAL_CONFIG['url']."/users/user/".$user['user_id']; ?>>
							<?= User::gravatar( $user['user_email'], 32, 'monsterid', 'g', true, array( 'alt' => $user['user_name'], 'class' => 'img-fluid rounded' ) ); ?>
						</a>
					</td>

					<td><a href=<?php echo GENERAL_CONFIG['url']."/users/user/". $user['user_id']; ?>><?= mb_strimwidth( $user['user_name'], 0, 16, '...' ); ?></a></td>

					<td><a href="mailto:<?= $user['user_email']; ?>"><?= mb_strimwidth( $user['user_email'], 0, 32, '...' ); ?></a></td>

					<td><?= $user['user_role']; ?></td>

					<td>
						<time datetime="<?= Time::get( $user['user_created'], $user['user_updated'], 'c' ); ?>">
							<?= Time::get( $user['user_created'], $user['user_updated'], 'Y-m-d H:i' ); ?>
						</time>
					</td>

					<?php if ( User::login() ) : ?>
					<td>
						<?php if ( User::author( $user['user_id'] ) || User::role( array( 'admin' ) ) ) : ?>
						<a href=<?php echo GENERAL_CONFIG['url']."/users/edit/". $user['user_id']; ?> class="btn btn-success btn-sm">Modifier</a>
						<a href=<?php echo GENERAL_CONFIG['url']."/users/delete/". $user['user_id']; ?> class="btn btn-danger btn-sm" onclick="return confirm( 'Are you want to DELETE @<?= $user['user_name']; ?>?' );">Supprimer</a>
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
