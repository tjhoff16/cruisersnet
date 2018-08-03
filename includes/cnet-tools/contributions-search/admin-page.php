<?php
function cnet_tools_contributions_search_page() {
?>

<div class="wrap">
	
	<h1>Contributions Search</h1>
	
	<div class="top-contributors">
		
		<div class="contributions-title">
			Top Contributors (All Time)
		</div>
		
		<?php
		global $wpdb;
		$commentor_array = array();
		$commentor_by_email = array();
		$comments_query = "SELECT * FROM wp_comments WHERE comment_type != 'pingback' AND comment_author_email != '' AND comment_author_email != 'cruisingwriter@triad.rr.com' AND comment_author_email != 'NC-SCEditor@cruisersnet.net' AND comment_approved = '1' ";
		$commenters = $wpdb->get_results($comments_query);
		
		foreach ($commenters as $commentor) {
			$commentor_by_email[$commentor->comment_author_email][] = $commentor;
		}
		
		foreach ($commentor_by_email as $person) {
			$count = count($person);
			$email = $person[0]->comment_author_email;
			$name = $person[0]->comment_author;
			$commentor_array[$email] = array(
				'email' => $email,
				'name' => $name,
				'count' => $count
			);
		}
		usort($commentor_array, function ($a, $b) {
			return $a['count'] <= $b['count'];
		});
		?>
		
		<div class="contributions-options">
			<h3>Comments Only</h3>
			<ul>
			<?php for ($i=1;$i<=10;$i++) { ?>
				<li>
					<?php echo $i; ?>) <?php echo $commentor_array[$i]['email']; ?>
				    <?php if ($commentor_array[$i]['name']) { echo ' (' . $commentor_array[$i]['name'] . ')'; } ?>
				    - <?php echo $commentor_array[$i]['count']; ?>
				</li>
			<?php } ?>
			</ul>
		</div>
		
	</div>
	
	<form class="contributions-form" action="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=contributions-manager" method="get">
			
		<div class="contributions-title">
			Search Options
		</div>
		
		<div class="contributions-options">
		
			<div class="contributions-option contributions-75">
				<label for="search-terms">
					Email Address<br />
					<input type="text" id="contributions-search-terms" class="contributions-input" name="search-terms" value="<?php echo $_GET['email']; ?>" />
				</label>
			</div>
			
			<div class="contributions-option contributions-25 contributions-push">
				<label for="post-type">
					Contribution Type<br />
					<select id="contributions-post-type" name="post-type">
						<option value="all">All Contributions</option>
						<option value="submission">Cruising News Submission</option>
						<option value="comment">Post Comments / Reviews</option>
					</select>
				</label>
			</div>
			
			<div class="contributions-clear"></div>
			
		</div>
		
		<div class="contributions-footer">
			<div class="contributions-option contributions-right">
				<input type="hidden" name="contributions-submit" value="true" />
				<input type="hidden" name="page" value="contributions-search" />
				<input type="submit" class="contributions-submit button button-primary" value="Search" />
			</div>
			<div class="contributions-clear"></div>
		</div>
		
	</form>
	
</div>

<?php
}

// Add menu page
function cnet_tools_add_contributions_search_page() {
	add_menu_page('Contributions Search', 'CNET Tools', 'manage_options', 'contributions-search', 'cnet_tools_contributions_search_page', 'dashicons-admin-tools');
}
add_action('admin_menu', 'cnet_tools_add_contributions_search_page');

// Add scripts & styles
function cnet_tools_scripts() {
	wp_enqueue_script('cnet-tools-scripts', get_template_directory_uri() . '/includes/cnet-tools/cnet-tools.js', array('jquery'), '1.0.0', false);
	wp_enqueue_style('contributions-search-css', get_template_directory_uri() . '/includes/cnet-tools/contributions-search/admin-page.css', array(), '1.0.0', 'all');
}
add_action('admin_enqueue_scripts', 'cnet_tools_scripts');