timely.require(["scripts/calendar","scripts/event","scripts/common_scripts/frontend/common_frontend","domReady","jquery_timely","ai1ec_calendar","ai1ec_config"],function(e,t,n,r,i,s,o){var u=function(e){var t=o.javascript_widgets[e.widget];if(!t)return;var n=o.site_url+"?ai1ec_js_widget="+e.widget+"&render=true";return i.each(t,function(t,r){undefined!==e[t]&&(n+="&"+t+"="+e[t])}),n};r(function(){n.start();var e=function(e){e.preventDefault(),e.stopImmediatePropagation();var t=i(this).attr("href");type="jsonp",$timely_div=i(this).closest(".timely"),query={request_type:type,ai1ec_doing_ajax:!0,ai1ec:a($timely_div)},i("#ai1ec-event-modal").modal("show").find(".ai1ec-modal-body").html('<h1 class="ai1ec-text-center"><small>									<i class="ai1ec-fa ai1ec-fa-lg ai1ec-fa-fw ai1ec-fa-spin										ai1ec-fa-spinner"></i> '+o.calendar_loading_event+"</small></h1>"),i(".ai1ec-popup").hide(),i.ajax({url:t,dataType:type,data:query,method:"get",crossDomain:!0,success:function(e){var t=i("#ai1ec-event-modal");t.modal("show").find(".ai1ec-modal-body").html(e.html),i(".ai1ec-subscribe-container",t).hide(),i("a.ai1ec-category, a.ai1ec-tag",t).each(function(){i(this).removeAttr("href")}),i(".ai1ec-actions",t).hide(),i(".ai1ec-calendar-link",t).attr("data-dismiss","ai1ec-modal"),i(".timely-saas-more-button").off().on("click",function(){var e=i(this).closest(".timely-saas-single-description");return e.html(e.find(".timely-saas-full-description").html()),!1}),timely.require(["scripts/event"],function(e){e.start()})}})},t=function(e,t,n,i){var s=r(e),o=n.data(s);return o===undefined?t:(i?t.push(o):t.push(e+"~"+o),t)},r=function(e){return e.replace(/\W+(.)/g,function(e,t){return t.toUpperCase()})},a=function(e){var n=i(e),r=[];return r=t("action",r,n),r=t("cat_ids",r,n),r=t("auth_ids",r,n),r=t("tag_ids",r,n),r=t("exact_date",r,n),r=t("display_filters",r,n),r=t("no_navigation",r,n),r=t("events_limit",r,n),r.join("|")};i("#ai1ec-event-modal").length||i("body").append('<div id="ai1ec-event-modal" class="timely ai1ec-modal ai1ec-fade"							role="dialog" aria-hidden="true" tabindex="-1">							<div class="ai1ec-modal-dialog">								<div class="ai1ec-modal-content">									<button data-dismiss="ai1ec-modal" class="ai1ec-close ai1ec-pull-right">&times;</button>									<div class="ai1ec-modal-body ai1ec-clearfix single-ai1ec_event">									</div>								</div>							</div>						</div>'),i(".ai1ec-widget-placeholder").not('[data-widget="ai1ec-superwidget"]').each(function(t,n){var r=i("<div />",{"class":"timely"}).html('<i class="ai1ec-fa ai1ec-fa-spin ai1ec-fa-spinner"></i>').insertAfter(i(this)),o=i(this).data(),a=u(o),f={ai1ec_doing_ajax:!0,request_type:"jsonp"};r.on("click",".ai1ec-load-event, .ai1ec-cog-item-name a",e),i.ajax({url:a,dataType:"jsonp",data:f,success:function(e){r.html(e.html),top.postMessage("ai1ec-widget-loaded",top.document.URL),i.each(s.extension_urls,function(e,t){timely.require([t.url])})},error:function(e,t,n){window.alert("An error occurred while retrieving the data.")}})})})});