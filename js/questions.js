// https://webdesign.tutsplus.com/tutorials/native-popups-and-modals-with-the-html5-dialog-element--cms-23876
// Files used: /wp-content/themes/CruisersNet/part-home_top.php
//             /wp-content/themes/CruisersNet/js/questions.js
//             /wp-content/themes/CruisersNet/includes/answer.php
//             /wp-content/themes/CruisersNet/includes/get_question.php
//             /wp-content/themes/CruisersNet/includes/test_questions.php
//
const TO_NAME = 1;
const TO_ABBREVIATED = 2;
var nCookie = 'nCookie'; // Tracking newsletter question
var qCookie = 'qCookie'; // Tracking general question
var dialogDiv = "#divDialog";
var newsletterDiv = "#divNewsletter";
var commentDiv = "#divComment";
var responseDiv = "#comment_box_div";
var openArticle = "";
var previousOpenArticle = "";
var currentInlineDiv = "";
var testInline = false;
var geolocation = {};
var history = new Array();
var clickingForSelectedLocation = false;
history[0] = {
  "path": "/",
  "search": "",
  "lat": 0,
  "lng": 0,
  "slat": 0,
  "slng": 0,
  "paged": ""
};
var historyIndex = 0;
var selectedlocation = {
  lat: Number(0),
  lng: Number(0),
  city: "Unknown",
  state: "Unknown",
  source: "selected"
};
// Myrtle Beach for selectedlocation testing
/*selectedlocation = {
  lat: Number(33.689101),
  lng: Number(-78.886702),
  city: "Myrtle Beach",
  state: "SC",
  source: "selected"
};
 */

if (window.addEventListener) { // all browsers except IE before version 9
  window.addEventListener("beforeunload", OnBeforeUnLoad, false);
} else {
  if (window.attachEvent) { // IE before version 9
    window.attachEvent("onbeforeunload", OnBeforeUnLoad);
  }
}

// the OnBeforeUnLoad method will only be called in Google Chrome and Safari
function OnBeforeUnLoad() {
  return "All data that you have entered will be lost!";
}

//
// Capture back button press
// From: https://stackoverflow.com/questions/6359327/detect-back-button-click-in-browser
//
if (window.history && window.history.pushState) {
  jQuery(window).on('popstate', function() {
    var hashLocation = location.hash;
    var hashSplit = hashLocation.split("#!/");
    var hashName = hashSplit[1];
    if (hashName !== '') {
      var hash = window.location.hash;
      if (hash === '') {
        alert('Back button was pressed.');
        window.history.pushState('forward', null, './#forward');
      }
    }
  });
  // Maybe window.history.pushState('forward', null, './#forward');
}

getLocation();

jQuery(document).ready(function() {
  // Catch page change and go to page based on page-numbers class click
  jQuery('.page-numbers').click(function() {
    applyFilters(event.target.text);
    return false;
  });
  // Catch page change and go to page
  //jQuery('.menu-item-type-custom').click(function(event) {
  //  return processClick(event);
  // });
  jQuery("a").click(function(event) {
    return processClick(event);
  });

  window.onclick = function(e) {
    var href = jQuery(this).attr('href');
    return processClick(event);
  };

  initializeQuestions();
  // For testing
  //changeDivDisplay('#divQ1',     'inline-block');
  //changeDivDisplay('#divQ2',     'inline-block');
  //changeDivDisplay('#divQ3',     'inline-block');
  //changeDivDisplay(dialogDiv,     'inline-block');
  //changeDivDisplay(newsletterDiv, 'inline-block');

  updateDistances();

  jQuery(".collapseomatic_content").css('display', 'block');

  var sortvalue = jQuery('#sort').attr("value");
  if (sortvalue === 'cloc') showLatLng(geolocation);
  if (sortvalue === 'sloc') showLatLng(selectedlocation);
});

