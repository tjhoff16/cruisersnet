<?php
    // echo "<?-- QUERY ";
    // print_r($wp_query);
    // echo "-->";
    $term =    $wp_query->queried_object;
    $term_id = is_object($term) ? $term->term_id : 0;
    $parent = is_object($term) ? $term->parent : 0;
    $region = "";
    if ( isset($_POST) ) {
        if ( isset($_POST['region']) ) $region=$_POST['region'];
    }
    
    if ($region==='vanc' || is_page('virginia-fuel-prices') || has_term(787,'cnet_regions_marinas') || $term_id == 787 || $parent == 787 || $term_id ==  649 || $term_id == 803 || in_category([
                          'va-to-nc-line',
                          'va-to-nc-line-cruising-news',
                          'lntm-va-to-nc-news',
                          'fuel-prices-va-to-nc-line',
                          'bridges-va-to-nc-line']
                    )) {
            echo adrotate_group('3');
            echo adrotate_group('4');
        } elseif ($region==='nc' || is_page('north-carolina-fuel-prices') || has_term(584,'cnet_regions_marinas') || $term_id == 95 || $parent == 95 ||
                  $term_id==90 || $term_id == 584 || $term_id == 650 || $term_id == 806 ||
                  $parent == 584 ||
                  in_category(array(
                                    'nc-southport-calabash',
                                    'nc-cape-fear-river',
                                    'nc-swan-point-snows-cut ',
                                    'nc-bogue-sound-new-river ',
                                    'nc-adams-creek-beaufort-morehead-city ',
                                    'nc-neuse-river ',
                                    'nc-goose-creek-bay-river',
                                    'nc-pamlico-river',
                                    'nc-alligator-river-pungo-river',
                                    'nc-crotoan-roanoke-pamlico-sound',
                                    'nc-albemarle-sound',
                                    'nc-dismal-swamp-rotue',
                                    'nc-virginia-cut',
                                    'nc-north-carolina',
                                    'anchorages-icw-nc-virginia-cut-route',
                                    'anchorages-north-carolina',
                                    '010-dismal-swamp-route-010-north-carolina-2',
                                    '010-north-carolina',
                                    '010-north-carolina-3',
                                    'bridges-north-carolina',
                                    'nc-aicw-problems',
                                    'lntm-nc-news',
                                    '020-nc-virginia-cut',
                                    '020-nc-nav-alerts',
                                    'ncanchorages-ablemarlesound',
                                    'anchorages-pamlico-crotoan-roanoke-sound',
                                    'anchorages-icw-alligator-river-pungo-river',
                                    'anchorages-pamlico-river',
                                    'anchorages-icw-goose-creek-bay-river',
                                    'anchorages-neuse-river',
                                    'anchorages-icw-adams-creek-beaufort-morehead-city',
                                    'anchorages-icw-bogue-sound-new-river',
                                    'anchorages-icw-swan-point-snows-cut',
                                    'ncanchorages-capefearriver',
                                    'anchorages-icw-southport-calabash',
                                    '030-albemarle-sound',
                                    '040-marinas-pamlico-crotoan-roanoke-sounds-off-the-aicw',
                                    '050-aicw-alligator-river-to-pungo-river',
                                    '060-pamlico-river-off-the-aicw',
                                    '080-neuse-river-clubfoot-creek-to-new-bern',
                                    '090-adams-creek-to-morehead-city-and-beaufort',
                                    '100-aicw-bogue-sound-to-new-river',
                                    '110-swan-point-to-snows-cut',
                                    '120-upper-cape-fear-river-off-the-aicw',
                                    '130-aicw-lower-cape-fear-river-to-calabash'
                                    ))
                  ) {
            echo adrotate_group('5');
            echo adrotate_group('6');
        } elseif ($region==='sc' || is_page('south-carolina-fuel-prices') || has_term(614,'cnet_regions_marinas') ||
                  $term_id == 614 || $parent == 614 || $term_id == 651 ||
                  in_category(array('south-carolina','sc-south-carolina','sc-calabash-socastee-bridge','sc-waccamaw-river-winyah-bay','sc-georgetown-winyah-peedee-black-river','sc-belle-isle-sullivans-island','sc-charleston-cooper-wando-ashley','sc-stono-north-edisto','sc-dawho-ashepoo-coosaw-cutoff','sc-coosaw-ladys-island-bridge','sc-beaufort','sc-beaufort-calibogue-hilton-head','sc-cooper-savannah','anchorages-south-carolina','anchorages-icw-calabash-socastee-bridge','anchorages-icw-waccamaw-river-point','anchorages-georgetown-winyah-peedee-black-river','anchorages-icw-belle-isle-sullivans-island','anchorages-charleston-cooper-wando-ashley','anchorages-icw-stono-edisto','anchorages-icw-dawho-ashepoo-coosaw-cutoff','anchorages-icw-coosaw-ladys-island-bridge','anchorages-beaufort','anchorages-icw-beaufort-calibogue-hilton-head','anchorages-icw-cooper-savannah','sc-marinas','marinas-sc-icw-calabash-socastee-bridge','marinas-sc-icw-waccamaw-river-point','marinas-sc-georgetown-winywah-peedee-black-river','marinas-sc-belle-sullivans','marinas-sc-charleston-cooper-wando-ashley','marinas-sc-icw-stono-edisto','marinas-sc-icw-dawho-ashepoo-coosaw','marinas-sc-icw-coosaw-ladys-island','marinas-sc-beaufort','marinas-sc-icw-beaufort-calibogue-hilton-head','marinas-sc-icw-cooper-river-savannah-river','sc-fuel-prices','bridges-south-carolina','sc-belle-isle-sullivans-ilsand','sc-chart-view-alerts','5-ashepoo-coosaw-cutoff-into-coosaw-river','intersection-of-wright-river-and-northern-fields-cut','sc-aicw-problems','ln-sc-news','south-carolina-marinas-alphabetical-index','south-carolina-lpg-cng-availability','lntm-sc-news'))
                  ) {
            echo adrotate_group('7');
            echo adrotate_group('8');
        } elseif ($region==='ga' || is_page('georgia-fuel-prices') || has_term(626,'cnet_regions_marinas') ||
                  $term_id == 626 || $parent == 626 || $term_id == 652 ||
                  in_category(array('georgia','ga-news-georgia','ga-news-savannah-river-to-savannah','ga-news-savannah-icw-crossing-hell-gate','ga-news-ogechee-st-simons-sound','ga-news-jekyll-creek-st-marys-river','anchorages-georgia','anchorages-savannah-river-to-savannah','anchorages-icw-elba-island-hell-gate','anchorages-icw-ogechee-st-simons','anchorages-icw-jekyll-creek-st-marys','marinas-georgia','marinas-ga-savannah-river-to-savannah','marinas-ga-icw-elba-island-hell-gate','marinas-ga-icw-ogechee-st-simons','marinas-ga-jekyll-creek','ga-fuel-prices','bridges-ga-bridges','ga-chart-view-alerts','6-fields-cut','7-hell-gate','8-little-mud-river','9-jekyll-creek','ga-aicw-problems','ln-ga-news','georgia-marinas-alphabetical-index','ga-lpg-cng-availability','lntm-ga-news'))
                  ) {
            echo adrotate_group('9');
            echo adrotate_group('10');
        } elseif ($region==='efl' || is_page(array('eastern-florida-fuel-prices','st-johns-fuel-prices')) || has_term(633,'cnet_regions_marinas') ||
                  $term_id == 633 || $parent == 633 || $term_id == 653 ||
                  in_category(array('eastern-florida','east-fl-eastern-florida','east-fl-st-marys-sisters-creek','east-fl-st-johns-jacksonville-palatka-sanford','east-fl-jacksonville-vilano','east-fl-st-augustine','east-fl-san-sebastian-daytona','east-fl-port-orange-haulover-canal','east-fl-northern-indian-river-titusville-melborne','east-fl-melbourne-beach-st-lucie-stuart','east-fl-great-pocket-palm-beach','east-fl-lantana-las-olas-boulevard','east-fl-fort-lauderdale','east-fl-everglades-miami-government','anchorages-eastern-florida','east-fl-st-johns-anchorages','anchorages-icw-st-marys-sisters-creek','anchorages-st-johns-river-mayport-jacksonville','anchorages-st-johns-ortega-palatka','anchorages-st-johns-river-devils-elbow-lake-george','anchorages-st-johns-river-astor-monroe','anchorages-icw-jacksonville-vilano-beach','anchorages-st-augustine','anchorage-icw-san-sebastian-daytona','anchorages-icw-port-orange-haulover-canal','anchorages-icw-northern-indian-titusville-melbourne','anchorages-icw-melbourne-beach-st-lucie-stuart','anchorages-icw-great-pocket-palm-beach','east-fl-lantana-las-olas-boulevard','anchorages-fort-lauderdale','anchorages-icw-everglades-miami-government','east-fl-marinas','marina-east-fl-st-marys-river-sisters-creek','east-fl-st-johns-river-marinas','marina-east-fl-jacksonville-beach-vilano-bridge','marina-east-fl-st-augustine','marina-east-fl-san-sebastian-daytona','marina-east-fl-port-orange-haulover','marina-east-fl-northern-indian-river-titusville-melbourne','marina-east-fl-melbourne-st-lucie-stuart','marina-east-fl-great-pocket-palm-beach','marina-east-fl-lantana-las-olas-boulevard','marina-east-fl-fort-lauderdale','marina-east-fl-everglades-miami-government','east-fl-fuel-prices','bridges-eastern-florida','east-fl-northern-indian-river-titusville-melbourne','east-fl-everglades-miami-government','st-johns-fuel-prices','ef-chart-view-alerts','intersection-of-aicw-and-mantanzas-inlet','ef-aicw-problems','ln-ef-news','eastern-florida-st-johns-river-marinas-alphabetical-index','e-florida-lpg-cng-availability','lntm-ef-news'))
                  ) {
            echo adrotate_group('11');
            echo adrotate_group('12');
        } elseif ($region==='fkeys' || is_page('keys-fuel-prices') || has_term(747,'cnet_regions_marinas') ||
                  $term_id == 747 || $parent == 747 || $term_id == 654 ||
                  in_category(array('florida-keys','keys-florida-keys','keys-inside-passage-dinner-key-jewfish','keys-inside-route-blackwater-tavernier','keys-florida-bay-cross-bank-channel-five','keys-florida-bay-old-dan-bank-moser','keys-hawk-channel-long-key-moser','keys-marathon-boot-key-harbor','marina-keys-routes-marathon-channel-five-sable','keys-back-route-marathon-key-west','keys-hawk-channel-sombrero-key-west-1','keys-key-west','keys-routes-dry-tortugas','all-florida-keys-anchorages','anchorages-dinner-key-coconut-grove-jewfish','anchorages-blackwater-tavernier','anchorages-hawk-channel-govt-inlet-tavernier','anchorages-cross-bank-channel-five','anchorages-hawk-channel-tavernier-key-channel-five','anchorages-old-dan-bank-moser-channel','anchorages-hawk-channel-long-key-moser-channel','anchorages-marathon-boot-key-harbor','anchorages-marathon-key-west','anchorages-hawk-channel-sombrero-key-west','key-west-anchorages','keys-marinas','marina-keys-florida-bay-blackwater-tavernier','marina-keys-hawk-government-tavernier','marina-keys-florida-bay-cross-bank-channel-five','marina-keys-hawk-tavernier-channel-five','marina-keys-florida-bay-old-dan-bank-moser','marina-keys-hawk-channel-long-key-moser','marina-keys-marathon-boot-key','marina-keys-back-route-marathon-key-west','marina-keys-hawk-sombrero-key-west','marina-keys-key-west','keys-fuel-prices','bridges-florida-keys','keys-hawk-channel-government-tavernier','keys-hawk-channel-tavernier-key-channel-five','flk-chart-view-alerts','ln-flk-news','florida-keys-marinas-alphabetical-index','fl-keys-lpgcng-availability','lntm-flk-news'))
                  ) {
            echo adrotate_group('13');
            echo adrotate_group('14');
        } elseif ($region==='wfl' || is_page('western-florida-fuel-prices') || has_term(760,'cnet_regions_marinas') ||
                  $term_id == 760 || $parent == 760 || $term_id == 655 ||
                  in_category(array('western-florida','west-fl-western-florida','west-fl-cape-sable-pavillion-key','west-fl-10000-indian-key-pass','west-fl-marco-island-naples','west-fl-gordon-fort-myers','west-fl-caloosahatchee-fort-myers','west-fl-icw-miserable-mile-gasparilla','west-fl-charlotte-harbor-punta-gorda','west-fl-icw-placida-venice','west-fl-icw-venice-tampa','west-fl-tampa-bay','west-fl-icw-boca-ciega-clearwater','west-fl-icw-dunedin-anclote-river','west-fl-big-bend-anclote-dog-carr','anchorages-western-florida','wf-anchorages-cape-sable-pavillion-key','wf-anchorages-10000-indian-everglades','wf-anchorages-marco-island-naples','wf-anchorages-gordon-pass-fort-myers-beach','wf-anchorages-caloohatchee-river-fort-myers','wf-anchorages-miserable-mile-gasparilla','wf-anchorages-charlotte-harbor-punta-gorda-peace','wf-anchorages-placida-venice','wf-anchorages-venice-anna-maria','wf-anchorages-tampa-bay','wf-anchorages-boca-ciega-clearwater','wf-anchorages-dunedin-anclote-tarpon','wf-anchorages-anclote-dog-carrabelle','west-fl-marinas','marina-west-fl-cape-sable-pavillion-key','marina-west-fl-10000-indian-key-pass','marina-west-fl-marco-island-nables','marina-west-fl-gordon-pass-fort-myers','marina-west-fl-caloosahatchee-fort-myers','marina-west-fl-icw-miserable-mile-gasparilla','marina-west-fl-charlotte-harbor-punta-gorda','marina-west-fl-icw-venice-tampa','marina-west-fl-tampa-bay','marina-west-fl-icw-boca-ciega-clearwater','marina-west-fl-icw-dunedin-ancolite','marina-west-fl-big-bend-region-ancolite-dog-carr','west-fl-fuel-prices','bridges-western-florida','wf-chart-view-alerts','ln-wf-news','western-florida-marinas-alphabetical-index','wf-lpgcng-availability','lntm-wf-news'))
                  ) {
            echo adrotate_group('15');
            echo adrotate_group('16');
        } elseif ($region==='okee' || $term_id == 656 || $term_id == 820 ||
                  in_category(array('okeechobee','content-okeechobee','lntm-okeechobee-news','bridges-okeechobee'))
                  ) {
            echo adrotate_group('17');
            echo adrotate_group('18');
        } elseif ($region==='ng' || $term_id == 799 || $term_id == 819 ||
                  in_category(array('northern-gulf','ngulf-northern-gulf','ngulf-carrabelle-apalachicola','ngulf-apalachicola-east','ngulf-panama-city-inlet-st-andrews','ngulf-hathaway-bridge-pensacol','ngulf-pensacola-inlet','ngulf-big-lagoon-mobile-bay','ngulf-mobile-bay-mobile','ngulf-pas-aux-herons-rigolets','ngulf-lake-pontchartrain-new-orleans','ngulf-mississippi-river-grand','bridges-northern-gulf','fuel-prices-at-panama-city-and-st-andrews-northern-gulf-icw','lntm-northern-gulf-news'))
                  ) {
            echo adrotate_group('19');
            echo adrotate_group('20');
        } elseif ($region==='bah' || in_category(['bahamas','bahamas-sub','bahamas-archives']) ) {
            echo adrotate_group('21');
            echo adrotate_group('22');
        } elseif (in_category(array('chartview','maps','florida-keys-maps','georgia-maps','north-carolina-maps','northeast-florida-maps','sourth-florida-maps','south-carolina-maps','southeast-florida-maps','southwest-florida-maps','north-carolina-maps','northeast-florida-maps','southeast-florida-maps','southwest-florida-maps')) || is_page(139916) || is_page_template('tmpl-chartview.php')) {
            echo adrotate_group('27');
            echo adrotate_group('28');
        } elseif ( in_category(['weather','photo-of-the-week','weather-sub', 'coastal-tides', 'local-forecasts', 'local-forecasts-rss', 'tidal-information']) ) {
            echo adrotate_group('23');
            echo adrotate_group('24');
        } else {
            echo adrotate_group('1') . adrotate_group('2') . adrotate_group('29');
        }
    ?>

