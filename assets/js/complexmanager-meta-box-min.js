var $=jQuery,cm={media:{}};cm.media.documentUpload={get:function(){},set:function(e){},frame:function(){return this._frame||(this._frame=wp.media({multiple:!1,title:"title herer"}),this._frame.on("toolbar:create:featured-image",(function(e){this.createSelectToolbar(e,{text:i18n.button})}),this._frame),this._frame.on("content:render:edit-image",(function(){var e=this.state("featured-image").get("selection"),t=new wp.media.view.EditImage({model:e.single(),controller:this}).render();this.content.set(t),t.loadEditor()}),this._frame),this._frame.state("featured-image").on("select",this.select)),this._frame},select:function(){var e=this.get("selection").single();wp.media.view.settings.post.featuredImageId&&cm.media.documentUpload.set(e?e.id:-1)},init:function(){$("#complexmanager_unit_box").on("click","#complexmanager_unit_document-button",(function(e){e.preventDefault(),e.stopPropagation(),cm.media.documentUpload.frame().open()})).on("click","#complexmanager_unit_document-removebutton",(function(){}))}},$(cm.media.documentUpload.init),jQuery(document).ready((function(e){var t=!0,n=wp.media.editor.send.attachment;e("#complexmanager_unit_box .button, #complexmanager_unit_graphic_box .button").click((function(i){var a=(wp.media.editor.send.attachment,e(this)),o=a.attr("id").replace("_button","");return t=!0,wp.media.editor.send.attachment=function(i,a){return t?void e("#"+o).val(a.url):n.apply(this,[i,a])},wp.media.editor.open(a),!1})),e(".add_media").on("click",(function(){t=!1}))})),jQuery(document).ready((function(e){e("#complexmanager_unit_graphic_poly").hide().canvasAreaDraw()}))(jQuery);