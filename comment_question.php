<div id='divComment' class="comment_div" title="Add your comment to this discussion"></div>
<div id="comment_box_div" class="comment-respond" style="display:none;">
  <h2 id='comment_title'>Add your comment to this discussion</h2>
  <form name="commentForm-__POSTID__" id="comments-form" class="comment-form"  >
    <span class="c-note">Your email address will not be published. Required fields are marked <span>(required)</span>. All "Comments/Reviews" submitted to the Cruisers' Net are reviewed by our editorial staff before being published.</span>
        <label class="required" for="comment_subject">Subject (required):</label>
            <input type="text" id="comment_subject" name="comment_subject___POSTID__" placeholder="Subject" required style="display: block; width: 100%;">
        <label class="required" for="comment_message">Message (required):</label>
            <textarea id="comment_message" name="comment_message___POSTID__" placeholder="Your Comments..." required></textarea>
        <label class="required" for="comment_name">Name (required):</label>
            <input type="text" id="comment_name" name="comment_name___POSTID__" placeholder="Full Name" autocomplete='name' required>
        <label class="required" for="comment_email">Email (required):</label>
            <input type="email" id="comment_email" name="comment_email___POSTID__" placeholder="Email" autocomplete='email' required>
        <label for="comment_url">Website</label>
            <input type="url" name="url" id="comment_url" placeholder="website">
    <p class="form-submit">
        <input  type="submit" class="comment_button" value="Submit News" onclick="return submitComment(__POSTID__, this)" />
        <input  type="reset"  class="comment_button" value="Clear Form">
        <button type="button" class="comment_button" onclick="javascript:cancelComment(__POSTID__)">Cancel</button>
        <input type="hidden" id="comment_post_ID" name="comment_post_ID" value="__POSTID__" />
        <input type="hidden" id="comment_parent" name="comment_parent" value="0" />
        <input type="hidden" id="akismet_comment_nonce" name="akismet_comment_nonce" value="9acb5e8736" />
        <input type="hidden" id="ak_js" name="ak_js" value="73" />
    </p>
  </form>
  <p class="akismet_comment_form_privacy_notice">This site uses Akismet to reduce spam. <a href="https://akismet.com/privacy/" target="_blank">Learn how your comment data is processed</a>.</p>
</div>
<!-- End of divComment -->