function processClick(event) {
  var target = event.target;
  //
  //  Catch the back button
  //
  if (event.target.localName === "button" && event.target.innerText === "Back") {
    goBack();
    return false;
  }
  //
  //  Try to find the an a selector in the event chain
  //
  if (typeof event.target.pathname === 'undefined') {
    var findtarget = findAncestor(target, "a");
    if (findtarget == null) return true;
    target = findtarget;
  }
  if (typeof target === "undefined")
    return true;
  if (target.nodeName.toUpperCase() !== 'A' && !target.href)
    return true;
  //
  //  Force non CruisersNet href's to new window
  //
  var hnuc = target.hostname.toUpperCase();
  if (hnuc != "CRUISERSNET.NET" && hnuc != "WWW.CRUISERSNET.NET" &&
    hnuc != "CRUISERSNET-DEV.NET" && hnuc != "WWW.CRUISERSNET-DEV.NET") {
    target.target = '_blank';
    return true;
  }
  //
  //  See if this is a new page request for the current data
  //
  if (target.className.indexOf('page-numbers') !== -1) {
    var className = target.className;
    var currentArgs = history[historyIndex];
    var currentPage = Number(currentArgs.paged);
    var newPage = 0;
    if (className.indexOf('next') !== -1) newPage = currentPage + 1;
    else if (className.indexOf('previous') !== -1) newPage = currentPage - 1;
    else newPage = Number(target.innerText);
    if (isNaN(newPage)) return false;
    currentArgs.paged = newPage;
    updateContent(currentArgs);
    return false;
  }
    //
    //
    var path = target.pathname;
    var search = target.search;
    var hash = target.hash;
    //
    //  Catch Various CruisersNet Stuff
    //
  if (path.toUpperCase() === '/CRUISERSNET-MARINE-MAP/') {
    showChartView();
    goToSearchLocation(search);
    return false;
  } else if (path.toUpperCase() === '/category/photo-of-the-week/'.toUpperCase() ) {
      applyPath('/category/shared-photos/', '', 0);
      return false;
  } else if ( hash === '#respond' ) {
      alert("Need to program comment Respond");
      return false;
  } else if ( path.includes("wp-admin") || path.includes("wp-login") ) {
    return true;  // For admin functions
  } else if (path !== "") {
    changeDivDisplay("#chartview", "none");
    changeDivDisplay("#row", "inline");
    goToDivByScroll("#row", jQuery("#row").height() + 20);
    applyPath(path, search, 0);
    return false;
  }
  return true;
}


//function findAncestor (el, sel) {
//    while ((el = el.parentElement) && !((el.matches || el.matchesSelector).call(el,sel)));
//    return el;
//}

function findAncestor(el, cls) {
  //while ((el = el.parentNode) && el.className.indexOf(cls) < 0);
  while (el.parentNode != null) {
    el = el.parentNode;
    if (el.localName === cls)
      return el;
  }
  return null;
}

function initializeQuestions() {
  // Newsletter Cookie DOES NOT EXIST so show Newsletter question
  if (readCookie(nCookie) === null) {
    openDialog('1', jQuery("#divQ1").html());
  } else {
    if (jQuery("#qNumber").length) openDialog(jQuery('#qNumber').val(), jQuery("#divQ3").html());
  }
  //
  // Hide after 10 seconds if q1 still showing since probably not being acted upon by user
  //
  //var hide = setTimeout(function() {
  //                        if ( jQuery('#q1').css("display") === 'block' || jQuery('#q3').css("display") === 'block' ) hideQuestions();
  //                        }, 20000);
}

function openDialog(num, html) {
  openDialogFullControl(num, dialogDiv, '', html, true, 600, 300);
}

function openDialogFullControl(num, divForInline, title, html, hideClose, maxWidth, maxHeight) {
  if (html == null || num == null) {
    myLog("*** WARNING num or html is null:" + num + "/" + html);
    return;
  }
  html = html.replace(/\s+/g, ' ').trim(); // Clean up html
  qNumber = num;
  //
  //  Disable Question Capability!!!!
  //
  // jQuery(dialogDiv).remove();
  // return;
  //
  // For testing
  //
  //jQuery.getJSON('//freegeoip.net/json/?callback=?', function(data) {
  //               myLog(JSON.stringify(data, null, 2));
  //               if ( data["ip"] == "24.128.225.215" ) ...;
  //          });
  //
  //  If Dialogs are allowed
  //
  if (useDialog()) {
    jQuery(dialogDiv).dialog({
      resizable: false,
      autoOpen: false,
      show: {
        effect: "fade",
        duration: 1000
      },
      hide: {
        effect: "fade",
        duration: 500
      },
      modal: true,
      maxWidth: maxWidth,
      maxHeight: maxHeight,
      width: maxWidth,
      height: 'auto',
      title: title
      //buttons: { ok: function() { jQuery(this).dialog('close'); } //end cancel button
      //}//end buttons
    }); //end dialog
    if (title === '') jQuery(".ui-dialog-titlebar").hide();
    jQuery(dialogDiv).html(html);
    if (hideClose) jQuery(dialogDiv).closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
    jQuery(dialogDiv).dialog('open');
  } else {
    //
    //  Dialog functionality is unavailable
    //
    if (divForInline != currentInlineDiv && currentInlineDiv != "") closeInlineDiv();
    if (title !== '') html = '<h2 class=".entry-title">' + title + '</h2>' + html;
    jQuery(divForInline).html(html);
    changeDivDisplay(divForInline, "inline-block");
    jQuery(divForInline).css({
      "margin-right": "10px",
      "margin-left": "10px",
      "margin-top": "20px",
      "margin-bottom": "20px",
      "height": "auto"
    });
    goToDivByScroll(divForInline, 150);
    currentInlineDiv = divForInline;
  }
}

