(function(e){var o=e.fn.addClass;e.fn.addClass=function(){var i=o.apply(this,arguments);if(this.prop("tagName")=="BODY"&&arguments[0]=="folded"){calculatePositionAndSize()}return i};var h=e.fn.removeClass;e.fn.removeClass=function(){var i=h.apply(this,arguments);if(this.prop("tagName")=="BODY"&&arguments[0]=="folded"){calculatePositionAndSize()}return i};var a=e.browser.msie;var d=0;if(a){d=jQuery.browser.version;d=parseFloat(d)}vp.custom_check_radio_event(".vp-wrap",".vp-field.vp-checked-field .field .input label");e(document).on("ready",function(){vp.init_controls(e(".vp-wrap"))});var m=[];var t=[];var l=[];var n=[];var g;e(".vp-menu-goto").each(function(v){var u=e(this).attr("href"),w=e(u),j=[];w.children(".vp-field").each(function(x){var z=e(this),i=z.attr("id"),B=z.attr("data-vp-validation"),D=z.attr("data-vp-bind"),A=z.attr("data-vp-items-bind"),y=z.getDatas().type,C=e('[name="'+i+'"]');g=z.attr("data-vp-dependency");g&&n.push({dep:g,type:"field",source:z.attr("id")});D&&t.push({bind:D,type:y,source:i});A&&l.push({bind:A,type:y,source:i});B&&j.push({name:i,rules:B,type:y})});w.children(".vp-section").each(function(x){var y=e(this);g=y.attr("data-vp-dependency");g&&n.push({dep:g,type:"section",source:y.attr("id")});y.find(".vp-field").each(function(z){var B=e(this),i=B.attr("id"),D=B.attr("data-vp-validation"),F=B.attr("data-vp-bind"),C=B.attr("data-vp-items-bind"),A=B.getDatas().type,E=e('[name="'+i+'"]');g=B.attr("data-vp-dependency");g&&n.push({dep:g,type:"field",source:B.attr("id")});F&&t.push({bind:F,type:A,source:i});C&&l.push({bind:C,type:A,source:i});D&&j.push({name:i,rules:D,type:A})})});if(j.length>0){m.push({name:u.trimChar("#"),fields:j})}});e(".vp-js-menu-goto").click(function(w){w.preventDefault();window.location.hash="#_"+e(this).attr("href").substr(1);var v=e(this),y=v.parent("li"),u=y.parents("li"),i=y.siblings("li"),j=u.siblings("li"),x=e(v.attr("href"));i.removeClass("vp-current");j.removeClass("vp-current");u.addClass("vp-current");y.addClass("vp-current");x.siblings(".vp-panel").removeClass("vp-current");x.addClass("vp-current")});var c=window.location.hash;if(c!==""){c="#"+c.substr(2);e('a[href="'+c+'"]').trigger("click")}else{e(".vp-current > .vp-js-menu-goto").click()}e(".vp-js-menu-dropdown").click(function(v){v.preventDefault();var u=e(this),j=u.parent("li"),w=j.siblings("li"),i=u.next("ul");if(j.hasClass("vp-current")){return}w.removeClass("vp-current");j.addClass("vp-current");if(i.children("li.vp-current").exists()){i.children("li.vp-current").children("a").click()}else{i.children("li").first().children("a").click()}});for(var r=0;r<t.length;r++){var b=t[r],s=b.bind.split("|"),f=s[0],k=s[1],p=[];k=k.split(/[\s,]+/);for(var q=0;q<k.length;q++){p.push(k[q])}for(var q=0;q<p.length;q++){vp.binding_event(p,q,b,f,".vp-wrap","option")}}for(var r=0;r<l.length;r++){var b=l[r],s=b.bind.split("|"),f=s[0],k=s[1],p=[];k=k.split(/[\s,]+/);for(var q=0;q<k.length;q++){p.push(k[q])}for(var q=0;q<p.length;q++){vp.items_binding_event(p,q,b,f,".vp-wrap","option")}}for(var r=0;r<n.length;r++){var b=n[r],s=b.dep.split("|"),f=s[0],k=s[1],p=[];k=k.split(",");for(var q=0;q<k.length;q++){p.push(k[q])}for(var q=0;q<p.length;q++){vp.dependency_event(p,q,b,f,".vp-wrap")}}e(".vp-js-option-form").bind("submit",function(B){B.preventDefault();vp.tinyMCE_save();e(".vp-js-option-form .vp-field").removeClass("vp-error");e(".validation-notif.vp-error").remove();e(".validation-msg.vp-error").remove();var C=0,A='<em class="validation-notif vp-error"></em>';for(var x=0;x<m.length;x++){var u=m[x];u.nError=0;u.nError=vp.fields_validation_loop(u.fields);if(u.nError>0){var D=e(A),G=e('[href="#'+u.name+'"]'),v=G.parent("li").parent("ul");D.appendTo(G);if(v.hasClass("vp-menu-level-2")){if(v.siblings("a").children(".validation-notif.vp-error").length===0){D.clone().appendTo(v.siblings("a"))}}}C=C+u.nError}if(C>0){return}var E=e(".vp-js-save-loader"),j=e(this).find(".vp-save"),z=e(".vp-js-save-status"),F=e("#vp-option-form"),y=F.serializeArray(),w={action:"vp_ajax_"+vp_opt.name+"_save",option:y,nonce:vp_opt.nonce};j.attr("disabled","disabled");E.stop(true,true).fadeIn(100);e.post(ajaxurl,w,function(i){z.html(i.message);if(i.status){z.addClass("success")}else{z.addClass("failed")}E.stop(true,true).fadeOut(100,function(){z.stop(true,true).fadeIn(100)});setTimeout(function(){j.removeAttr("disabled");z.stop(true,true).fadeOut(1000,function(){z.removeClass("success").removeClass("failed")})},3000)},"JSON")});e(".vp-js-restore").bind("click",function(x){x.preventDefault();if(!confirm("The current options will be deleted, do you want to proceed?")){return}var v=e(this),w=v.parent(),j=w.find(".vp-js-status"),i=w.find(".vp-js-loader"),u={action:"vp_ajax_"+vp_opt.name+"_restore",nonce:vp_opt.nonce};v.attr("disabled","disabled");i.fadeIn(100);e.post(ajaxurl,u,function(y){i.fadeOut(0);switch(y.code){case parseInt(vp_opt.SAVE_SUCCESS):j.html(vp_opt.util_msg.restore_success);break;case parseInt(vp_opt.SAVE_NOCHANGES):j.html(vp_opt.util_msg.restore_nochanges);break;case parseInt(vp_opt.SAVE_FAILED):j.html(vp_opt.util_msg.restore_failed+": "+y.message);break}j.fadeIn(100);setTimeout(function(){j.fadeOut(1000,function(){v.removeAttr("disabled");j.fadeOut(500);if(y.code==parseInt(vp_opt.SAVE_SUCCESS)){location.reload()}})},2000)},"JSON")});e("#vp-js-import").bind("click",function(v){v.preventDefault();var x=e("#vp-js-import_text"),i=e("#vp-js-import-status"),w=e("#vp-js-import-loader"),u=e(this),j={action:"vp_ajax_"+vp_opt.name+"_import_option",option:x.val(),nonce:vp_opt.nonce};u.attr("disabled","disabled");w.fadeIn(100);e.post(ajaxurl,j,function(y){w.fadeOut(0);if(y.status){i.html(vp_opt.util_msg.import_success)}else{i.html(vp_opt.util_msg.import_failed+": "+y.message)}i.fadeIn(100);setTimeout(function(){i.fadeOut(1000,function(){u.removeAttr("disabled");i.fadeOut(500);if(y.status){location.reload()}})},2000)},"JSON")});e("#vp-js-export").bind("click",function(v){v.preventDefault();var w=e("#vp-js-export-status"),u=e("#vp-js-export-loader"),j=e(this),i={action:"vp_ajax_"+vp_opt.name+"_export_option",nonce:vp_opt.nonce};j.attr("disabled","disabled");u.fadeIn(100);e.post(ajaxurl,i,function(x){u.fadeOut(0);if(!e.isEmptyObject(x.option)&&x.status){e("#vp-js-export_text").val(x.option);w.html(vp_opt.util_msg.export_success)}else{w.html(vp_opt.util_msg.export_failed+": "+x.message)}w.fadeIn(100);setTimeout(function(){w.fadeOut(1000,function(){j.removeAttr("disabled");w.fadeOut(500)})},3000)},"JSON")})}(jQuery));
