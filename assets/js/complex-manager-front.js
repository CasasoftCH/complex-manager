jQuery(function(){"use strict";!function(t){function e(t,e){return t.substring(t.length-e.length,t.length)===e}function o(o){var c="#"+o.prop("id");t(".complex-project-graphic-interaction a").each(function(o,n){e(t(n).attr("xlink:href"),c)&&t(n).attr("class",function(t,e){return e+" active"})}),t(".complex-custom-overlays img").hide(),t('.complex-custom-overlays img[data-show-on-active-unit="'+c+'"]').show()}function c(o){var c="#"+o.prop("id");t(".complex-project-graphic-interaction a").each(function(o,n){e(t(n).attr("xlink:href"),c)&&t(n).attr("class",function(t,e){return e.replace("active","")})}),t('.complex-custom-overlays img[data-show-on-active-unit="'+c+'"]').hide()}function n(e){t(".complex-project-graphic-interaction a").each(function(e,o){t(o).attr("class",function(t,e){return e.replace("active","")})}),e.hasClass("active")?(e.next().find(".detail-row-wrapper").slideUp("slow"),e.removeClass("active"),e.next().removeClass("active")):(t(".complex-unit-header-row.active").each(function(e,o){t(o).next().find(".detail-row-wrapper").slideUp("slow"),t(o).removeClass("active"),t(o).next().removeClass("active")}),e.next().find(".detail-row-wrapper").slideDown("slow"),e.addClass("active"),e.next().addClass("active"),t("html, body").animate({scrollTop:e.next().find(".detail-row-wrapper").offset().top-100},500),o(e))}function i(e){e.on("submit",function(o){o.preventDefault(),t("#complexContactFormLoader").length||e.append('<div id="complexContactFormLoader"><i class="fa fa-circle-o-notch fa-spin">&#9883;</i></div>'),t("#complexContactFormLoader").fadeIn("slow");var c=e.serialize();t.post(e.prop("action"),c,function(e){var o=t(e).find(".complex-contact-form-wrapper");t(".complex-contact-form-wrapper").html(o.html()),i(t("#complexContactFormAnchor"))})})}t("#complexContactForm").hide(),t(".complex-project-graphic img").load(function(){t(".complex-project-graphic-interaction").height(t(".complex-project-graphic img").height())}),t(".complex-unit-detail-row .detail-row-wrapper").slideUp(0),i(t("#complexContactFormAnchor")),t(".complex-unit-header-row").click(function(){n(t(this))}),t(".complex-unit-header-row").hover(function(){o(t(this))},function(){c(t(this))});var a=t(location).attr("href").replace(/^.*?(#|$)/,"");a&&t("#"+a).length&&t("#"+a).click(),t(".complex-project-graphic-interaction a").click(function(e){e.preventDefault();var o=t(this).attr("xlink:href"),c=o.indexOf("#"),n=-1!==c?o.substring(c+1):"";t("#"+n).length&&t("#"+n).click()}).hover(function(){var e=t(this).attr("xlink:href"),c=e.indexOf("#"),n=-1!==c?e.substring(c+1):"";t("#"+n).length&&o(t("#"+n))},function(){var e=t(this).attr("xlink:href"),o=e.indexOf("#"),n=-1!==o?e.substring(o+1):"";t("#"+n).length&&c(t("#"+n))}),t(".complex-call-contact-form").click(function(e){e.preventDefault();var o=t(this).data("unit-id");t('#complexContactForm form [name="complex-unit-inquiry[unit_id]"]').val(o),t("#complexContactForm").appendTo(t(this).parent()),t("#complexContactForm").slideUp(0),t("#complexContactForm").slideDown("slow"),t(".complex-sendback-contact-form").show(),t(this).hide()}),t(".complex-sendback-contact-form").click(function(e){e.preventDefault(),t("#complexContactForm").slideUp("slow"),t(".complex-call-contact-form").show()})}(jQuery)});