function goToDivByScrollDelay(divToScrollTo, offset, delay) {
  setTimeout(function() {
    goToDivByScroll(divToScrollTo, offset);
  }, delay);
}

function goToDivByScroll(divToScrollTo, offset) {
  var top = (jQuery(divToScrollTo).offset() || {
    "top": NaN
  }).top;
  if (isNaN(top)) {
    // alert("No offset top for: " + divToScrollTo);
    return;
  }
  jQuery('html,body').animate({
    scrollTop: jQuery(divToScrollTo).offset().top - offset
  }, 'slow');
}

function openCommentGeneral() { // This if for generic comments
  openComment(-1);
}

function newsletterTaskDirect() {
  openDialogFullControl(-1, dialogDiv, 'Cruisers\' Net Newsletter', getModifiedNewsletterHTML(), false, 525, 710);
}

function newsletterTask(qNumber, qSnippet, qAnswer) {
  //  Log question and answer to database
  logAnswer(qNumber, qSnippet, qAnswer);
  switch (qAnswer) {
    case 'NoReceive': // Do not receive Newsletter - show next question
      //var hide = setTimeout(function() { jQuery("#divDialog").dialog('close'); }, 10000);
      qNumber = 2;
      jQuery(dialogDiv).html("<div id='effect' class='ui-widget-content ui-corner-all'>" + jQuery("#divQ2").html() + "</div>");
      return;
    case 'Receive': // Yes, currently receives newsletter - ask again in 180 days
      createCookie(nCookie, 'yes', 180);
      break;
    case 'Want': // Wants to receive newsletter - Sign Them Up but check again in 45 days to make sure
      createCookie(nCookie, 'yes', 45);
      closeDialog();
      newsletterTaskDirect();
      return;
    case 'Nope': // Does not want newsletter - ask again in 90 days
      createCookie(nCookie, 'no', 90);
      break;
    case 'NotNow': // Not now - ask again in 30 days
      createCookie(nCookie, 'no', 30);
      break;
    default:
      var msg = '*** UNKNOWN ANSWER: ' + qAnswer;
      myLog(msg);
      logAnswer('-1', '*** ERROR ***', msg);
      break;
  }
  closeDialog();
}

function getModifiedNewsletterHTML() {
  var newsletterHTML = jQuery(divNewsletter).html();
  var originalText = '<button data-qe-id="form-button" type="submit" class="ctct-form-button">Sign Up!</button>';
  //var replacementText = originalText +
  //'</br><button data-qe-id="form-button" type="button" class="ctct-form-button" onclick="javascript:closeDialog()">Cancel</button>';
  // '<input data-qe-id="form-button" type="submit" class="submit" value="Sign Up!" />' +
  var replacementText =
    '<button type="submit" class="comment_button" data-qe-id="form-button"          > Sign Up! </button>' +
    '&nbsp;&nbsp;' +
    '<button type="button" class="comment_button" onclick="javascript:closeDialog()"> Cancel   </button>';
  newsletterHTML = newsletterHTML.replace(originalText, replacementText);
  return newsletterHTML;
}

function getFormData() {
  var qNumber = jQuery("#qNumber").length ? jQuery('#qNumber').val() : '-1'; // Retrieved from form
  var qSnippet = jQuery("#qSnippet").length ? jQuery('#qSnippet').val() : 'Unknown'; // Retrieved from form
  var qAnswer = '';
  // Only one type of answer type can be defined
  if (jQuery("#tanswer").length) { // Input text box
    qAnswer = jQuery('#tanswer').val();
  } else if (jQuery("#oanswer").length) { // List of options
    qAnswer = jQuery('#oanswer').val();
  } else { // Radio buttons
    qAnswer = jQuery('.ranswer:checked').val();
  }
  // To strip tage: .replace(/<(?:.|\n)*?>/gm, '');
  logAnswer(qNumber, qSnippet, qAnswer);
  createCookie(qCookie, qNumber, 10 * 365); // Set out 10 years
  closeDialog();
}

function cancelComment(postID) {
  closeComment(postID);
}

function openComment(post_id) {
  var commentHTML = jQuery(commentDiv).html();
  var html = jQuery(responseDiv).html();
  html = html.replace(/__POSTID__/g, post_id);
  // post_id==-1 is for a generic comment, otherwise for specific post
  var divForComment = post_id == -1 ? divDialog : '#comment-' + post_id;
  openDialogFullControl(-1, divForComment, 'Contribute Cruising News', html, true, 600, 675);
}

