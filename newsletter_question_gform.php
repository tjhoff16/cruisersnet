<div id="divNewsletter" class="clearfix post-155856 page type-page status-publish hentry dialog_newsletter_div" style="display:none;">
	<header class="entry-header">
		<h2 class="entry-title">Cruisers’ Net Newsletter and Alert List Signup</h2>
	</header>
	<!-- entry content begin -->
	<div class="entry-content marina-content">
		<div class="gf_browser_chrome gform_wrapper" id="gform_wrapper_3"><a id="gf_3" class="gform_anchor"></a>
			<form method="post" enctype="multipart/form-data" target="gform_ajax_frame_3" id="gform_3" action="/alert-list-signup/#gf_3">
				<div class="gform_body">
					<ul id="gform_fields_3" class="gform_fields top_label form_sublabel_below description_below">
						<li id="field_3_3" class="gfield field_sublabel_below field_description_below gfield_visibility_visible"><label class="gfield_label" for="input_3_3">First Name</label>
							<div class="ginput_container ginput_container_text"><input name="input_3" id="input_3_3" type="text" value="" class="medium" aria-invalid="false" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;"></div>
						</li>
						<li id="field_3_4" class="gfield field_sublabel_below field_description_below gfield_visibility_visible"><label class="gfield_label" for="input_3_4">Last Name</label>
							<div class="ginput_container ginput_container_text"><input name="input_4" id="input_3_4" type="text" value="" class="medium" aria-invalid="false"></div>
						</li>
						<li id="field_3_2" class="gfield gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible"><label class="gfield_label" for="input_3_2">Email<span class="gfield_required">*</span></label>
							<div class="ginput_container ginput_container_email">
								<input name="input_2" id="input_3_2" type="text" value="" class="medium" aria-required="true" aria-invalid="false">
							</div>
						</li>
					</ul>
				</div>
				<div class="gform_footer top_label">
                    <input type="submit" id="gform_submit_button_3" class="gform_button button" value="Submit" onclick="if(window[&quot;gf_submitting_3&quot;]){return false;}  window[&quot;gf_submitting_3&quot;]=true;  " onkeypress="if( event.keyCode == 13 ){ if(window[&quot;gf_submitting_3&quot;]){return false;} window[&quot;gf_submitting_3&quot;]=true;  jQuery(&quot;#gform_3&quot;).trigger(&quot;submit&quot;,[true]); }">
                    <input type="button" id="gform_submit_button_cancel" class="gform_button button" value="Cancel" onclick="javascript:closeDialog()">
                    <input type="hidden" name="gform_ajax" value="form_id=3&amp;title=&amp;description=&amp;tabindex=0">
					<input type="hidden" class="gform_hidden" name="is_submit_3" value="1">
					<input type="hidden" class="gform_hidden" name="gform_submit" value="3">
					<input type="hidden" class="gform_hidden" name="gform_unique_id" value="">
					<input type="hidden" class="gform_hidden" name="state_3" value="WyJbXSIsImNlMDk3ZmI2MjIzMWJmY2I5NTE1Mjg0YjRkZmM0YTM5Il0=">
					<input type="hidden" class="gform_hidden" name="gform_target_page_number_3" id="gform_target_page_number_3" value="0">
					<input type="hidden" class="gform_hidden" name="gform_source_page_number_3" id="gform_source_page_number_3" value="1">
					<input type="hidden" name="gform_field_values" value="">
				</div>
			</form>
		</div>
		<iframe style="display:none;width:0px;height:0px;" src="about:blank" name="gform_ajax_frame_3" id="gform_ajax_frame_3">This iframe contains the logic required to handle Ajax powered Gravity Forms.</iframe>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				// gformInitSpinner(3, 'http://cruisersnet-dev.net/wp-content/plugins/gravityforms/images/spinner.gif');
				jQuery('#gform_ajax_frame_3').on('load', function() {
					var contents = jQuery(this).contents().find('*').html();
					var is_postback = contents.indexOf('GF_AJAX_POSTBACK') >= 0;
					if (!is_postback) {
						return;
					}
					var form_content = jQuery(this).contents().find('#gform_wrapper_3');
					var is_confirmation = jQuery(this).contents().find('#gform_confirmation_wrapper_3').length > 0;
					var is_redirect = contents.indexOf('gformRedirect(){') >= 0;
					var is_form = form_content.length > 0 && !is_redirect && !is_confirmation;
					if (is_form) {
						jQuery('#gform_wrapper_3').html(form_content.html());
						if (form_content.hasClass('gform_validation_error')) {
							jQuery('#gform_wrapper_3').addClass('gform_validation_error');
						} else {
							jQuery('#gform_wrapper_3').removeClass('gform_validation_error');
						}
						setTimeout(function() { /* delay the scroll by 50 milliseconds to fix a bug in chrome */
							jQuery(document).scrollTop(jQuery('#gform_wrapper_3').offset().top);
						}, 50);
						if (window['gformInitDatepicker']) {
							gformInitDatepicker();
						}
						if (window['gformInitPriceFields']) {
							gformInitPriceFields();
						}
						var current_page = jQuery('#gform_source_page_number_3').val();
						// gformInitSpinner(3, 'http://cruisersnet-dev.net/wp-content/plugins/gravityforms/images/spinner.gif');
						jQuery(document).trigger('gform_page_loaded', [3, current_page]);
						window['gf_submitting_3'] = false;
					} else if (!is_redirect) {
						var confirmation_content = jQuery(this).contents().find('.GF_AJAX_POSTBACK').html();
						if (!confirmation_content) {
							confirmation_content = contents;
						}
						setTimeout(function() {
							jQuery('#gform_wrapper_3').replaceWith(confirmation_content);
							jQuery(document).scrollTop(jQuery('#gf_3').offset().top);
							jQuery(document).trigger('gform_confirmation_loaded', [3]);
							window['gf_submitting_3'] = false;
						}, 50);
					} else {
						jQuery('#gform_3').append(contents);
						if (window['gformRedirect']) {
							gformRedirect();
						}
					}
					jQuery(document).trigger('gform_post_render', [3, current_page]);
				});
			});
		</script>
		<script type="text/javascript">
			if (typeof gf_global == 'undefined') var gf_global = {
				"gf_currency_config": {
					"name": "U.S. Dollar",
					"symbol_left": "$",
					"symbol_right": "",
					"symbol_padding": "",
					"thousand_separator": ",",
					"decimal_separator": ".",
					"decimals": 2
				},
				"base_url": "http:\/\/cruisersnet-dev.net\/wp-content\/plugins\/gravityforms",
				"number_formats": [],
				"spinnerUrl": "http:\/\/cruisersnet-dev.net\/wp-content\/plugins\/gravityforms\/images\/spinner.gif"
			};
			jQuery(document).bind('gform_post_render', function(event, formId, currentPage) {
				if (formId == 3) {}
			});
			jQuery(document).bind('gform_post_conditional_logic', function(event, formId, fields, isInit) {});
		</script>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery(document).trigger('gform_post_render', [3, 1])
			});
		</script>
	</div>
	<!-- entry content end -->
</div>
