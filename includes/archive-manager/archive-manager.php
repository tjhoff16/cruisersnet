<?php 
function cnet_check_option($name, $value) {
	if ($_GET[$name] == $value) {
		echo 'selected="selected"';
	}
}

function cnet_archive_manager() { 
?>	

<div class="wrap">
	
	<h1>Archive Manger</h1>
	
	<form class="archive-form" action="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=archive-manager" method="get">
			
		<div class="archive-title">
			Search Options
		</div>
		
		<div class="archive-options">
		
			<div class="archive-option archive-50">
				<label for="search-terms">
					Search Terms<br />
					<input type="text" id="archive-search-terms" class="archive-input" name="search-terms" value="<?php echo $_GET['search-terms']; ?>" />
				</label>
			</div>
			
			<div class="archive-option archive-25 archive-push">
				<label for="post-type">
					Post Type<br />
					<select id="archive-post-type" name="post-type">
						<option value="all" <?php cnet_check_option('post-type', 'all'); ?>>All Post Types</option>
						<option value="post" <?php cnet_check_option('post-type', 'post'); ?>>Posts</option>
						<option value="page" <?php cnet_check_option('post-type', 'page'); ?>>Pages</option>
						<option value="cnet_marinas" <?php cnet_check_option('post-type', 'cnet_marinas'); ?>>Marinas</option>
						<option value="info_icons" <?php cnet_check_option('post-type', 'info_icons'); ?>>Info Icons</option>
						<option value="cnet_anchorages" <?php cnet_check_option('post-type', 'cnet_anchorages'); ?>>Anchorages</option>
						<option value="cnet_bridges" <?php cnet_check_option('post-type', 'cnet_bridges'); ?>>Bridges</option>
						<option value="nav_alerts" <?php cnet_check_option('post-type', 'nav_alerts'); ?>>Nav Alerts</option>
						<option value="cnet_reviews" <?php cnet_check_option('post-type', 'cnet_reviews'); ?>>Reviews</option>
						<option value="cnet_archive" <?php cnet_check_option('post-type', 'cnet_archive'); ?>>Archived Item</option>
					</select>
				</label>
			</div>
			
			<div class="archive-option archive-25 archive-push">
				<label for="search-status">
					Post Status<br />
					<select id="archive-search-status" name="search-status">
						<option value="any" <?php cnet_check_option('search-status', 'any'); ?>>Any Status</option>
						<option value="publish" <?php cnet_check_option('search-status', 'publish'); ?>>Published</option>
						<option value="draft" <?php cnet_check_option('search-status', 'draft'); ?>>Draft</option>
						<option value="expired" <?php cnet_check_option('search-status', 'expired'); ?>>Expired</option>
					</select>
				</label>
			</div>
			
			<div class="archive-clear"></div>
			
		</div>
		
		<div class="archive-footer">
			<div class="archive-option archive-right">
				<input type="hidden" name="archive-submit" value="true" />
				<input type="hidden" name="page" value="archive-manager" />
				<input type="submit" class="archive-submit button button-primary" value="Search" />
			</div>
			<div class="archive-clear"></div>
		</div>
		
	</form>
	<?php 
	if ($_GET['archive-submit'] == true) {
	
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args['paged'] = $paged;
		
		$args['posts_per_page'] = 50;
		
		if ($_GET['post-type'] != 'all')
			$args['post_type'] = $_GET['post-type'];
		
		if ($_GET['search-status'] == 'expired') {
			$args['meta_query'] = array(
				array(
					'key' => '_expiration-date',
					'value' => time(),
					'compare' => '<'
				)
			);	
		} else {
			$args['post_status'] = $_GET['search-status'];
		}
		
		
		$args['s'] = $_GET['search-terms'];
		
		$search = new WP_Query($args);
		
		if ($paged > 1 || $paged < ceil($search->found_posts / 50)) {
			$pagi_class_next = 'active-pagi';
			$pagi_class_prev = 'disable-pagi';
			$paged_next = $paged + 1;
			$paged_last = ceil($search->found_posts / 50);
			$url_next = get_bloginfo('url') . '/wp-admin/admin.php?page=archive-manager&archive-submit=true&search-terms=' . $_GET['search-terms'] . '&search-status=' . $_GET['search-status'] . '&post-type=' . $_GET['post-type'] . '&paged=' . $paged_next;
			$url_last = get_bloginfo('url') . '/wp-admin/admin.php?page=archive-manager&archive-submit=true&search-terms=' . $_GET['search-terms'] . '&search-status=' . $_GET['search-status'] . '&post-type=' . $_GET['post-type'] . '&paged=' . $paged_last;
			$url_prev = 'javascript:void(0);';
			$url_first = 'javascript:void(0);';
		} else {
			$pagi_class_next = 'disable-pagi';
			$pagi_class_prev = 'active-pagi';
			$paged_prev = $paged - 1;
			$url_next = 'javascript:void(0);';
			$url_last = 'javascript:void(0);';
			$url_prev = get_bloginfo('url') . '/wp-admin/admin.php?page=archive-manager&archive-submit=true&search-terms=' . $_GET['search-terms'] . '&search-status=' . $_GET['search-status'] . '&post-type=' . $_GET['post-type'] . '&paged=' . $paged_prev;
			$url_first = get_bloginfo('url') . '/wp-admin/admin.php?page=archive-manager&archive-submit=true&search-terms=' . $_GET['search-terms'] . '&search-status=' . $_GET['search-status'] . '&post-type=' . $_GET['post-type'] . '&paged=1';
		}
		
	}
	
	if ($_GET['archive-submit'] == true) { 
	?>
	<div class="tablenav-pages">
		<span class="displaying-num"><?php echo $search->found_posts; ?> items</span> 
		<span class="pagination-links">
			<a class="first-page <?php echo $pagi_class_prev; ?>" href="<?php echo $url_first; ?>">
				<span class="screen-reader-text">First page</span>
				<span aria-hidden="true">«</span>
			</a>
			<a class="previous-page <?php echo $pagi_class_prev; ?>" href="<?php echo $url_prev; ?>">
				<span class="screen-reader-text">Previous page</span>
				<span aria-hidden="true">‹</span>
			</a>
			<span class="paging-input">
				<label class="screen-reader-text" for="current-page-selector">Current Page</label>
				<input aria-describedby="table-paging" class="current-page" id="current-page-selector" name="paged" size="1" type="text" value="<?php echo $paged; ?>"> 
				of 
				<span class="total-pages"><?php echo ceil($search->found_posts / 50); ?></span>
			</span> 
			<a class="next-page <?php echo $pagi_class_next; ?>" href="<?php echo $url_next; ?>">
				<span class="screen-reader-text">Next page</span>
				<span aria-hidden="true">›</span>
			</a> 
			<a class="last-page <?php echo $pagi_class_next; ?>" href="<?php echo $url_last; ?>">
				<span class="screen-reader-text">Last page</span>
				<span aria-hidden="true">»</span>
			</a>
		</span>
	</div>
	<?php } ?>
	
	<table class="wp-list-table widefat fixed striped posts">
		<thead>
			<tr>
				<th scope="col" class="archive-post-title manage-column column-title column-primary">
					<span class="archive-margin">Title</span>
				</th>
				<th scope="col" class="archive-col manage-column">
					Post Type
				</th>
				<th scope="col" class="archive-col manage-column">
					Published Date
				</th>
				<th scope="col" class="archive-col manage-column">
					Modified Date
				</th>
				<th scope="col" class="archive-post-options manage-column">
					Expires
				</th>
				<th scope="col" class="archive-post-options manage-column">
					Archive Options
				</th>
			</tr>
		</thead>
		<tbody id="the-list">
		<?php 
		if ($_GET['archive-submit'] == true) {
			if ($search->have_posts()) {
				while ($search->have_posts()) : $search->the_post(); global $post;
				?>
				
			<tr id="row-<?php echo $post->ID; ?>" class="iedit author-other level-0 post-<?php echo $post->ID; ?> type-cnet_reviews status-publish hentry cnet_reviews_category-010-north-carolina-3 cnet_reviews_category-030-nc-anchorage-navigation">
				<td class="archive-post-title archive-results-column title column-title column-primary page-title">
					<a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a>
				</td>
				<td id="col-post-type-<?php echo $post->ID; ?>" class="archive-results-column">
					<?php echo $post->post_type; ?>
				</td>
				<td class="archive-results-column">
					<?php echo $post->post_date; ?>
				</td>
				<td class="archive-results-column">
					<?php echo $post->post_modified; ?>
				</td>
				<td class="archive-results-column">
					<?php
					$expiration_date = get_post_meta($post->ID, '_expiration-date', true);
					if ($expiration_date) {
						echo date('r', $expiration_date);
					} else {
						echo 'Never';
					}
					?>
				</td>
				<td id="col-option-<?php echo $post->ID; ?>" class="archive-results-column archive-options-column">
					<?php
					if ($post->post_type == 'cnet_archive') {
						echo '<a class="archive-action" data-id="' . $post->ID . '" data-option="restore" href="javascript:void(0);"><span class="dashicons dashicons-image-rotate"></span> Restore</a>';
					} else {
						echo '<a class="archive-action" data-id="' . $post->ID . '" data-option="archive" href="javascript:void(0);"><span class="dashicons dashicons-category"></span> Archive</a>';
					}
					?>
				</td>
			</tr>
					
				<?php
				endwhile;
			} else {
			?>	
			
			<tr>
				<td colspan="6" class="archive-no-results">
					No results found. Try searching again.
				</td>
			</tr>
			
			<?php	
			}
		} else {
		?>
			<tr>
				<td colspan="6" class="archive-no-results">
					Use the form above to search for content to manage.
				</td>
			</tr>
		<?php	
		}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th scope="col" class="archive-post-title manage-column column-title column-primary">
					<span class="archive-margin">Title</span>
				</th>
				<th scope="col" class="archive-col manage-column">
					Post Type
				</th>
				<th scope="col" class="archive-col manage-column">
					Published Date
				</th>
				<th scope="col" class="archive-col manage-column">
					Modified Date
				</th>
				<th scope="col" class="archive-post-options manage-column">
					Expires
				</th>
				<th scope="col" class="archive-post-options manage-column">
					Archive Options
				</th>
			</tr>
		</tfoot>
	</table>
	
	<?php if ($_GET['archive-submit'] == true) { ?>
	<div class="tablenav-pages">
		<span class="displaying-num"><?php echo $search->found_posts; ?> items</span> 
		<span class="pagination-links">
			<a class="first-page <?php echo $pagi_class_prev; ?>" href="<?php echo $url_first; ?>">
				<span class="screen-reader-text">First page</span>
				<span aria-hidden="true">«</span>
			</a>
			<a class="previous-page <?php echo $pagi_class_prev; ?>" href="<?php echo $url_prev; ?>">
				<span class="screen-reader-text">Previous page</span>
				<span aria-hidden="true">‹</span>
			</a>
			<span class="paging-input">
				<label class="screen-reader-text" for="current-page-selector">Current Page</label>
				<input aria-describedby="table-paging" class="current-page" id="current-page-selector" name="paged" size="1" type="text" value="<?php echo $paged; ?>"> 
				of 
				<span class="total-pages"><?php echo ceil($search->found_posts / 50); ?></span>
			</span> 
			<a class="next-page <?php echo $pagi_class_next; ?>" href="<?php echo $url_next; ?>">
				<span class="screen-reader-text">Next page</span>
				<span aria-hidden="true">›</span>
			</a> 
			<a class="last-page <?php echo $pagi_class_next; ?>" href="<?php echo $url_last; ?>">
				<span class="screen-reader-text">Last page</span>
				<span aria-hidden="true">»</span>
			</a>
		</span>
	</div>
	<?php } ?>
	
</div>

<?php	
}
// Add menu page for the Archive Manager
function cnet_archive_manager_admin() {
	add_submenu_page('edit.php?post_type=cnet_archive', 'Archive Manager', 'Archive Manager', 'manage_options', 'archive-manager', 'cnet_archive_manager');
}
add_action('admin_menu', 'cnet_archive_manager_admin');