function submitComment(postID, thisComment) {
  // var form = thisComment.form;
  var forms = jQuery('form[name="commentForm-' + postID + '"]');
  var form = forms[0];
  var formElements = form.elements;
  commentData = {}; // Needs to be global?
  for (var i = 0; i < formElements.length; i++)
    if (formElements[i].type != "submit")
      commentData[formElements[i].id] = formElements[i].value; // commentData[formElements[i].name]=formElements[i].value;
  jQuery.ajax({
    type: "POST",
    dataType: "json",
    url: '/wp-content/themes/CruisersNet/includes/addComment.php',
    data: commentData,
    success: function(data) {
      if (data.commentSubmitStatus !== undefined) {
        alert('Your comment has been sucessfully ' + data.commentType + '.  Thank you.');
      } else {
        alert('Error Occured Submiting your Comment - please email your comment to contact@cruisersnet.net\n\nError Message:\n ' + JSON.stringify(data));
      }
    },
    error: function(jqxhr, errorText, errorThrown) {
      if (jqxhr == 'undefined' || jqxhr == undefined) {
        alert('Error Occured Submiting your Comment - please email your comment to contact@cruisersnet.net\n\nError Message: UNDEFINED');
      } else if (jqxhr.status == 403 || jqxhr.status == 500) {
        alert('Error Occured Submiting your Comment - please email your comment to contact@cruisersnet.net\n\nError Code: '+jqxhr.status+'\n'+errorCode2Text(jqxhr.status) );
      } else {
        alert('Error Occured Submiting your Comment - please email your comment to contact@cruisersnet.net\n\nError Message: ' + errorThrown.message + '\n' + jqxhr.responseText + '\n\nError Code: '+jqxhr.status+'\n'+errorCode2Text(jqxhr.status) );
      }
    },
    complete: function(data) {
      closeComment(postID);
    }
  });
  return false;
}

function closeComment(postID) {
  if (postID > 0) goToDivByScroll('#fullarticle-' + postID, 100);
  closeDialog();
}

function closeDialog() {
  if (useDialog()) {
    if (!jQuery(dialogDiv).hasClass('ui-dialog-content')) {
      myLog("WARNING: Dislog Div is not right - unable to Close/Destroy");
      return;
    }
    if (jQuery(dialogDiv).dialog('isOpen')) jQuery(dialogDiv).dialog('close');
    jQuery(dialogDiv).dialog('destroy');
  } else {
    closeInlineDiv();
  }
}
//
//  Article/Preview Open/Close
//
function openFullArticle(post_id) {
  closeInlineDiv();
  if (openArticle !== '') closeFullArticle(openArticle);
  if (previousOpenArticle !== '') {
    var previousPostClass = jQuery('.post-' + previousOpenArticle);
    previousPostClass.css({
      "borderWidth": "1pt",
      "borderColor": "#e5e5e5"
    });
    previousOpenArticle = '';
  }
  //  Load article Chartviews
  // var chartletDefer = document.getElementsByClassName('chartlet-iframe');
  var chartletDefer = jQuery("#fullarticle-" + post_id + " iframe.chartlet-iframe");
  for (var i = 0; i < chartletDefer.length; i++) {
    var datasrc = chartletDefer[i].getAttribute('data-src');
    var src = chartletDefer[i].getAttribute('src');
    if (datasrc && src == '') chartletDefer[i].setAttribute('src', datasrc);
  }
  changeDivDisplay('#preview-' + post_id, 'none');
  changeDivDisplay('#fullarticle-' + post_id, 'inline');
  openArticle = post_id;
  var postClass = jQuery('.post-' + post_id);
  postClass.css({
    "borderWidth": "1.5pt",
    "borderColor": "black"
  });
  goToDivByScrollDelay('#fullarticle-' + post_id, 100, 100);
}

function closeFullArticle(post_id) {
  previousOpenArticle = post_id;
  closeInlineDiv();
  changeDivDisplay('#fullarticle-' + post_id, 'none');
  changeDivDisplay('#preview-' + post_id, 'inline');
  previousOpenArticle = post_id;
  openArticle = "";
  // Remains Highlit until another article is selected
  // var postClass = jQuery('.post-' + post_id);
  // postClass.css("borderWidth", "1pt");
  // postClass.css("borderColor", "#e5e5e5");
  goToDivByScrollDelay('#preview-' + post_id, 100, 100);
}

function manipArticle(post_id, icon) {

  if (jQuery(icon).hasClass("fa-compress")) {
    jQuery(icon).removeClass("fa-compress").addClass("fa-expand");
    jQuery(icon).attr({
      "title": "Expand this article"
    });
    closeFullArticle(post_id);
  } else if (jQuery(icon).hasClass("fa-expand")) {
    jQuery(icon).removeClass("fa-expand").addClass("fa-compress");
    openFullArticle(post_id);
    jQuery(icon).attr({
      "title": "Close this article"
    });
  }
}

function closeInlineDiv() {
  if (currentInlineDiv != "") changeDivDisplay(currentInlineDiv, "none");
  currentInlineDiv = "";
}
//
//  Cookie Functions
//
function createCookie(name, value, days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
  } else expires = "";
  document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

