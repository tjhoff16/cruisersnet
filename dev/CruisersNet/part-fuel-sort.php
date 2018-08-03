				<?php $term = get_query_var('cnet_regions_marinas'); ?>
				<div class="fuel-sort">
					<ul class="pureCssMenu pureCssMenum">
						<li class="pureCssMenui"><a class="pureCssMenui" href="#"><span>Sort Fuel Prices - Find the BEST Deals!</span><![if gt IE 6]></a><![endif]><!--[if lte IE 6]><table><tr><td><![endif]-->
						<ul class="pureCssMenum">
							<li class="pureCssMenui"><a class="pureCssMenui" href="<?php bloginfo('url'); ?>/marinas/<?php echo $term; ?>/?fuel">Geographic Order (Default)</a></li>
							<li class="pureCssMenui"><a class="pureCssMenui" href="<?php bloginfo('url'); ?>/marinas/<?php echo $term; ?>/?fuel&sort=diesel">Diesel Prices (Low to High)</a></li>
							<li class="pureCssMenui"><a class="pureCssMenui" href="<?php bloginfo('url'); ?>/marinas/<?php echo $term; ?>/?fuel&sort=gas">Gas Prices (Low to High)</a></li>
							<li class="pureCssMenui"><a class="pureCssMenui" href="<?php bloginfo('url'); ?>/marinas/<?php echo $term; ?>/?fuel&sort=vtechd">ValvTect Only - Diesel (Low to High)</a></li>
							<li class="pureCssMenui"><a class="pureCssMenui" href="<?php bloginfo('url'); ?>/marinas/<?php echo $term; ?>/?fuel&sort=vtechg">ValvTect Only - Gas (Low to High)</a></li>
							<li class="pureCssMenui"><a class="pureCssMenui" href="<?php bloginfo('url'); ?>/marinas/<?php echo $term; ?>/?fuel&sort=boatusd">Boat/US Discount Only - Diesel (Low to High)</a></li>
							<li class="pureCssMenui"><a class="pureCssMenui" href="<?php bloginfo('url'); ?>/marinas/<?php echo $term; ?>/?fuel&sort=boatusg">Boat/US Discount Only - Gas (Low to High)</a></li>
					</ul>
				<!--[if lte IE 6]></td></tr></table></a><![endif]--></li>
					</ul>
				</div>