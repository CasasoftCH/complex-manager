<div class="complex-list-wrapper <?php echo ($collapsible ? 'complex-list-wrapper-collapsible' : '') ?> <?php echo $class ?>">
	<?php foreach ( $the_buildings as $building ) { ?>
		
		<div class="complex-unit-wrapper" <?= ($building['hidden'] ? ' style="display:none"' : '') ?>>
	 		<?php 
				$html = '<h2 class="unit-title">';
				echo apply_filters('cxm_render_building_title_opening_tag', $html);
			?>	

			<?php echo $building['term']->name; ?>

	 		<?php 
				$html = '</h2>';
				echo apply_filters('cxm_render_building_title_closing_tag', $html);
			?>	
			<?php 
				$individual_direct_recipients = '';
				if (isset($building['term']->term_id) && $building['term']->term_id) {
					$individual_direct_recipients = get_field('individual-direct-recipients', 'building_'.$building['term']->term_id);
				}
			 ?>
			<div class="unit-description"><?= wpautop( $building['description'], false ); ?></div>
			<div class="table-responsive complex-building-<?= $building['term']->slug ?>" data-recipients="<?php echo $individual_direct_recipients ?>">
				<table class="table table-condensed">
					<thead>
						<tr class="col-labels">
							<?php foreach ($building['the_units'][0]['displayItems'] as $displayItem): ?>
								<th class="col-<?= $displayItem['field'] ?> <?= ($displayItem['hidden-xs'] ? 'hidden-sm hidden-xs' : '') ?>"><?= $displayItem['label'] ?></th>		
							<?php endforeach ?>
							<?php if ($collapsible) : ?>
								<th></th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach ($building['the_units'] as $the_unit) {
							$type_array = wp_get_post_terms($the_unit['post']->ID, 'unit_type', array( 'field' => 'slugs' ));
							$types = '';
							$new_types = array();
							if ($type_array) {
								foreach ($type_array as $type) {
									$new_types[] = $type->slug;
								}
								$types = 'data-types="' . implode(', ', $new_types) . '"';
							}
							
							$colcount = count($the_unit['displayItems']);
							echo '<tr class="complex-unit-header-row state-' . $the_unit['state'] . ' status-' . $the_unit['status'] . '" id="unit_'.$the_unit['post']->ID.'" data-unit-id="' . $the_unit['post']->ID .'"' . $types .' data-json="' . htmlspecialchars(json_encode($the_unit['data']), ENT_QUOTES, 'UTF-8') . '">';
							foreach ($the_unit['displayItems'] as $displayItem) {
								echo '<td class="'.$displayItem['td_classes'].'">'.$displayItem['value'].'</td>';
							}
							if ($collapsible) {
								echo '<td class="complex-unit-caret-cell text-'.$the_unit['state'].'"><span class="complex-unit-caret"></span></td>';
								echo "</tr>";
								?>
									
									<tr class="complex-unit-detail-row" data-objectref="<?php echo get_cxm($the_unit['post'], 'idx_ref_object') ?>" data-imgurl="<?php echo (has_post_thumbnail( $the_unit['post']->ID ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $the_unit['post']->ID ), 'large' )[0] : ''); ?>">
										<td colspan="<?= $colcount+1 ?>">
											<div class="detail-row-wrapper">
												<?php if (has_post_thumbnail( $the_unit['post']->ID ) && $show_image ): ?>
													<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $the_unit['post']->ID ), 'hd' ); ?>
													<div class="complex-unit-featuredimage">
														<img class="img-responsive" data-src="<?php echo $image[0]; ?>" alt="" />
													</div>
												<?php endif; ?>
												<?php 
													$content = $the_unit['post']->post_content;
													$content = apply_filters('the_content', $content);
													$content = str_replace(']]>', ']]&gt;', $content);
													$content = str_replace('src=', 'src="data:image/svg+xml;base64,PHN2ZyBjbGFzcz0idWlsLXJpbmciIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIiB2aWV3Qm94PSIwIDAgMjAwIDIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCBjbGFzcz0iYmsiIGZpbGw9Im5vbmUiIGhlaWdodD0iMTAwIiB3aWR0aD0iMTAwIiB4PSIwIiB5PSIwIi8+PGRlZnM+PGZpbHRlciBoZWlnaHQ9IjMwMCUiIGlkPSJ1aWwtcmluZy1zaGFkb3ciIHdpZHRoPSIzMDAlIiB4PSItMTAwJSIgeT0iLTEwMCUiPjxmZU9mZnNldCBkeD0iMCIgZHk9IjAiIGluPSJTb3VyY2VHcmFwaGljIiByZXN1bHQ9Im9mZk91dCIvPjxmZUdhdXNzaWFuQmx1ciBpbj0ib2ZmT3V0IiByZXN1bHQ9ImJsdXJPdXQiIHN0ZERldmlhdGlvbj0iMCIvPjxmZUJsZW5kIGluPSJTb3VyY2VHcmFwaGljIiBpbjI9ImJsdXJPdXQiIG1vZGU9Im5vcm1hbCIvPjwvZmlsdGVyPjwvZGVmcz48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSg1MCw1MCkiPjxwYXRoIGQ9Ik0xMCw1MGMwLDAsMCwwLjUsMC4xLDEuNGMwLDAuNSwwLjEsMSwwLjIsMS43YzAsMC4zLDAuMSwwLjcsMC4xLDEuMWMwLjEsMC40LDAuMSwwLjgsMC4yLDEuMmMwLjIsMC44LDAuMywxLjgsMC41LDIuOCBjMC4zLDEsMC42LDIuMSwwLjksMy4yYzAuMywxLjEsMC45LDIuMywxLjQsMy41YzAuNSwxLjIsMS4yLDIuNCwxLjgsMy43YzAuMywwLjYsMC44LDEuMiwxLjIsMS45YzAuNCwwLjYsMC44LDEuMywxLjMsMS45IGMxLDEuMiwxLjksMi42LDMuMSwzLjdjMi4yLDIuNSw1LDQuNyw3LjksNi43YzMsMiw2LjUsMy40LDEwLjEsNC42YzMuNiwxLjEsNy41LDEuNSwxMS4yLDEuNmM0LTAuMSw3LjctMC42LDExLjMtMS42IGMzLjYtMS4yLDctMi42LDEwLTQuNmMzLTIsNS44LTQuMiw3LjktNi43YzEuMi0xLjIsMi4xLTIuNSwzLjEtMy43YzAuNS0wLjYsMC45LTEuMywxLjMtMS45YzAuNC0wLjYsMC44LTEuMywxLjItMS45IGMwLjYtMS4zLDEuMy0yLjUsMS44LTMuN2MwLjUtMS4yLDEtMi40LDEuNC0zLjVjMC4zLTEuMSwwLjYtMi4yLDAuOS0zLjJjMC4yLTEsMC40LTEuOSwwLjUtMi44YzAuMS0wLjQsMC4xLTAuOCwwLjItMS4yIGMwLTAuNCwwLjEtMC43LDAuMS0xLjFjMC4xLTAuNywwLjEtMS4yLDAuMi0xLjdDOTAsNTAuNSw5MCw1MCw5MCw1MHMwLDAuNSwwLDEuNGMwLDAuNSwwLDEsMCwxLjdjMCwwLjMsMCwwLjcsMCwxLjEgYzAsMC40LTAuMSwwLjgtMC4xLDEuMmMtMC4xLDAuOS0wLjIsMS44LTAuNCwyLjhjLTAuMiwxLTAuNSwyLjEtMC43LDMuM2MtMC4zLDEuMi0wLjgsMi40LTEuMiwzLjdjLTAuMiwwLjctMC41LDEuMy0wLjgsMS45IGMtMC4zLDAuNy0wLjYsMS4zLTAuOSwyYy0wLjMsMC43LTAuNywxLjMtMS4xLDJjLTAuNCwwLjctMC43LDEuNC0xLjIsMmMtMSwxLjMtMS45LDIuNy0zLjEsNGMtMi4yLDIuNy01LDUtOC4xLDcuMSBjLTAuOCwwLjUtMS42LDEtMi40LDEuNWMtMC44LDAuNS0xLjcsMC45LTIuNiwxLjNMNjYsODcuN2wtMS40LDAuNWMtMC45LDAuMy0xLjgsMC43LTIuOCwxYy0zLjgsMS4xLTcuOSwxLjctMTEuOCwxLjhMNDcsOTAuOCBjLTEsMC0yLTAuMi0zLTAuM2wtMS41LTAuMmwtMC43LTAuMUw0MS4xLDkwYy0xLTAuMy0xLjktMC41LTIuOS0wLjdjLTAuOS0wLjMtMS45LTAuNy0yLjgtMUwzNCw4Ny43bC0xLjMtMC42IGMtMC45LTAuNC0xLjgtMC44LTIuNi0xLjNjLTAuOC0wLjUtMS42LTEtMi40LTEuNWMtMy4xLTIuMS01LjktNC41LTguMS03LjFjLTEuMi0xLjItMi4xLTIuNy0zLjEtNGMtMC41LTAuNi0wLjgtMS40LTEuMi0yIGMtMC40LTAuNy0wLjgtMS4zLTEuMS0yYy0wLjMtMC43LTAuNi0xLjMtMC45LTJjLTAuMy0wLjctMC42LTEuMy0wLjgtMS45Yy0wLjQtMS4zLTAuOS0yLjUtMS4yLTMuN2MtMC4zLTEuMi0wLjUtMi4zLTAuNy0zLjMgYy0wLjItMS0wLjMtMi0wLjQtMi44Yy0wLjEtMC40LTAuMS0wLjgtMC4xLTEuMmMwLTAuNCwwLTAuNywwLTEuMWMwLTAuNywwLTEuMiwwLTEuN0MxMCw1MC41LDEwLDUwLDEwLDUweiIgZmlsbD0iIzk5OTk5OSIgZmlsdGVyPSJ1cmwoI3VpbC1yaW5nLXNoYWRvdykiPjxhbmltYXRlVHJhbnNmb3JtIGF0dHJpYnV0ZU5hbWU9InRyYW5zZm9ybSIgZHVyPSIxcyIgZnJvbT0iMCA1MCA1MCIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIHRvPSIzNjAgNTAgNTAiIHR5cGU9InJvdGF0ZSIvPjwvcGF0aD48L2c+PC9zdmc+" data-src=', $content);
													$content = preg_replace('/(<*[^>]*srcset=)"[^>]+"([^>]*>)/', '\1"data:image/svg+xml;base64,PHN2ZyBjbGFzcz0idWlsLXJpbmciIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIiB2aWV3Qm94PSIwIDAgMjAwIDIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCBjbGFzcz0iYmsiIGZpbGw9Im5vbmUiIGhlaWdodD0iMTAwIiB3aWR0aD0iMTAwIiB4PSIwIiB5PSIwIi8+PGRlZnM+PGZpbHRlciBoZWlnaHQ9IjMwMCUiIGlkPSJ1aWwtcmluZy1zaGFkb3ciIHdpZHRoPSIzMDAlIiB4PSItMTAwJSIgeT0iLTEwMCUiPjxmZU9mZnNldCBkeD0iMCIgZHk9IjAiIGluPSJTb3VyY2VHcmFwaGljIiByZXN1bHQ9Im9mZk91dCIvPjxmZUdhdXNzaWFuQmx1ciBpbj0ib2ZmT3V0IiByZXN1bHQ9ImJsdXJPdXQiIHN0ZERldmlhdGlvbj0iMCIvPjxmZUJsZW5kIGluPSJTb3VyY2VHcmFwaGljIiBpbjI9ImJsdXJPdXQiIG1vZGU9Im5vcm1hbCIvPjwvZmlsdGVyPjwvZGVmcz48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSg1MCw1MCkiPjxwYXRoIGQ9Ik0xMCw1MGMwLDAsMCwwLjUsMC4xLDEuNGMwLDAuNSwwLjEsMSwwLjIsMS43YzAsMC4zLDAuMSwwLjcsMC4xLDEuMWMwLjEsMC40LDAuMSwwLjgsMC4yLDEuMmMwLjIsMC44LDAuMywxLjgsMC41LDIuOCBjMC4zLDEsMC42LDIuMSwwLjksMy4yYzAuMywxLjEsMC45LDIuMywxLjQsMy41YzAuNSwxLjIsMS4yLDIuNCwxLjgsMy43YzAuMywwLjYsMC44LDEuMiwxLjIsMS45YzAuNCwwLjYsMC44LDEuMywxLjMsMS45IGMxLDEuMiwxLjksMi42LDMuMSwzLjdjMi4yLDIuNSw1LDQuNyw3LjksNi43YzMsMiw2LjUsMy40LDEwLjEsNC42YzMuNiwxLjEsNy41LDEuNSwxMS4yLDEuNmM0LTAuMSw3LjctMC42LDExLjMtMS42IGMzLjYtMS4yLDctMi42LDEwLTQuNmMzLTIsNS44LTQuMiw3LjktNi43YzEuMi0xLjIsMi4xLTIuNSwzLjEtMy43YzAuNS0wLjYsMC45LTEuMywxLjMtMS45YzAuNC0wLjYsMC44LTEuMywxLjItMS45IGMwLjYtMS4zLDEuMy0yLjUsMS44LTMuN2MwLjUtMS4yLDEtMi40LDEuNC0zLjVjMC4zLTEuMSwwLjYtMi4yLDAuOS0zLjJjMC4yLTEsMC40LTEuOSwwLjUtMi44YzAuMS0wLjQsMC4xLTAuOCwwLjItMS4yIGMwLTAuNCwwLjEtMC43LDAuMS0xLjFjMC4xLTAuNywwLjEtMS4yLDAuMi0xLjdDOTAsNTAuNSw5MCw1MCw5MCw1MHMwLDAuNSwwLDEuNGMwLDAuNSwwLDEsMCwxLjdjMCwwLjMsMCwwLjcsMCwxLjEgYzAsMC40LTAuMSwwLjgtMC4xLDEuMmMtMC4xLDAuOS0wLjIsMS44LTAuNCwyLjhjLTAuMiwxLTAuNSwyLjEtMC43LDMuM2MtMC4zLDEuMi0wLjgsMi40LTEuMiwzLjdjLTAuMiwwLjctMC41LDEuMy0wLjgsMS45IGMtMC4zLDAuNy0wLjYsMS4zLTAuOSwyYy0wLjMsMC43LTAuNywxLjMtMS4xLDJjLTAuNCwwLjctMC43LDEuNC0xLjIsMmMtMSwxLjMtMS45LDIuNy0zLjEsNGMtMi4yLDIuNy01LDUtOC4xLDcuMSBjLTAuOCwwLjUtMS42LDEtMi40LDEuNWMtMC44LDAuNS0xLjcsMC45LTIuNiwxLjNMNjYsODcuN2wtMS40LDAuNWMtMC45LDAuMy0xLjgsMC43LTIuOCwxYy0zLjgsMS4xLTcuOSwxLjctMTEuOCwxLjhMNDcsOTAuOCBjLTEsMC0yLTAuMi0zLTAuM2wtMS41LTAuMmwtMC43LTAuMUw0MS4xLDkwYy0xLTAuMy0xLjktMC41LTIuOS0wLjdjLTAuOS0wLjMtMS45LTAuNy0yLjgtMUwzNCw4Ny43bC0xLjMtMC42IGMtMC45LTAuNC0xLjgtMC44LTIuNi0xLjNjLTAuOC0wLjUtMS42LTEtMi40LTEuNWMtMy4xLTIuMS01LjktNC41LTguMS03LjFjLTEuMi0xLjItMi4xLTIuNy0zLjEtNGMtMC41LTAuNi0wLjgtMS40LTEuMi0yIGMtMC40LTAuNy0wLjgtMS4zLTEuMS0yYy0wLjMtMC43LTAuNi0xLjMtMC45LTJjLTAuMy0wLjctMC42LTEuMy0wLjgtMS45Yy0wLjQtMS4zLTAuOS0yLjUtMS4yLTMuN2MtMC4zLTEuMi0wLjUtMi4zLTAuNy0zLjMgYy0wLjItMS0wLjMtMi0wLjQtMi44Yy0wLjEtMC40LTAuMS0wLjgtMC4xLTEuMmMwLTAuNCwwLTAuNywwLTEuMWMwLTAuNywwLTEuMiwwLTEuN0MxMCw1MC41LDEwLDUwLDEwLDUweiIgZmlsbD0iIzk5OTk5OSIgZmlsdGVyPSJ1cmwoI3VpbC1yaW5nLXNoYWRvdykiPjxhbmltYXRlVHJhbnNmb3JtIGF0dHJpYnV0ZU5hbWU9InRyYW5zZm9ybSIgZHVyPSIxcyIgZnJvbT0iMCA1MCA1MCIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIHRvPSIzNjAgNTAgNTAiIHR5cGU9InJvdGF0ZSIvPjwvcGF0aD48L2c+PC9zdmc+"\2', $content);
													echo $content;
												?>
												<?php if (get_cxm($the_unit['post'], 'download_file')): ?>
												 	<a target="_blank" class="
												 		<?php 
															$html = 'btn btn-primary pull-left complex-download-btn';
															echo apply_filters('cxm_render_download_button_classes', $html);
														?>" 
													href="<?= get_cxm($the_unit['post'], 'download_file') ?>">
														<span>
															<?php echo (get_cxm($the_unit['post'], 'download_label') ? get_cxm($the_unit['post'], 'download_label') : 'Download') ?>
														</span>
												 		<?php 
															$html = '';
															echo apply_filters('cxm_render_download_button_additional_content', $html);
														?>	
													</a>
												<?php endif ?>
												<?php if (get_cxm($the_unit['post'], 'link_url')): ?>
												 	<a 
												 		<?php if (get_cxm($the_unit['post'], 'link_target')): ?> 
												 			target="<?php echo get_cxm($the_unit['post'], 'link_target') ?>"
												 		<?php else: ?>
												 			target="_self"
														<?php endif; ?>
												 			class="
												 		<?php 
															$html = 'btn btn-primary pull-left complex-link-btn';
															echo apply_filters('cxm_render_link_button_classes', $html);
														?>" 
													href="<?= get_cxm($the_unit['post'], 'link_url') ?>">
														<span>
															<?php echo (get_cxm($the_unit['post'], 'link_label') ? get_cxm($the_unit['post'], 'link_label') : 'Link') ?>
														</span>
												 		<?php 
															$html = '';
															echo apply_filters('cxm_render_link_button_additional_content', $html);
														?>	
													</a>
												<?php endif ?>
											 	<?php if ($the_unit['status'] != 'sold' && $the_unit['status'] != 'rented' && $integrate_form): ?>
											 		<a class="
													 		<?php 
																$html = 'btn btn-primary pull-right complex-call-contact-form';
																echo apply_filters('cxm_render_contact_button_classes', $html);
															?>"
														data-unit-id="<?= $the_unit['post']->ID ?>" href="#complexContactForm">
														<span>
															<?php echo __('Contact', 'complexmanager'); ?>
														</span>
												 		<?php 
															$html = '';
															echo apply_filters('cxm_render_contact_button_additional_content', $html);
														?>	
													</a>
											 	<?php endif ?>
													
												<div class="clearfix"></div>
											</div>
										</td>
									</tr>
								<?php
							}
						}
					echo "</tbody>";
					?>
					<?php if(isset($building['totals'])) : ?>
						<tfoot>
							<tr class="complex-list-footer-row">
								<?php foreach ($building['the_units'][0]['displayItems'] as $displayItem): ?>
									<th class="col-<?= $displayItem['field'] ?> <?= ($displayItem['hidden-xs'] ? 'hidden-sm hidden-xs' : '') ?>">
										<?php if (isset($building['totals'][$displayItem['field']]) && $building['totals'][$displayItem['field']]): ?>
											<?= $building['totals'][$displayItem['field']] ?>	
										<?php endif; ?>
									</th>		
								<?php endforeach ?>
								<?php if ($collapsible) : ?>
									<th></th>
								<?php endif; ?>
							</tr>
						</tfoot>
					<?php endif; ?>

					<?php

				echo "</table>";
			echo "</div>";
		echo "</div>";
	}
	?>
	<?php if ($form): ?>
		<div class="complex-contact-form-wrapper" id="complexContactForm">
			<a style="display:none" class="pull-right complex-sendback-contact-form" href="#complexContactForm"><i class="glyphicon glyphicon-remove"></i><span class="sr-only"><?= __('Cancel', 'complexmanager') ?></span></a>
			<?= $form ?>
		</div>	
	<?php endif ?>
	
</div>
