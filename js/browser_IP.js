//  Get user browser IP
jQuery(document).ready(function () {
                       jQuery.getJSON("https://jsonip.com/?callback=?", function (data) {
                                      console.log(data);
                                      alert(data.ip);
                                      });
                       });