function eraseCookie(name) {
  createCookie(name, "", -1);
}
//
//  Utility Functions
//
function useDialog() {
  if (testInline) return false;
  if (typeof HTMLDialogElement === 'function') return true;
  return false;
}

function changeDivDisplay(divName, how) {
  if (jQuery(divName).length) {
    jQuery(divName).css("display", how);
    jQuery(divName).find('i').css({
      'display': 'inline'
    });
    return;
  }
  myLog("Note: Div: " + divName + " does not exist so display cannot be changed to: " + how);
}

function resetQuestions() {
  eraseCookie(nCookie);
  eraseCookie(qCookie);
  location.reload(true);
}

function myLog(text) {
  if (window.console) console.log(text);
}

function logAnswer(qnumber, snippet, answer) {
  jQuery.ajax({
    url: '/wp-content/themes/CruisersNet/includes/answer.php',
    type: "POST",
    data: {
      qnumber: qnumber,
      snippet: snippet,
      answer: answer
    },
    success: function(data) {
      //myLog(data);
      //alert(data);
    },
    error: function(jqxhr, errorText, errorThrown) {
        if (jqxhr == 'undefined' || jqxhr == undefined) {
          myLog('Error occured in logAnswer - \n\nError Message: UNDEFINED');
        } else if (jqxhr.status == 403 || jqxhr.status == 500) {
          myLog('Error occured in logAnswer - \n\nError Code: '+jqxhr.status+'\n'+errorCode2Text(jqxhr.status));
        } else {
          myLog('Error occured in logAnswer\n\nError Message: ' + errorThrown.message + '\n' + jqxhr.responseText + '\n\nError Code: '+jqxhr.status+'\n'+errorCode2Text(jqxhr.status) );
        }
    }
  });
}

function updateDistances() {
  jQuery('span[class="post-latlng"]').each(function(index, item) {
    var latlngSplit = item.textContent.split(",");
    var unit = 'nm';
    if (typeof geolocation.lat === "undefined" || typeof geolocation.lng === "undefined") {
      myLog("Unable to update distance by browser geolocation does not exist.");
      // Get location by IP or simply do nothing
    } else {
      var postDistance = haversine(geolocation.lat, geolocation.lng, latlngSplit[0], latlngSplit[1], unit);
      jQuery(item.id.replace("latlng", "#distance")).text(myRoundNumber(postDistance) + ' ' + unit);
    }
  });
}

function myRoundNumber(numb) {
  if (typeof(numb) == 'string' || numb instanceof String) numb = parseFloat(numb);
  var digits = 2;
  if (Math.abs(numb) > 1) digits = 1;
  if (Math.abs(numb) > 100) digits = 0;
  return numb.toFixed(digits); //  +numb.toFixed(digits) will strip any trailing 0
}

function haversine(lat1, lng1, lat2, lng2, unit) {
  // Converts degrees to Rads
  if (typeof(Number.prototype.toRad) === "undefined") {
    Number.prototype.toRad = function() {
      return this * Math.PI / 180;
    };
  }
  var R = '6371'; // Defaults to km
  if (unit == 'mi') R = 3959;
  if (unit == 'nm') R = 3959 / 1.15078;
  var dLat = (parseFloat(lat2) - parseFloat(lat1)).toRad();
  var dLon = (parseFloat(lng2) - parseFloat(lng1)).toRad();
  lat1 = parseFloat(lat1).toRad();
  lat2 = parseFloat(lat2).toRad();
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c;
  return d;
}

function printLocation() {
  if (typeof geolocation.lat === "undefined" || typeof geolocation.lng === "undefined") {
    myLog("Unable to get location by browser geolocation does not exist.");
    // Get location by IP or simply do nothing
  } else {
    myLog("LATITUDE => " + geolocation.lat);
    myLog("LONGITUDE => " + geolocation.lng);
  }
}

function getLocation() {
  getLocationByIP();
  // If the user allow us to get the location from the browser
  if (window.location.protocol != "https:") return;
  if (!navigator.geolocation) return;
  navigator.geolocation.getCurrentPosition(
    // Success Callback
    function(position) {
      geolocation = {
        lat: Number(position.coords.latitude),
        lng: Number(position.coords.longitude),
        source: "navigator"
      };
      geocodeLatLng(geolocation, "current");
    },
    // Error Callback - 1 - PERMISSION_DENIED, 2 - POSITION_UNAVAILABLE, 3 - TIMEOUT
    function(error) {
      myLog("Error getting navigator.geolocation - code: " + error.code);
    }
  );
}

