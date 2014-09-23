<div class="complex-project-graphic">
	<img src="<?= $image ?>" class="complex-project-graphic-bg" width="1152" height="680" alt="">
	<svg class="complex-project-graphic-interaction" version="1.1" viewBox="0 0 <?= $width ?> <?= $height ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
		<?php 
			$current_url = "http" . (($_SERVER['SERVER_PORT']==443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			foreach ($buildings as $building) {
				foreach ($building['units'] as $unit) {
					$color = get_post_meta( $unit->ID, '_complexmanager_unit_graphic_hover_color', true );
					$poly = get_post_meta( $unit->ID, '_complexmanager_unit_graphic_poly', true );
					if ($poly) {
						echo '<a data-target="#unit_'.$unit->ID.'" xlink:href="' . $current_url . '#unit_'.$unit->ID.'"><polygon style="fill:'.$color.'" points="'.$poly.'" /></a>';
					}
				}
			}
		?>
	</svg>
</div>