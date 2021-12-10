<section class="card mt-3 mb-3">
	<div class="card-body">
		<?php if ( ! empty( $post ) ) : ?>
		<h1 class="card-title">Modifier le post</h1>

		<?php Errors::get( $errors ); ?>

		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="post-title">Titre <span style="color:#f00">*</span></label>
				<input type="text" name="post-title" id="post-title" class="form-control" max="255" value="<?= $post['post_title']; ?>" required>
			</div>

			<div class="form-group">
				<label for="post-content">Contenu</label>
				<textarea name="post-content" id="post-content" class="form-control"><?= $post['post_content']; ?></textarea>
			</div>

			<img src=<?= GENERAL_CONFIG['url']. $post['post_cover']; ?> alt="Couverture" id="prev" class="img-fluid rounded mb-3 w-100">

			<div class="input-group mb-3">
				<div class="custom-file">
					<input type="file" name="post-cover" id="post-cover" class="custom-file-input" aria-describedby="post-cover" size="5000000" accept=".jpg, .jpeg, .png, .gif">
					<label class="custom-file-label" for="post-cover">Séléctionner une image</label>
				</div>
			</div>

			<button type="submit" name="post-edit" class="btn btn-success">Modifier</button>
			<a href=<?php echo GENERAL_CONFIG['url']; ?> class="btn btn-light">Annuler</a>
		</form>
		<?php else : ?>
		<div class="alert alert-warning mb-0">Vide</div>
		<?php endif; ?>
	</div>
</section>