function geocodeLatLng(alocation, locationType, show) {
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({
    'location': alocation
  }, function(results, status) {
    var city = 'Unknown';
    var state = 'Unknown';
    if (status === 'OK') {
      if (results[0]) {
        city = extractFromAdress(results[0].address_components, "locality");
        state = extractFromAdress(results[0].address_components, "administrative_area_level_1");
      } else {
        myLog('No Geocoder results for: ' + alocation.lat + ', ' + alocation.lng);
      }
    } else {
      myLog('Geocoder failed due to: ' + status);
    }
    if (locationType === 'current') {
      geolocation.city = city;
      geolocation.state = state;
      if (show) showLatLng(selectedlocation);
    } else if (locationType === 'selected') {
      selectedlocation.city = city;
      selectedlocation.state = state;
      if (show) showLatLng(selectedlocation);
    } else {
      myLog('Unknown location type: ' + locationType);
    }
  });
}

function extractFromAdress(components, type) {
  for (var i = 0; i < components.length; i++)
    for (var j = 0; j < components[i].types.length; j++)
      if (components[i].types[j] == type) return components[i].long_name;
  return "Unknown";
}

function getLocationByIP() {
  jQuery.getJSON("https://cruisersnet.net/wp-content/themes/CruisersNet/ip2location.php")
    .done(function(json) {
      if (typeof geolocation.lat === "undefined" || typeof geolocation.lng === "undefined")
        geolocation = {
          lat: Number(json.geobyteslatitude),
          lng: Number(json.geobyteslongitude),
          city: json.geobytescity,
          state: json.geobytescode,
          ip: json.geobytesremoteip,
          source: "ip"
        };
    })
    .fail(function(jqxhr, textStatus, error) {
      var err = textStatus + ", " + error;
      console.log("Request Failed: " + err);
    });
}

function showComments(postID) {
    applyPath('/'+postID, '', 0);
}

function applyFilters(page) {
  var params = {
    "article": jQuery('#article').attr("value"),
    "region": jQuery('#region').attr("value"),
    "sort": jQuery('#sort').attr("value"),
    "lat": geolocation.lat,
    "lng": geolocation.lng,
    "slat": selectedlocation.lat,
    "slng": selectedlocation.lng,
    "paged": page
  };
  updateContent(params);
}

function applyPath(pathToGet, search, page) {
  var params = {
    "path": pathToGet,
    "search": search,
    "lat": geolocation.lat,
    "lng": geolocation.lng,
    "slat": selectedlocation.lat,
    "slng": selectedlocation.lng,
    "paged": page
  };
  updateContent(params);
}

function updateContent(params) {
  historyIndex++;
  history[historyIndex] = params;
  //
  //  Update Content
  //
  var headerLow = jQuery("#header-low");
  var articlesList = jQuery("#article-list-wrapper");
  changeDivDisplay("#spinner", "block");
  jQuery.ajax({
    url: 'https://CruisersNet.net/wp-content/themes/CruisersNet/filter_content.php',
    type: "POST",
    data: params,
    complete: function() {
      setTimeout(function() {
        var logo_height = jQuery(".ads_top_row").css('height');
        jQuery(".header-mid").css("height", logo_height);
        if (parseInt(logo_height) < 270) {
          logo_height = 270;
        }
      }, 125);

      if (jQuery('#header-low .g').length === 1) {
        jQuery('.g').css({
          'margin-top': "66px"
        });
      }
      // myLog(this.url);
    },
    success: function(data) {
      changeDivDisplay("#spinner", "none");
      var parts = data.split("<!-- NEW FILTERED ARTICLES -->");
      headerLow.replaceWith(parts[0]);
      articlesList.replaceWith(parts[1]);
      // jQuery("#loader").css({
      //   "height": "150px",
      //   "width": "150px",
      //   "position": "fixed",
      //   "left": "50%",
      //   "right": "50%"
      // });
    },
    error: function(jqxhr, errorText, errorThrown) {
        changeDivDisplay("#spinner", "none");
        if (jqxhr == 'undefined' || jqxhr == undefined) {
            alert('Server Error - \n\nError Message: UNDEFINED');
        } else if (jqxhr.status == 403 || jqxhr.status == 500) {
            alert('Server Error - \n\nError Code: '+jqxhr.status+'\n'+errorCode2Text(jqxhr.status));
        } else  {
            alert('Server Error\n\nError Message: ' + errorThrown.message + '\n' + jqxhr.responseText + '\n\nError Code: '+jqxhr.status+'\n'+errorCode2Text(jqxhr.status) );
        }
    }
  });
}

function goBack() {
  historyIndex--;
  var previousParams = history[historyIndex];
  historyIndex--;
  updateContent(previousParams);
}

