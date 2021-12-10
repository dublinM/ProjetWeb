<nav aria-label="Pagination">
	<ul class="pagination mt-3 mb-0">
	<?php $sort = isset( $_GET['sort'] ) ? '&sort=' . $_GET['sort'] : NULL;
		if ( $pagination['page'] <= 1 ) : ?>
		<li class="page-item disabled"><a class="page-link" href="#">Précédent</a></li>
	<?php else :
		$j = $pagination['page'] - 1; ?>
		<li class="page-item"><a class="page-link" href="<?= GENERAL_CONFIG['url'].'/'.$pagination['for']; ?>/?page=<?= $j . $sort; ?>">Précédent</a></li>
	<?php endif;

	for ( $i = 1; $i <= $pagination['total_pages']; $i++ ) :
		if ( $i <> $pagination['page'] ) : ?>
		<li class="page-item"><a class="page-link" href="<?= GENERAL_CONFIG['url'].'/'.$pagination['for']; ?>/?page=<?= $i . $sort; ?>"><?= $i ?></a></li>
		<?php else : ?>
		<li class="page-item active"><a class="page-link" href="#"><?= $i ?></a></li>
		<?php endif;
	endfor;

	if ( $pagination['page'] == $pagination['total_pages'] ) : ?>
		<li class="page-item disabled"><a class="page-link" href="#">Suivant</a></li>
	<?php else :
		$j = $pagination['page'] + 1; ?>
		<li class="page-item"><a class="page-link" href="<?= GENERAL_CONFIG['url'].'/'.$pagination['for']; ?>/?page=<?= $j . $sort; ?>">Suivant</a></li>
	<?php endif; ?>
	</ul>
</nav>