// Include Archive Manager Scripts & Styles
function theme_name_scripts() {
	wp_enqueue_script('archive-manager-js', get_template_directory_uri() . '/includes/archive-manager/archive-manager.js', array('jquery'), '1.0.0', false);
	wp_enqueue_style('archive-manager-css', get_template_directory_uri() . '/includes/archive-manager/archive-manager.css', array(), '1.0.0', 'all');
}
add_action('admin_enqueue_scripts', 'theme_name_scripts');

// AJAX to process archive option
function archive_manager_ajax() {
	
	$action = $_POST['option'];
	$id = $_POST['id'];
	
	$return = array('result'=>'error', 'post_type'=>'error');
	
	if ($action == 'archive') {
		$the_post = get_post($id);
		$current_post_status = $the_post->post_status;
		$current_post_type = $the_post->post_type;
		$current_modified_date = $the_post->post_modified;
		update_post_meta($id, 'original_post_type', $current_post_type);
		update_post_meta($id, 'original_post_status', $current_post_status);
		update_post_meta($id, 'original_modified_date', $current_modified_date);
		$args = array(
			'ID' => $id,
			'post_type' => 'cnet_archive',
			'post_status' => 'draft'
		);
		$update = wp_update_post($args);
		if ($update != 0) {
			$return = array('result'=>'archived', 'post_type'=>'cnet_archive');
		}
	}
	
	if ($action == 'restore') {
		$original_post_type = get_post_meta($id, 'original_post_type', true);
		$original_post_status = get_post_meta($id, 'original_post_status', true);
		$args = array(
			'ID' => $id,
			'post_type' => $original_post_type,
			'post_status' => $original_post_status
		);
		$update = wp_update_post($args);
		if ($update != 0) {
			$return = array('result'=>'restored', 'post_type'=>$original_post_type);
		}
	}
	
	echo json_encode($return);
	
	exit;
	
}
add_action('wp_ajax_archive_option', 'archive_manager_ajax');
add_action('wp_ajax_nopriv_archive_option', 'archive_manager_ajax');


add_action( 'admin_head', 'showhiddencustomfields' );
function showhiddencustomfields() {
	echo "<style type='text/css'>#postcustom .hidden { display: table-row; }</style>";
}