function cchoice(buttonid) {
  var clicked_button_text = jQuery(event.target).text();
  var clicked_button_val = jQuery(event.target).attr("value");
  if (clicked_button_val === 'okee') {
    clicked_button_text = 'Okeechobee';
  } else if (clicked_button_val === 'lntm') {
    clicked_button_text = 'Local Notices';
  } else if (clicked_button_val === 'cloc') {
    showLatLng(geolocation);
  } else if (clicked_button_val === 'sloc') {
    clickingForSelectedLocation = true;
    showChartView();
    showLatLng(selectedlocation);
  } else if (clicked_button_val === "date") {
    jQuery('#curr_lat_lng').css('visibility', 'hidden');
  }
  jQuery(buttonid).val(clicked_button_val);
  jQuery(buttonid).text(clicked_button_text);
}

function showLatLng(location) {
  jQuery("#curr_lat_lng").text(location.lat.toFixed(4) + ", " + location.lng.toFixed(4));
  jQuery("#curr_lat_lng").append("</br>");
  jQuery("#curr_lat_lng").append(location.city + ", " + convertRegion(location.state, TO_ABBREVIATED));
  jQuery('#curr_lat_lng').css({
    'visibility': 'visible',
    'display': 'inline-block'
  });
}

function showChartView() {
  closeInlineDiv();
  if (mapInst == null) loadChartview();
  changeDivDisplay("#chartview", "inline");
  changeDivDisplay("#row", "none");
  goToDivByScroll("#chartviewBackButton", jQuery("#chartviewBackButton").height() + 20);
}

function closeChartview() {
  changeDivDisplay("#chartview", "none");
  changeDivDisplay("#row", "inline");
  // Scroll to the open article
  if (openArticle !== "") goToDivByScrollDelay('#fullarticle-' + openArticle, 100, 100);
}

