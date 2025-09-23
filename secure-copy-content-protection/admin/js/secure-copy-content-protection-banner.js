(function ($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    $(document).ready(function () {

        var checkCountdownIsExists = $(document).find('#ays-sccp-countdown-main-container');
        if ( checkCountdownIsExists.length > 0 ) {
            var second  = 1000,
                minute  = second * 60,
                hour    = minute * 60,
                day     = hour * 24;

            var sccpCountdownEndTime = sccpBannerLangObj.sccpBannerDate;
            // var sccpCountdownEndTime = "FEB 11, 2025 23:59:59";
            var countDown_new = new Date(sccpCountdownEndTime).getTime();

            if ( isNaN(countDown_new) || isFinite(countDown_new) == false ) {
                var AYS_SCCP_MILLISECONDS = 3 * day;
                var countdownStartDate = new Date(Date.now() + AYS_SCCP_MILLISECONDS);
                var sccpCountdownEndTime = countdownStartDate.aysSccpCustomFormat( "#YYYY#-#MM#-#DD# #hhhh#:#mm#:#ss#" );
                var countDown_new = new Date(sccpCountdownEndTime).getTime();
            }

            aysSccpBannerCountdown();

            var y = setInterval(function() {

                var now = new Date().getTime();
                var distance_new = countDown_new - now;

                
                aysSccpBannerCountdown();
                //do something later when date is reached
                if (distance_new < 0) {
                    var headline  = document.getElementById("ays-sccp-countdown-headline"),
                        countdown = document.getElementById("ays-sccp-countdown"),
                        content   = document.getElementById("ays-sccp-countdown-content");

                  // headline.innerText = "Sale is over!";
                  countdown.style.display = "none";
                  content.style.display = "block";

                  clearInterval(y);
                }
            }, 1000);
        }

        function aysSccpBannerCountdown(){
            var now = new Date().getTime();
            var distance_new = countDown_new - now;

            var countDownDays    = document.getElementById("ays-sccp-countdown-days");
            var countDownHours   = document.getElementById("ays-sccp-countdown-hours");
            var countDownMinutes = document.getElementById("ays-sccp-countdown-minutes");
            var countDownSeconds = document.getElementById("ays-sccp-countdown-seconds");

            if((countDownDays !== null || countDownHours !== null || countDownMinutes !== null || countDownSeconds !== null) && distance_new > 0){

                var countDownDays_innerText    = Math.floor(distance_new / (day));
                var countDownHours_innerText   = Math.floor((distance_new % (day)) / (hour));
                var countDownMinutes_innerText = Math.floor((distance_new % (hour)) / (minute));
                var countDownSeconds_innerText = Math.floor((distance_new % (minute)) / second);

                if( isNaN(countDownDays_innerText) || isNaN(countDownHours_innerText) || isNaN(countDownMinutes_innerText) || isNaN(countDownSeconds_innerText) ){
                    var headline  = document.getElementById("ays-sccp-countdown-headline"),
                        countdown = document.getElementById("ays-sccp-countdown"),
                        content   = document.getElementById("ays-sccp-countdown-content");

                    // headline.innerText = "Sale is over!";
                    countdown.style.display = "none";
                    content.style.display = "block";

                    // clearInterval(y);
                } else {
                    countDownDays.innerText    = countDownDays_innerText;
                    countDownHours.innerText   = countDownHours_innerText;
                    countDownMinutes.innerText = countDownMinutes_innerText;
                    countDownSeconds.innerText = countDownSeconds_innerText;
                }
                
            }
        }

        Date.prototype.aysSccpCustomFormat = function( formatString){
            var YYYY,YY,MMMM,MMM,MM,M,DDDD,DDD,DD,D,hhhh,hhh,hh,h,mm,m,ss,s,ampm,AMPM,dMod,th;
            YY = ((YYYY=this.getFullYear())+"").slice(-2);
            MM = (M=this.getMonth()+1)<10?('0'+M):M;
            MMM = (MMMM=["January","February","March","April","May","June","July","August","September","October","November","December"][M-1]).substring(0,3);
            DD = (D=this.getDate())<10?('0'+D):D;
            DDD = (DDDD=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"][this.getDay()]).substring(0,3);
            th=(D>=10&&D<=20)?'th':((dMod=D%10)==1)?'st':(dMod==2)?'nd':(dMod==3)?'rd':'th';
            formatString = formatString.replace("#YYYY#",YYYY).replace("#YY#",YY).replace("#MMMM#",MMMM).replace("#MMM#",MMM).replace("#MM#",MM).replace("#M#",M).replace("#DDDD#",DDDD).replace("#DDD#",DDD).replace("#DD#",DD).replace("#D#",D).replace("#th#",th);
            h=(hhh=this.getHours());
            if (h==0) h=24;
            if (h>12) h-=12;
            hh = h<10?('0'+h):h;
            hhhh = hhh<10?('0'+hhh):hhh;
            AMPM=(ampm=hhh<12?'am':'pm').toUpperCase();
            mm=(m=this.getMinutes())<10?('0'+m):m;
            ss=(s=this.getSeconds())<10?('0'+s):s;

            return formatString.replace("#hhhh#",hhhh).replace("#hhh#",hhh).replace("#hh#",hh).replace("#h#",h).replace("#mm#",mm).replace("#m#",m).replace("#ss#",ss).replace("#s#",s).replace("#ampm#",ampm).replace("#AMPM#",AMPM);
            // token:     description:             example:
            // #YYYY#     4-digit year             1999
            // #YY#       2-digit year             99
            // #MMMM#     full month name          February
            // #MMM#      3-letter month name      Feb
            // #MM#       2-digit month number     02
            // #M#        month number             2
            // #DDDD#     full weekday name        Wednesday
            // #DDD#      3-letter weekday name    Wed
            // #DD#       2-digit day number       09
            // #D#        day number               9
            // #th#       day ordinal suffix       nd
            // #hhhh#     2-digit 24-based hour    17
            // #hhh#      military/24-based hour   17
            // #hh#       2-digit hour             05
            // #h#        hour                     5
            // #mm#       2-digit minute           07
            // #m#        minute                   7
            // #ss#       2-digit second           09
            // #s#        second                   9
            // #ampm#     "am" or "pm"             pm
            // #AMPM#     "AM" or "PM"             PM
        };

    });

})(jQuery);

function aysSccpGetCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function aysSccpCreateCookie(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

document.addEventListener("DOMContentLoaded", function() {
    var startDate = new Date("2025-09-21");
    var endDate = new Date("2025-10-21");
    var totalLicenses = 50;
    var progressionPattern = new Array(3, 2, 1, 4, 2, 3, 1, 2, 4, 3, 2, 1, 3, 2, 4, 1, 3, 2, 2, 3, 1, 2);
    function getCurrentProgress() {
        var today = new Date();
        // today.setDate(today.getDate() + 1);
        var daysPassed = Math.floor((today - startDate) / (1000 * 60 * 60 * 24));
        var usedLicenses = 0;
        for (var i = 0; i < Math.min(daysPassed, progressionPattern.length); i++) {
            usedLicenses += progressionPattern[i];
        }
        return Math.min(usedLicenses, totalLicenses);
    }
    function updateProgress() {
        var usedLicenses = getCurrentProgress();
        var remainingLicenses = totalLicenses - usedLicenses;
        var progressPercentage = (usedLicenses / totalLicenses) * 100;
        var remainingElement = document.getElementById("remaining-licenses");
        var progressElement = document.getElementById("progress-fill");
        if (remainingElement) remainingElement.textContent = remainingLicenses;
        if (progressElement) progressElement.style.width = progressPercentage + "%";
    }
    updateProgress();
});

// Copy to clipboard function
function copyToClipboard(text) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(function() {
            showCopyNotification(sccpBannerLangObj.successCopyCoupon);
        }).catch(function() {
            fallbackCopyTextToClipboard(text);
        });
    } else {
        fallbackCopyTextToClipboard(text);
    }
}

function fallbackCopyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.position = "fixed";
    textArea.style.top = "-9999px";
    textArea.style.left = "-9999px";
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    try {
        var successful = document.execCommand("copy");
        if (successful) {
            showCopyNotification(sccpBannerLangObj.successCopyCoupon);
        } else {
            showCopyNotification(sccpBannerLangObj.failedCopyCoupon);
        }
    } catch (err) {
        showCopyNotification(sccpBannerLangObj.failedCopyCoupon);
    }
    document.body.removeChild(textArea);
}

function showCopyNotification(message) {
    var notification = document.createElement("div");
    notification.className = "ays-sccp-copy-notification show";
    notification.textContent = message;
    document.body.appendChild(notification);
    setTimeout(function() {
        notification.classList.remove("show");
        setTimeout(function() {
            document.body.removeChild(notification);
        }, 300);
    }, 2000);
}


jQuery(document).ready(function($) {

    setTimeout(function() {
        var popup = document.getElementById("ays-sccp-fox-lms-all-pages-popup");
        if (popup) {
            popup.style.display = "block";
        }
    }, 30000);

    var closeButton = document.getElementById("ays-sccp-fox-lms-all-pages-popup-close");
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            var popup = document.getElementById("ays-sccp-fox-lms-all-pages-popup");
            if (popup) {
                popup.style.display = "none";
            }

            var cookieName = "ays_sccp_fox_lms_pages_popup_dismiss_for_three_click";
            var currentCookieStr = aysSccpGetCookie(cookieName);
            var newCookieVal = 1;

            if (currentCookieStr) {
                var parsedVal = parseInt(currentCookieStr);
                if (!isNaN(parsedVal)) {
                    newCookieVal = parsedVal + 1;
                } else {
                    // If cookie is corrupted (not a number), reset to 1
                    newCookieVal = 1;
                }
            }
            aysSccpCreateCookie(cookieName, newCookieVal, 7);
        });
    }
});
