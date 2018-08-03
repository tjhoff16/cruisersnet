<div class="col-xs-12" id='filter_div'>
  <?php
      $articles = ['all'=>'Articles: All', 'nalerts'=>'Nav Alerts', 'lntm'=>'Local Notice to Mariners', 'pareas'=>'Problem Areas'];
      $regions  = ['all'=>'Regions: All', 'vanc'=>'VA to NC', 'nc'=>'North Carolina', 'sc'=>'South Carolina',
                   'ga'=>'Georgia', 'efl'=>'Eastern Florida', 'fkeys'=>'Florida Keys', 'wfl'=>'Western Florida',
                   'okee'=>'Okeechobee Waterway', 'ng'=>'Northern Gulf', 'bah'=>'Bahamas'];
      $sorts    = ['date'=>"Sort: Date", 'cloc'=>"Current Location", 'sloc'=>"Select Location"];

      function genDropDown2($b_id,$data){
          $selectedKey = isset($_POST[$b_id]) ? $_POST[$b_id] : key( $data );
          $selectedText = $data[$selectedKey];
          $bnam = $b_id . '_button';
          $did = $b_id . '_div';
          echo "<div id='$did' class='w3-dropdown-hover ddowns '>\n";
          echo " <button type='button' id='$b_id' class='w3-button' name='$bnam' value='$selectedKey'>$selectedText
          <span class='caret'></span></button>\n";
          echo " <div class='w3-dropdown-content w3-bar-block w3-border'>\n";
          foreach ($data as $val => $text)
                echo "  <button class='w3-bar-item w3-button' value='$val' onclick='cchoice(\"#$b_id\")'>$text</button>\n";
          echo " </div>\n";
          echo "</div>\n";
      }

      genDropDown2('article',$articles);
      genDropDown2('region',$regions);
      genDropDown2('sort',$sorts);
  ?>
  <div id="curr_lat_lng">
  </div>
  <div style="display:inline;">
  <button class="comment_button" onclick="applyFilters(<?php echo $paged;?>)">Filter Articles</button>
  </div>
  </div>