function convertRegion(input, to) {
  var states = [
    ['Alabama', 'AL'],
    ['Alaska', 'AK'],
    ['American Samoa', 'AS'],
    ['Arizona', 'AZ'],
    ['Arkansas', 'AR'],
    ['Armed Forces Americas', 'AA'],
    ['Armed Forces Europe', 'AE'],
    ['Armed Forces Pacific', 'AP'],
    ['California', 'CA'],
    ['Colorado', 'CO'],
    ['Connecticut', 'CT'],
    ['Delaware', 'DE'],
    ['District Of Columbia', 'DC'],
    ['Florida', 'FL'],
    ['Georgia', 'GA'],
    ['Guam', 'GU'],
    ['Hawaii', 'HI'],
    ['Idaho', 'ID'],
    ['Illinois', 'IL'],
    ['Indiana', 'IN'],
    ['Iowa', 'IA'],
    ['Kansas', 'KS'],
    ['Kentucky', 'KY'],
    ['Louisiana', 'LA'],
    ['Maine', 'ME'],
    ['Marshall Islands', 'MH'],
    ['Maryland', 'MD'],
    ['Massachusetts', 'MA'],
    ['Michigan', 'MI'],
    ['Minnesota', 'MN'],
    ['Mississippi', 'MS'],
    ['Missouri', 'MO'],
    ['Montana', 'MT'],
    ['Nebraska', 'NE'],
    ['Nevada', 'NV'],
    ['New Hampshire', 'NH'],
    ['New Jersey', 'NJ'],
    ['New Mexico', 'NM'],
    ['New York', 'NY'],
    ['North Carolina', 'NC'],
    ['North Dakota', 'ND'],
    ['Northern Mariana Islands', 'NP'],
    ['Ohio', 'OH'],
    ['Oklahoma', 'OK'],
    ['Oregon', 'OR'],
    ['Pennsylvania', 'PA'],
    ['Puerto Rico', 'PR'],
    ['Rhode Island', 'RI'],
    ['South Carolina', 'SC'],
    ['South Dakota', 'SD'],
    ['Tennessee', 'TN'],
    ['Texas', 'TX'],
    ['US Virgin Islands', 'VI'],
    ['Utah', 'UT'],
    ['Vermont', 'VT'],
    ['Virginia', 'VA'],
    ['Washington', 'WA'],
    ['West Virginia', 'WV'],
    ['Wisconsin', 'WI'],
    ['Wyoming', 'WY'],
  ];

  // So happy that Canada and the US have distinct abbreviations
  var provinces = [
    ['Alberta', 'AB'],
    ['British Columbia', 'BC'],
    ['Manitoba', 'MB'],
    ['New Brunswick', 'NB'],
    ['Newfoundland', 'NF'],
    ['Northwest Territory', 'NT'],
    ['Nova Scotia', 'NS'],
    ['Nunavut', 'NU'],
    ['Ontario', 'ON'],
    ['Prince Edward Island', 'PE'],
    ['Quebec', 'QC'],
    ['Saskatchewan', 'SK'],
    ['Yukon', 'YT'],
  ];

  var regions = states.concat(provinces);

  var i; // Reusable loop variable
  if (to == TO_ABBREVIATED) {
    input = input.replace(/\w\S*/g, function(txt) {
      return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
    for (i = 0; i < regions.length; i++) {
      if (regions[i][0] == input) {
        return (regions[i][1]);
      }
    }
  } else if (to == TO_NAME) {
    input = input.toUpperCase();
    for (i = 0; i < regions.length; i++) {
      if (regions[i][1] == input) {
        return (regions[i][0]);
      }
    }
  }
}

function errorCode2Text(code) {
    if ( code==100 ) return "Continue    The server has received the request headers, and the client should proceed to send the request body";
    if ( code==101 ) return "Switching Protocols    The requester has asked the server to switch protocols";
    if ( code==103 ) return "Checkpoint    Used in the resumable requests proposal to resume aborted PUT or POST requests";
    if ( code==200 ) return "OK    The request is OK (this is the standard response for successful HTTP requests)";
    if ( code==201 ) return "Created    The request has been fulfilled, and a new resource is created";
    if ( code==202 ) return "Accepted    The request has been accepted for processing, but the processing has not been completed";
    if ( code==203 ) return "Non-Authoritative Information    The request has been successfully processed, but is returning information that may be from another source";
    if ( code==204 ) return "No Content    The request has been successfully processed, but is not returning any content";
    if ( code==205 ) return "Reset Content    The request has been successfully processed, but is not returning any content, and requires that the requester reset the document view";
    if ( code==206 ) return "Partial Content    The server is delivering only part of the resource due to a range header sent by the client";
    if ( code==300 ) return "Multiple Choices    A link list. The user can select a link and go to that location. Maximum five addresses";
    if ( code==301 ) return "Moved Permanently    The requested page has moved to a new URL";
    if ( code==302 ) return "Found    The requested page has moved temporarily to a new URL";
    if ( code==303 ) return "See Other    The requested page can be found under a different URL";
    if ( code==304 ) return "Not Modified    Indicates the requested page has not been modified since last requested";
    if ( code==306 ) return "Switch Proxy    No longer used";
    if ( code==307 ) return "Temporary Redirect    The requested page has moved temporarily to a new URL";
    if ( code==308 ) return "Resume Incomplete    Used in the resumable requests proposal to resume aborted PUT or POST requests";
    if ( code==400 ) return "Bad Request    The request cannot be fulfilled due to bad syntax";
    if ( code==401 ) return "Unauthorized    The request was a legal request, but the server is refusing to respond to it. For use when authentication is possible but has failed or not yet been provided";
    if ( code==402 ) return "Payment Required    Reserved for future use";
    if ( code==403 ) return "Forbidden    The request was a legal request, but the server is refusing to respond to it";
    if ( code==404 ) return "Not Found    The requested page could not be found but may be available again in the future";
    if ( code==405 ) return "Method Not Allowed    A request was made of a page using a request method not supported by that page";
    if ( code==406 ) return "Not Acceptable    The server can only generate a response that is not accepted by the client";
    if ( code==407 ) return "Proxy Authentication Required    The client must first authenticate itself with the proxy";
    if ( code==408 ) return "Request Timeout    The server timed out waiting for the request";
    if ( code==409 ) return "Conflict    The request could not be completed because of a conflict in the request";
    if ( code==410 ) return "Gone    The requested page is no longer available";
    if ( code==411 ) return "Length Required    The 'Content-Length' is not defined. The server will not accept the request without it";
    if ( code==412 ) return "Precondition Failed    The precondition given in the request evaluated to false by the server";
    if ( code==413 ) return "Request Entity Too Large    The server will not accept the request, because the request entity is too large";
    if ( code==414 ) return "Request-URI Too Long    The server will not accept the request, because the URL is too long. Occurs when you convert a POST request to a GET request with a long query information";
    if ( code==415 ) return "Unsupported Media Type    The server will not accept the request, because the media type is not supported";
    if ( code==416 ) return "Requested Range Not Satisfiable    The client has asked for a portion of the file, but the server cannot supply that portion";
    if ( code==417 ) return "Expectation Failed    The server cannot meet the requirements of the Expect request-header field";
    if ( code==500 ) return "Internal Server Error    A generic error message, given when no more specific message is suitable";
    if ( code==501 ) return "Not Implemented    The server either does not recognize the request method, or it lacks the ability to fulfill the request";
    if ( code==502 ) return "Bad Gateway    The server was acting as a gateway or proxy and received an invalid response from the upstream server";
    if ( code==503 ) return "Service Unavailable    The server is currently unavailable (overloaded or down)";
    if ( code==504 ) return "Gateway Timeout    The server was acting as a gateway or proxy and did not receive a timely response from the upstream server";
    if ( code==505 ) return "HTTP Version Not Supported    The server does not support the HTTP protocol version used in the request";
    if ( code==511 ) return "Network Authentication Required    The client needs to authenticate to gain network access";
}

