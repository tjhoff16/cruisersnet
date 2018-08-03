						<?php 
						$useragent=$_SERVER['HTTP_USER_AGENT'];
						if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\x-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
							
						} else {
						
						
							if (get_post_meta($post->ID,'display_in_post',true) == 'enable') : 
							
								if (get_post_meta($post->ID,'cvcf-latitude_dec',true) && get_post_meta($post->ID,'cvcf-longitude_dec',true)) :
							
									// check and see if height/width were set in admin
									$height = get_post_meta($post->ID,'chartlet_height',true);
									$width = get_post_meta($post->ID,'chartlet_width',true);
									
									// set default width and height if not set in admin
									$height = ($height == '' ? 182 : $height);
									$width = ($width == '' ? 280 : $width);
									
									// set width to full width (830px) if over 800 px (also prevent maps from spilling out of post)
									$width = ($width > 800 ? 830 : $width);
									
									// add a little more width for CSS buffer
									$wrapper_width = $width + 6;
									?>
									<div class="marina-featured marina-featured-post">
										<div class="marina-chartlet" style="width: <?php echo $wrapper_width; ?>px;">
											<iframe width="<?php echo $width; ?>" height="<?php echo $height; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php bloginfo('template_directory'); ?>/includes/features/chartlet.php?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-chartletzoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?><?php if (get_post_meta($post->ID,'chartlet_style',true) == 'hybrid') { echo '&amp;map=hybrid'; } ; ?>&amp;output=embed"></iframe><br />
			        				<a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-zoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>">Click Here For a Full Sized ChartView Page</a>
										</div>
										<br />
										<div class="post-banner-wrap">
										<?php
										$assigned_sponsor = get_field('sponsor_assign_to_post');
										if ($assigned_sponsor) {
											
											foreach ($assigned_sponsor as $sponsor) {
												
												$sponsor_id = get_post_meta($sponsor, 'sponsor_id', true);
												$sponsor_src = get_post_meta($sponsor, 'sponsor_src', true);
												$sponsor_alt = get_post_meta($sponsor, 'sponsor_alt', true);
												
												echo '<a class="post-banner" href="' . get_bloginfo('url') . '/wp-content/plugins/adrotate/adrotate-out.php?trackerid=' . $sponsor_id . '" target="_blank"><img src="' . $sponsor_src . '" alt="' . $sponsor_alt . '" /></a>';
												
											}
											
										}
										?>
										</div>
									</div>
								
								<?php endif; ?>
								
							<?php endif; ?>
							
						<?php }