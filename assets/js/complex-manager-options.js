jQuery(document).ready(function(e){var t=!0,i=wp.media.editor.send.attachment;e(".complex_image_upload").click(function(a){var d=(wp.media.editor.send.attachment,e(this)),n=d.attr("id").replace("_button","");return t=!0,wp.media.editor.send.attachment=function(a,d){return t?(console.log(d),e("#"+n).val(d.id),e("#"+n+"_src").prop("src",d.sizes.medium.url),void 0):i.apply(this,[a,d])},wp.media.editor.open(d),!1}),e(".add_media").on("click",function(){t=!1})});