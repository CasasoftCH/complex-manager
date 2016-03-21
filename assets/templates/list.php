<div class="complex-list-wrapper">
	<?php foreach ( $buildings as $building ) { ?>
		<div class="table-responsive complex-building-<?= $building['term']->slug ?>">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th colspan="<?= count($cols)+1 ?>"><?= $building['term']->name  ?></th>
					</tr>
				</thead>
				<tbody>
					<tr class="col-labels">
						<?php foreach ($cols as $field => $col): ?>
							<?php if ($col['active']): ?>
								<th <?= ($col['hidden-xs'] ? 'class="hidden-sm hidden-xs"' : '') ?> class="col-<?= $field ?>"><?=nl2br(str_replace('\n', "\n", ($col['label'] ? $col['label'] : get_cxm_label(false, $field, 'complex_unit') ) ) ) ?></th>	
							<?php endif ?>
						<?php endforeach ?>
						<th></th>
					</tr>
					<?php 
					foreach ($building['units'] as $unit) {
						$status = get_cxm($unit, 'status');
						$state = 'default';
						switch ($status) {
							case 'available': $state = 'default'; break;
							case 'reserved': $state = 'danger'; break;
							case 'rented': $state = 'danger'; break;
							case 'sold': $state = 'danger'; break;
						}

						$data = array();
						foreach ($cols as $field => $col) {
							$value = get_cxm($unit, $field);
							$data[$field] = htmlentities($value);
						}
						echo '<tr class="complex-unit-header-row '.$state.'" id="unit_'.$unit->ID.'" data-json="' . htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8') . '">';
						$i = 0; foreach ($cols as $field => $col) { 

							
							if ($col['active']):
								
								$i++;
								switch ($field) {
									case 'status':
										$value = '';
										switch ($status) {
											case 'available': $value = '<span class="text-success">'.strtolower(__('Available', 'complexmanager')).'</span>'; break;
											case 'reserved': $value = '<span class="text-'.$state.'">'.strtolower(__('Reserved', 'complexmanager')).'</span>'; break;
											case 'rented': $value = '<span class="text-'.$state.'">'.strtolower(__('Rented', 'complexmanager')).'</span>'; break;
											case 'sold': $value = '<span class="text-'.$state.'">'.strtolower(__('Sold', 'complexmanager')).'</span>'; break;
											default: $value = $status;
										}
										echo '<td class="hidden-sm hidden-xs col-status"><span class="text-'.$state.'">' . $value . '</span></td>';
										break;
									case 'r_purchase_price':
									case 'r_rent_net':
									case 'r_rent_gross':
										if (
											$col['hidden-reserved'] == 0
											||
											!in_array($status, array('reserved', 'sold', 'rented'))
										) {
											$value = get_cxm($unit, $field);	
											$currency = false;
											if (get_cxm($unit, 'unit_currency')) {
												$currency = get_cxm($unit, 'unit_currency');
											}
										} else {
											$value = '';
										}
										echo '<td class="'.($col['hidden-xs'] ? 'hidden-sm hidden-xs' : '') . ' col-' . $field . '">' . ($currency ? $currency . ' ' : '') . $value . '</td>';
										break;
									default:
										if (
											$col['hidden-reserved'] == 0
											||
											!in_array($status, array('reserved', 'sold', 'rented'))
										) {
											$value = get_cxm($unit, $field);	
										} else {
											$value = '';
										}
										
										echo '<td class="'.($col['hidden-xs'] ? 'hidden-sm hidden-xs' : '') . ' col-' . $field . '"><span class="text-'.$state.'">' . ($i == 1 ? '<strong>' : '') . $value . ($i == 1 ? '</strong>' : '') . '</span></td>';
										break;
								}
							endif;
						}
						echo '<td class="complex-unit-caret-cell text-'.$state.'"><span class="complex-unit-caret"></span></td>';
						echo "</tr>";
						?>
							<tr class="complex-unit-detail-row">
								<td colspan="<?= count($cols)+1 ?>">
									<div class="detail-row-wrapper">
										<?php if (has_post_thumbnail( $unit->ID ) ): ?>
											<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $unit->ID ), 'large' ); ?>
											<a href="#" class="complex-unit-featuredimage">
												<img class="img-responsive" src="<?php echo $image[0]; ?>" alt="" />
											</a>
										<?php endif; ?>
										<?php 
											$content = $unit->post_content;
											$content = apply_filters('the_content', $content);
											$content = str_replace(']]>', ']]&gt;', $content);
											echo $content;
										 ?>
										 <?php if (get_cxm($unit, 'download_file')): ?>
										 	<a target="_blank" class="btn btn-primary pull-left complex-download-btn" href="<?= get_cxm($unit, 'download_file') ?>"><?= (get_cxm($unit, 'download_label') ? get_cxm($unit, 'download_label') : 'Download') ?></a>
										 <?php endif ?>
											<a class="btn btn-primary pull-right complex-call-contact-form" data-unit-id="<?= $unit->ID?>" href="#complexContactForm">Kontakt</a>
										<div class="clearfix"></div>
									</div>
								</td>
							</tr>
						<?php
					}
				echo "</tbody>";
			echo "</table>";
		echo "</div>";
	}
	?>
	<div class="complex-contact-form-wrapper" id="complexContactForm">
		<a style="display:none" class="pull-right complex-sendback-contact-form" href="#complexContactForm"><i class="glyphicon glyphicon-remove"></i><span class="sr-only">Cancel</span></a>
		<?= $form ?>
	</div>
</div>




