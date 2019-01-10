if (self.CavalryLogger) { CavalryLogger.start_js(["EsomR"]); }

__d("MTouchableArea.react",["MJSEnvironment","React","cx","joinClasses"],(function(a,b,c,d,e,f,g,h,i,j){__p&&__p();a=h.PropTypes;var k=g.IS_ANDROID&&g.OS_VERSION<4.1,l=3;b=h.createClass({displayName:"MTouchableArea",propTypes:{onTouchEnd:a.func,onTouchMove:a.func,onTouchStart:a.func},getInitialState:function(){return{touchStartX:0,touchStartY:0,isTouched:!1}},handleTouchEnd:function(a){this.setState(this.getInitialState()),this.props.onTouchEnd&&this.props.onTouchEnd(a)},handleTouchMove:function(a){var b=a.nativeEvent.touches[0].screenX-this.state.touchStartX,c=a.nativeEvent.touches[0].screenY-this.state.touchStartY;(b>l||c>l)&&this.setState(this.getInitialState());this.props.onTouchMove&&this.props.onTouchMove(a)},handleTouchStart:function(a){k?this.setState({isTouched:!0,touchStartX:a.nativeEvent.touches[0].screenX,touchStartY:a.nativeEvent.touches[0].screenY}):this.setState({isTouched:!0}),this.props.onTouchStart&&this.props.onTouchStart(a)},render:function(){var a=h.Children.only(this.props.children);return h.cloneElement(a,{className:j(a.props.className,this.state.isTouched?"touched":""),onTouchEnd:this.handleTouchEnd,onTouchMove:k?this.handleTouchMove:this.props.onTouchMove,onTouchStart:this.handleTouchStart})}});e.exports=b}),null);
__d("MStructuredComposerFriendsInputReact",["BanzaiODS","CSS","DOM","MComposerLogger","MComposerNavigationMixin","MComposerWaterfallEvent","MCompositionUserActions","MCompositionWithFields","MCompositionWithStore","MSubscriptionsHandlerMixin","MTokenCollection.react","MTokenRenderer.react","MUnifiedTaggerConstants","React","ReactDOM","Stratcom","TokenCollection","mixin","setTimeoutAcrossTransitions"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y){__p&&__p();var z,A="mtouch_composer_facerec_suggestions",B=s.SHOW_UNIFIED_TAGGER;b=babelHelpers.inherits(a,x(k,p));z=b&&b.prototype;function a(a,b,c){"use strict";__p&&__p();z.constructor.call(this),this.$MStructuredComposerFriendsInputReact1=a,this.$MStructuredComposerFriendsInputReact2=b,this.$MStructuredComposerFriendsInputReact3=new w(),this.$MStructuredComposerFriendsInputReact4=u.render(t.createElement(q,{onClick:this.$MStructuredComposerFriendsInputReact5.bind(this),onRemove:this.$MStructuredComposerFriendsInputReact6.bind(this),renderer:r,collection:this.$MStructuredComposerFriendsInputReact3,collectionKey:"users_with"}),i.find(b,"ul","friend-tokens")),this.$MStructuredComposerFriendsInputReact7=c,this.$MStructuredComposerFriendsInputReact8=c.style.display,this.$MStructuredComposerFriendsInputReact9={},B&&this.addSubscriptions(v.listen("MComposer:tagger:click",s.TOKEN_TYPES.PEOPLE,function(){return this.$MStructuredComposerFriendsInputReact5()}.bind(this))),this.addSubscriptions(v.listen("click","inline-with-button",function(){y(function(){this.$MStructuredComposerFriendsInputReact5()}.bind(this),10)}.bind(this)),v.listen("MComposer:tagger:open",null,function(){return this.$MStructuredComposerFriendsInputReact5()}.bind(this))),this.addSubscriptions(i.listen(this.$MStructuredComposerFriendsInputReact7,"click",null,function(){return this.$MStructuredComposerFriendsInputReact5()}.bind(this)),this.$MStructuredComposerFriendsInputReact1.listen("cancel",function(){this.currentNavigationPolicy().addOnClose(function(){return this.$MStructuredComposerFriendsInputReact10()}.bind(this)).close()}.bind(this)),this.$MStructuredComposerFriendsInputReact1.listen("submit",function(a){this.currentNavigationPolicy().addOnClose(function(){var b={};b[n.TOKENS]=a.tokens;m.withUpdate(b);j.log(l.FRIEND_TAG_ADD,{num_tags:a.tokens.length});this.$MStructuredComposerFriendsInputReact11(a.tokens.length)}.bind(this)).close()}.bind(this)),o.addChangeListener(function(){return this.$MStructuredComposerFriendsInputReact12()}.bind(this)))}a.prototype.$MStructuredComposerFriendsInputReact12=function(){"use strict";var a=o.get(n.TOKENS,[]);a!==this.$MStructuredComposerFriendsInputReact3.entries&&(this.$MStructuredComposerFriendsInputReact3.entries=a,this.$MStructuredComposerFriendsInputReact13(),this.$MStructuredComposerFriendsInputReact4.forceUpdate(),this.$MStructuredComposerFriendsInputReact14(),this.$MStructuredComposerFriendsInputReact11(),this.$MStructuredComposerFriendsInputReact15())};a.prototype.$MStructuredComposerFriendsInputReact15=function(){"use strict";this.$MStructuredComposerFriendsInputReact16&&this.$MStructuredComposerFriendsInputReact16(this.$MStructuredComposerFriendsInputReact3.entries.slice())};a.prototype.$MStructuredComposerFriendsInputReact13=function(){"use strict";B&&v.invoke("MComposer:tagger:update",null,{people:this.$MStructuredComposerFriendsInputReact3.entries})};a.prototype.$MStructuredComposerFriendsInputReact17=function(a){"use strict";var b=!this.$MStructuredComposerFriendsInputReact3.hasEntry(a);b&&(this.$MStructuredComposerFriendsInputReact3.addEntry(a),this.$MStructuredComposerFriendsInputReact13(),this.$MStructuredComposerFriendsInputReact14(),this.$MStructuredComposerFriendsInputReact4.forceUpdate());return b};a.prototype.addManualXYTag=function(a){"use strict";this.$MStructuredComposerFriendsInputReact17(a)&&this.$MStructuredComposerFriendsInputReact18(),this.$MStructuredComposerFriendsInputReact15()};a.prototype.addAutoToken=function(a){"use strict";this.$MStructuredComposerFriendsInputReact9[a.id]||this.$MStructuredComposerFriendsInputReact17(a)&&(this.$MStructuredComposerFriendsInputReact19(),g.bumpEntityKey(A,"add_auto_tag"))};a.prototype.onRemove=function(a){"use strict";this.$MStructuredComposerFriendsInputReact3.removeEntry(a),this.$MStructuredComposerFriendsInputReact14(),this.$MStructuredComposerFriendsInputReact13(),this.$MStructuredComposerFriendsInputReact4.forceUpdate(),this.$MStructuredComposerFriendsInputReact15()};a.prototype.$MStructuredComposerFriendsInputReact6=function(a){"use strict";this.$MStructuredComposerFriendsInputReact9[a.id]=!0,this.onRemove(a),a.autoTag&&g.bumpEntityKey(A,"remove_auto_tag"),this.$MStructuredComposerFriendsInputReact20()};a.prototype.$MStructuredComposerFriendsInputReact14=function(){"use strict";var a=this.$MStructuredComposerFriendsInputReact3.entries.length>0;B||h.conditionShow(this.$MStructuredComposerFriendsInputReact2,a);h.conditionClass(this.$MStructuredComposerFriendsInputReact7,"active",a)};a.prototype.$MStructuredComposerFriendsInputReact5=function(){"use strict";this.newNavigationPolicy().addOnOpen(function(){j.log(l.FRIEND_TAG_INTENT),this.$MStructuredComposerFriendsInputReact1.setEntries(this.$MStructuredComposerFriendsInputReact3.entries.slice()),setTimeout(this.$MStructuredComposerFriendsInputReact1.show.bind(this.$MStructuredComposerFriendsInputReact1))}.bind(this)).addOnCloseByBrowser(function(){this.$MStructuredComposerFriendsInputReact1.hide(),this.$MStructuredComposerFriendsInputReact10()}.bind(this)).open()};a.prototype.$MStructuredComposerFriendsInputReact11=function(a){"use strict";v.invoke("MStructuredComposerFriendsInput-done",null,{num_tags:a})};a.prototype.$MStructuredComposerFriendsInputReact19=function(){"use strict";v.invoke("MStructuredComposerFriendsInput-addedAutoTags",null,{})};a.prototype.$MStructuredComposerFriendsInputReact18=function(){"use strict";v.invoke("MStructuredComposerFriendsInput-addedManualXYTags",null,{})};a.prototype.$MStructuredComposerFriendsInputReact20=function(){"use strict";v.invoke("MStructuredComposerFriendsInput-removedManualTags",null,{})};a.prototype.$MStructuredComposerFriendsInputReact10=function(){"use strict";var a=this.getTokenCount();v.invoke("MStructuredComposerFriendsInput-done",null,{cancel:!0,num_tags:a});j.log(l.FRIEND_TAG_CANCEL,{num_tags:a})};a.prototype.reset=function(){"use strict";this.$MStructuredComposerFriendsInputReact4.entries=[],B||i.hide(this.$MStructuredComposerFriendsInputReact2),this.$MStructuredComposerFriendsInputReact3.entries=[],this.$MStructuredComposerFriendsInputReact9={},this.$MStructuredComposerFriendsInputReact1.clear(),this.$MStructuredComposerFriendsInputReact4.forceUpdate(),h.conditionClass(this.$MStructuredComposerFriendsInputReact7,"active",!1),this.$MStructuredComposerFriendsInputReact1.hide()};a.prototype.getTokenCount=function(){"use strict";return this.$MStructuredComposerFriendsInputReact3.entries.length};a.prototype.hasTokens=function(){"use strict";return this.getTokenCount()>0};a.prototype.setVisible=function(a){"use strict";h.conditionShow(this.$MStructuredComposerFriendsInputReact7,a)};a.prototype.setOnEntriesChangedHandler=function(a){"use strict";this.$MStructuredComposerFriendsInputReact16=a};a.prototype.getEntries=function(){"use strict";return this.$MStructuredComposerFriendsInputReact3.entries};e.exports=a}),null);
__d("XMStoriesAsyncTrayController",["XController"],(function(a,b,c,d,e,f){e.exports=b("XController").create("/stories/tray/",{})}),null);
__d("MStoriesTrayUtils",["MPageCache","MPageControllerPath","MRequestTypes","MResponseData","MURI","XAsyncRequest","XMStoriesAsyncTrayController"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m){"use strict";__p&&__p();a={refreshTray:function(a,b){__p&&__p();var c=m.getURIBuilder().getURI();c=new l(new k(c).toString());c.setType(i.DEPENDENT);c.setAutoProcess(!1);c.setResponseHandler(function(b){b=new j(b);b.process();var c=h.getRequestPath();g.addCachedIUIResponse(c,b);a&&a()});c.setErrorHandler(function(){b&&b()});c.send()}};e.exports=a}),null);
__d("MStoriesProductionTrayAsync",["Bootloader","CSS","MFBStoriesGatingConfig","MFBStoriesTrayType","MStoriesID","MStoriesProductionInfo","MStoriesProductionTrayUtils","MStoriesStratcomEvents","MStoriesToast","MStoriesTrayUtils","MStoriesUIConstants","MStoriesUploadStatus","Stratcom","cx"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t){"use strict";__p&&__p();a={handleFailedAddToStoryPogSelected:function(){__p&&__p();if(l.getUploadStatus()!==r.FAILED)return!1;var a=document.getElementById(k.PRODUCTION_INPUT);if(a){a.click();l.setUploadStatus(r.IDLE);m.updateProductionPog();return!0}return!1},uploadCB:function(a){__p&&__p();var b=m.getAnimationPog();if(a)l.setUploadStatus(r.IDLE),i.trayType!==j.CIRCULAR||b&&b.id===k.PRODUCTION_ADD_ITEM_POG?p.refreshTray(function(){this._cleanupUploading(),o.showDefaultToast(q.UPLOAD_SUCCESSFUL)}.bind(this),function(){this._cleanupUploading()}.bind(this)):(this._cleanupUploading(),o.showDefaultToast(q.UPLOAD_SUCCESSFUL)),b&&h.addClass(b,"_26w9"),s.invoke(n.UPLOAD_SUCCESS,null,null);else{l.setUploadStatus(r.FAILED);if(b&&b.id===k.PRODUCTION_ADD_ITEM_POG){var c=document.getElementById(k.PRODUCTION_ADD_ITEM_DIV);c&&h.addClass(c,"no-after");b&&h.removeClass(b,"hide-border")}this._cleanupUploading();s.invoke(n.UPLOAD_FAILED,null,null)}g.loadModules(["FBStoriesLoggingConstants","MStoriesTypedLogger"],function(b,c){b=a?b.ACTION_SEND_STORY_SUCCEEDED:b.ACTION_SEND_STORY_FAILED;c=new c().setName(b);c.log()},"MStoriesProductionTrayAsync")},_cleanupUploading:function(){var a=document.getElementById(k.PRODUCTION_ADD_ITEM_POG),b=document.getElementById(k.PRODUCTION_OWNER_ITEM_POG);a&&h.removeClass(a,m.getUploadingClass());b&&h.removeClass(b,m.getUploadingClass());a=document.getElementById(k.PRODUCTION_ADD_ITEM_DIV);a&&h.removeClass(a,"disable");m.updateProductionPog()}};e.exports=a}),null);
__d("MPrivacyDeferredSelector",["MRequest","MRequestTypes","MURI","Stratcom"],(function(a,b,c,d,e,f,g,h,i,j){__p&&__p();var k=null,l=null,m=null,n=!1;function a(a,b,c,d){l=a,k=b,m=c,n=d,j.listen("MPrivacyDeferredSelector::init",null,function(a){o(a),j.removeCurrentListener()})}function o(a){a=new i("/privacy/selector");a.setQueryData({pt_id:l,eco:k,selected:m,defaultSelector:!0,useSmallIcons:n});a=new g(a.toString());a.setType(h.DEPENDENT);a.send()}function b(a){j.invoke("MPrivacyDeferredSelector-loaded",null,{id:a})}function c(a){a}e.exports={init:a,informLoaded:b,setShowNewcomerAudienceSelector:c}}),null);
__d("MImageFetchNotifier",["invariant","prefetchImage","setImmediateAcrossTransitions"],(function(a,b,c,d,e,f,g,h,i){"use strict";__p&&__p();var j={},k={},l={},m={};function n(a,b){if(!j[a])return;b=j[a].indexOf(b);j[a].splice(b,1);j[a].length===0&&(l[a].cancel(),delete j[a],delete l[a])}function o(a){k[a]=!0,j[a].forEach(function(a){return a()}),delete j[a],delete l[a]}function p(a){l[a]=h(a,function(){o(a)})}var q={associateImageURLWithDOMID:function(a,b){m[a]=b},notifyWhenFetched:function(a,b){__p&&__p();if(k[a]===!0){var c=!0;i(function(){c&&b()});return{remove:function(){c=!1}}}j[a]=j[a]||[];j[a].push(b);l[a]||p(a);return{remove:function(){n(a,b)}}},notifyWhenFetchedForDOMID:function(a,b){var c=m[a];c!==null||g(0,1595,a);return q.notifyWhenFetched(c,b)}};e.exports=q}),null);
__d("XInlineComposerAudienceEducationController",["XController"],(function(a,b,c,d,e,f){e.exports=b("XController").create("/privacy/audience_education/",{new_post_param:{type:"String"},update_icon:{type:"Bool",defaultValue:!1}})}),null);
__d("whitelistObjectKeys",[],(function(a,b,c,d,e,f){function a(a,b){var c={};b=Array.isArray(b)?b:Object.keys(b);for(var d=0;d<b.length;d++)typeof a[b[d]]!=="undefined"&&(c[b[d]]=a[b[d]]);return c}e.exports=a}),null);
__d("GroupSellSurface",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({POPOVER_PERMALINK:"popover_permalink",EMAIL:"email",GROUP_MEGAPHONE:"group_megaphone",QUICK_PROMOTION:"quick_promotion",GLOBAL_SEARCH_MODULE_RESULT:"global_search_module_result",GROUP_MODAL_NUX:"group_modal_nux",YOUR_POSTS:"your_posts",YOUR_POSTS_PAGE:"your_posts_page",YOUR_POSTS_PAGE_OTHER_GROUPS:"your_posts_page_other_groups",FOR_SALE_HOVERCARD:"for_sale_hovercard",FOR_SALE_CONTEXT_ITEM:"for_sale_context_item",RECOMMENDATION_BADGE:"recommendation_badge",TARGET_USER_FOR_SALE_POSTS:"target_user_for_sale_posts",SELLER_PROFILE:"seller_profile",GROUP_POST_CHEVRON:"group_post_chevron",FEED_POST_CHEVRON:"feed_post_chevron",ADMIN_SETTING_PAGE:"admin_setting_page",SCRIPTS:"scripts",CRT_SCRIPTS:"crt_scripts",TESTS:"tests",DELETE_INTERCEPT:"delete_intercept",INTERN_CONSOLE:"intern_console",GROUP_MALL:"group_mall",BROWSE_CATEGORIES:"browse_categories",CATEGORY_MALL:"category_mall",GROUP_SEARCH:"group_search",GROUP_MALL_SELL_COMPOSER:"group_mall_sell_composer",FORSALE_ISLAND:"forsale_island",CROSS_GROUP_FORSALE_ISLAND:"cross_group_forsale_island",PRODUCT_MALL:"product_mall",MESSAGE_PERMALINK:"permalink",FEED_STORY:"feed_story",GROUP_COMPOSER:"group_composer",UNKNOWN:"unknown",DIRECT_LINK:"direct_link",GROUP_MALL_HEADER_NAV:"group_mall_header_nav",GROUP_MALL_ISLAND_NAV:"island_nav",YOUR_POSTS_ISLAND_NAV:"your_posts_island_nav",MARK_AS_SOLD_REMINDER:"mas_reminder",RIGHT_HAND_COLUMN_CATEGORY_SHOWALL:"rhc_category_showall",YOUR_POSTS_UNSOLD_NOTIFICATION:"your_posts_unsold_notif",RIGHT_HAND_COLUMN:"right_hand_column",SAVED_SEARCH_NOTIF:"saved_search_notif",INVENTORY_MANAGEMENT:"inventory_management",GROUP_MALL_SUGGESTIONS:"group_mall_suggestions",CLEANER:"group_sell_cleaner",PURPOSE_TRIGGER:"group_sell_purpose_trigger",PURPOSE_BACKFILL:"group_sell_purpose_backfill",HIGH_CONFIDENCE_SALE_SCRIPT:"high_confidence_sale_script",EDIT_GROUP_SETTINGS_DESKTOP:"edit_group_settings_desktop",EDIT_GROUP_SETTINGS_MOBILE:"edit_group_settings_mobile",MAYBE_FOR_SALE_SCRIPT:"maybe_for_sale_script",LANDING_PAGE_BOOKMARK:"landing_page_bookmark",LANDING_PAGE_SUGGESTED_GROUPS:"landing_page_suggested_groups",LANDING_PAGE_SUGGESTED_GROUPS_CARD:"landing_page_suggested_groups_card",LANDING_PAGE_SUGGESTED_GROUPS_MAP:"landing_page_suggested_groups_map",LANDING_PAGE_YOUR_POSTS:"landing_page_your_posts",LANDING_PAGE_YOUR_GROUPS:"landing_page_your_groups",LANDING_PAGE_YOUR_SALES_RHC:"landing_page_your_sales_rhc",LANDING_PAGE_AD:"lp_ad",LANDING_PAGE_MOBILE:"landing_page_mobile",EGO_SGNY:"ego_sgny",GROUPS_BROWSER:"groups_browser",LOW_QUALITY_GROUP_SELL_CLEAN_SCRIPT:"low_quality_group_sell_clean_script",GROUPS_YOU_SHOULD_JOIN:"groups_you_should_join",PRODUCT_DETAIL:"product_detail",MARKETPLACE_COMPOSER:"marketplace_composer",MARKETPLACE_YOUR_POSTS:"marketplace_your_posts",MARKETPLACE_UPSELL_DIALOG:"marketplace_upsell_dialog",MARKETPLACE_CROSS_POST_UNSOLD_GROUP:"marketplace_cross_post_unsold_group",MARKETPLACE_CROSS_POST_SUGGESTIONS:"marketplace_cross_post_suggestions",MARKETPLACE_INVENTORY_XPOST_VIEW:"marketplace_inventory_xpost_view",MARKETPLACE_INVENTORY_XPOST_VIEW_WWW:"marketplace_inventory_xpost_view_www",AUTO_STRUCTURE_SCRIPT:"auto_structure_script",NLU_PROMPT:"nlu_prompt",MARKETPLACE_GALLERY:"marketplace_gallery",MARKETPLACE_GYSJ:"marketplace_gysj",CROSS_GROUP_FEED:"cross_group_feed",BUY_AND_SELL_SEARCH_RESULTS:"buy_and_sell_search_results",XGROUP_ITEMS_FOR_SALE_NOTIFICATION:"xgroup_fs_notif",GROUP_COMMERCE_RN_PDP:"group_commerce_rn_pdp",GROUP_COMMERCE_RN_BOOKMARK:"group_commerce_rn_bookmark",GROUP_COMMERCE_NATIVE_PERMALINK:"group_commerce_native_permalink",CITY_COMMUNITY:"city_community",MARKETPLACE:"marketplace",NOTIFICATION:"notification",BOOKMARK:"bookmark",NEWSFEED:"newsfeed",GROUPS:"groups",TIMELINE:"timeline",BUY_SELL_GROUP_MEGA_MALL:"buy_sell_group_mega_mall",BUY_SELL_GROUP_MINI_MALL:"buy_sell_group_mini_mall",DISCOVERY_FEED_STORY:"discovery_feed_story",MESSENGER_BANNER:"messenger_banner",GROUPCOMM_INAPP_MESSENGER:"groupcomm_inapp_messenger"})}),null);
__d("GroupSellUserActionEvents",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({MARK_AS_SOLD:"mark_as_sold",MARK_AS_AVAILABLE:"mark_as_available",MARK_AS_ARCHIVE:"mark_as_archive",MARK_AS_UNARCHIVE:"mark_as_unarchive",MARK_AS_PENDING:"mark_as_pending",NON_FOR_SALE_MARK_AS_SOLD:"non_for_sale_mark_as_sold",NON_FOR_SALE_MARK_AS_PENDING:"non_for_sale_mark_as_pending",GROUP_POST:"group_post",MARKETPLACE_POST:"marketplace_post",PROFILE_POST:"profile_post",LAUNCH_EDIT:"launch_edit",GROUP_POST_EDIT:"group_post_edit",GROUP_POST_REPORT:"group_post_report",ADMIN_OPT_IN:"admin_opt_in",ADMIN_OPT_OUT:"admin_opt_out",ADMIN_NOT_FOR_SALE:"admin_not_for_sale",ADMIN_DO_NOT_WANT:"admin_do_not_want",GROUP_CURRENCY_CHANGE:"group_currency_change",OPT_IN_MEGAPHONE_SEEN:"opt_in_megaphone_seen",OPT_IN_NOTIFICATION_SENT:"opt_in_notification_sent",AUTO_OPT_IN_MEGAPHONE_SEEN:"auto_opt_in_megaphone_seen",AUTO_OPTED_IN_MEGAPHONE_SEEN:"auto_opted_in_megaphone_seen",GROUP_PURPOSES_NUX_SEEN:"group_purposes_nux_seen",GROUP_PURPOSE_SELECTED:"group_purpose_selected",GROUP_NON_FOR_SALE_POST:"group_non_for_sale_post",GROUP_MARKED_AS_MAY_BE_FOR_SALE:"group_marked_as_may_be_for_sale",GROUP_CRT_CATEGORIZED_FOR_SALE:"group_crt_categorized_for_sale",GROUP_CRT_CATEGORIZED_FOR_SALE_FAIL:"group_crt_categorized_for_sale_fail",GROUP_ENABLED:"group_enabled",GROUP_DISABLED:"group_disabled",GROUP_NON_FOR_SALE_POST_INTERCEPT_WORDS:"group_non_for_sale_post_intercept_words",GROUP_NON_FOR_SALE_POST_NLU_INTERCEPT:"group_non_for_sale_post_nlu_intercept",GROUP_NON_FOR_SALE_POST_NLU_ATTEMPT:"group_non_for_sale_post_nlu_attempt",GROUP_NON_FOR_SALE_POST_NLU_ERROR:"group_non_for_sale_post_nlu_error",GROUP_NON_FOR_SALE_POST_NLU_TIMEOUT:"group_non_for_sale_post_nlu_timeout",ADMIN_GROUP_PURPOSE_EDIT_DISALLOWED:"admin_group_purpose_edit_disallowed",ADMIN_GROUP_REQUEST_PURPOSE_CHANGE:"admin_group_request_purpose_change",FOR_SALE_POST_APPROVE:"for_sale_post_approve",NON_FOR_SALE_POST_APPROVE:"non_for_sale_post_approve",FOR_SALE_POST_DELETED:"for_sale_post_deleted",NON_FOR_SALE_POST_DELETED:"non_for_sale_post_deleted",GROUP_NON_FOR_SALE_POST_INTERCEPT_CREATED:"group_non_for_sale_post_intercept_created",LAUNCH_MESSAGE_SELLER_DIALOG:"launch_message_seller_dialog",MESSAGE_SELLER:"message_seller",SHARED_TO_GROUP:"shared_to_group",RECENT_ACTIVITY_PAGE_CONTENT:"recent_activity_page_content",RECENT_ACTIVITY_DELETE_ITEM:"recent_activity_delete_item",SAVED_SEARCH_CREATED:"saved_search_created",SAVED_SEARCH_DELETED:"saved_search_deleted",SAVED_SEARCH_NOTIFICATION_SENT:"saved_search_notification_sent",INCOMPLETE_POST_SAVED_AS_NON_FOR_SALE:"incomplete_post_saved_as_non_for_sale",GROUP_CROSS_POST_ATTEMPTED:"group_cross_post_attempted",JOIN_XPOST_ATTEMPTED:"join_xpost_attempted",MARKETPLACE_CROSSPOST_TURNED_ON:"marketplace_crosspost_turned_on",MARKETPLACE_CROSSPOST_TURNED_OFF:"marketplace_crosspost_turned_off",EDIT_SYNC_ATTEMPTED:"edit_sync_attempted",EDIT_SYNC_SUCCESS:"edit_sync_success",CROSS_POST_SUGGESTIONS_CLOSED:"cross_post_suggestions_closed",CATEGORY_SET:"category_set",SSFY_SEE_MORE_CLICK:"ssfy_see_more_click",COMPOSER_TOOLTIP_NUX_SEEN:"composer_tooltip_nux_seen",AUTHOR_COMMENT:"author_comment",GROUP_NON_FOR_SALE_POST_INTERCEPT_ATTEMPTED:"group_non_for_sale_post_intercept_attempted",GROUP_NON_FOR_SALE_POST_INTERCEPT_DETECTED:"group_non_for_sale_post_intercept_detected",GROUP_NON_FOR_SALE_POST_INTERCEPT_DECLINED:"group_non_for_sale_post_intercept_declined",GROUP_NON_FOR_SALE_POST_INTERCEPT_ACCEPTED:"group_non_for_sale_post_intercept_accepted",H_SCROLL_STORY_CLICKED:"h_scroll_story_clicked",XGROUP_ITEMS_FOR_SALE_NOTIF_OPT_OUT:"xgroup_fs_notif_opt_out",XGROUP_ITEMS_FOR_SALE_NOTIF_OPT_IN:"xgroup_fs_notif_opt_in",CLIENT_LIKE:"client_like",CLIENT_COMMENT:"client_comment",MARKETPLACE_POST_CREATION_FAIL_SIMILAR_POST:"MARKETPLACE_POST_CREATION_FAIL_SIMILAR_POST",MARKETPLACE_POST_CREATION_FAIL_NO_MARKETPLACE_ID:"marketplace_post_creation_fail_no_marketplace_id",THEME_CARD_SELL_CLICK:"theme_card_sell_click",COMPOSER_ZIP_CODE_AUTO_FILL_SUCCESS:"composer_zip_code_auto_fill_success",COMPOSER_ZIP_CODE_AUTO_FILL_FAILURE:"composer_zip_code_auto_fill_failure",COMPOSER_ZIP_CODE_INVALID_ENTRY:"composer_zip_code_invalid_entry",COMPOSER_ZIP_CODE_NO_INFERRED_COUNTRY:"composer_zip_code_no_inferred_country",COMPOSER_ZIP_CODE_LAT_LONG_NOT_FOUND:"composer_zip_code_lat_long_not_found",COMPOSER_ZIP_CODE_SAVED:"composer_zip_code_saved",COMPOSER_NEIGHBORHOOD_AUTO_FILL_SUCCESS:"composer_neighborhood_auto_fill_success",COMPOSER_NEIGHBORHOOD_AUTO_FILL_FAILURE:"composer_neighborhood_auto_fill_failure",COMPOSER_CLEAR_CROSS_POST_MENU:"composer_clear_cross_post_menu",COMPOSER_OPEN_CROSS_POST_MENU:"composer_open_cross_post_menu",COMPOSER_SELECT_RECENT_CROSS_POST_PLACES:"composer_select_recent_cross_post_places",LOCATION_GEOPROFILE_FALLBACK_NO_PREDICTED_ZIPCODE:"location_geoprofile_fallback_no_predicted_zipcode",LOCATION_NO_PREDICTED_HOME_CITY:"location_no_predicted_home_city",LOCATION_NO_PREDICTED_ZIPCODE:"location_no_predicted_zipcode",LOCATION_NO_BUY_LOCATION:"location_no_buy_location",LOCATION_NO_SELL_LOCATION:"location_no_sell_location",LOCATION_NO_SELL_LOCATION_LS_IS_OFF:"location_no_sell_location_is_off",LOCATION_RESET_SELL_LOCATION:"location_reset_sell_location",COMMERCE_INVENTORY_ENTER:"commerce_inventory_enter",COMPOSER_GROUP_SALE_POST_INTERCEPT:"composer_group_sale_post_intercept",COMPOSER_GROUP_SALE_POST_INTERCEPT_ACCEPTED:"composer_group_sale_post_intercept_accepted",COMPOSER_GROUP_SALE_POST_INTERCEPT_DECLINED:"composer_group_sale_post_intercept_declined",COMPOSER_INIT_WITH_MEDIA:"composer_init_with_media",COMPOSER_POST_WITH_MEDIA:"composer_post_with_media",FOR_SALE_ITEM_MESSAGE_SELLER_BUTTON_CLICKED:"for_sale_item_message_seller_button_clicked",FOR_SALE_ITEM_SAVE_BUTTON_CLICKED:"for_sale_item_save_button_clicked",FOR_SALE_ITEM_SEE_DETAILS_BUTTON_CLICKED:"for_sale_item_see_details_button_clicked",COMCOM_TEL_CLICK:"comcom_tel_click",COMCOM_COPY_NUM_CLICK:"comcom_copy_num_click",COMCOM_NUM_CLICK:"comcom_num_click",COMCOM_CREATE_CONTACT_CLICK:"comcom_create_contact_click",COMCOM_SEND_SMS_CLICK:"comcom_send_sms_click",COMCOM_METADATA_TAG_CLICK:"comcom_metadata_tag_click",MESSAGING_THREAD_CREATED:"messaging_thread_created",GROUP_MALL_TOP_CATEGORIES_VIEW:"group_mall_top_categories_view",CATEGORY_CLICK:"category_click",TOP_CATEGORIES_SEE_ALL_CLICK:"top_categories_see_all_click",REMOVE_SALE_FORMAT:"remove_sale_format",ATTACKER_OVERWROTE_STATUS:"attacker_overwrote_status",NF_PIVOT_HSCROLL_VIEW:"nf_pivot_hscroll_view",NF_PIVOT_HSCROLL_SEE_MORE_CLICK:"nf_pivot_hscroll_see_more_click",NF_PIVOT_HSCROLL_CARD_CLICK:"nf_pivot_hscroll_card_click",NF_PIVOT_HSCROLL_CARD_IMPRESSION:"nf_pivot_hscroll_card_impression",ADDRESS_ADD_FAILED:"address_add_failed",ADDRESS_ADD_SUCCESS:"address_add_success",LABEL_CREATED:"label_created",LABEL_CREATION_FAILED:"label_creation_failed"})}),null);
__d("GroupSellLogger",["GroupSellSurface","GroupSellUserActionEvents","GroupSellUserActionsTypedLogger"],(function(a,b,c,d,e,f,g,h,i){"use strict";__p&&__p();var j={logComposerTooltipNUXSeen:function(a){new i().setEvent(h.COMPOSER_TOOLTIP_NUX_SEEN).setGroupID(a).log()},_formatComposerInterceptWords:function(a,b){var c=[];b&&(c=b.slice());a&&a>0&&c.push(a.toString()+" prices count");return c.join(",")},logComposerInterceptAttempted:function(a){new i().setEvent(h.GROUP_NON_FOR_SALE_POST_INTERCEPT_ATTEMPTED).setGroupID(a).log()},logComposerInterceptDetected:function(a,b,c){new i().setEvent(h.GROUP_NON_FOR_SALE_POST_INTERCEPT_DETECTED).setGroupID(a).setInterceptWords(j._formatComposerInterceptWords(b,c)).log()},logComposerInterceptCreated:function(a,b,c){new i().setEvent(h.GROUP_NON_FOR_SALE_POST_INTERCEPT_CREATED).setGroupID(a).setInterceptWords(j._formatComposerInterceptWords(b,c)).log()},logComposerInterceptAccepted:function(a,b,c){new i().setEvent(h.GROUP_NON_FOR_SALE_POST_INTERCEPT_ACCEPTED).setGroupID(a).setInterceptWords(j._formatComposerInterceptWords(b,c)).log()},logComposerInterceptDeclined:function(a,b,c){new i().setEvent(h.GROUP_NON_FOR_SALE_POST_INTERCEPT_DECLINED).setGroupID(a).setInterceptWords(j._formatComposerInterceptWords(b,c)).log()},logHScrollViewPermalink:function(a,b){new i().setEvent(h.H_SCROLL_STORY_CLICKED).setGroupID(a).setGroupMessageID(b).log()},logNLUTimeout:function(a){new i().setEvent(h.GROUP_NON_FOR_SALE_POST_NLU_TIMEOUT).setGroupID(a).log()},logNLUError:function(a){new i().setEvent(h.GROUP_NON_FOR_SALE_POST_NLU_ERROR).setGroupID(a).log()},logNonForSaleMarkAsSold:function(a,b,c){new i().setEvent(h.NON_FOR_SALE_MARK_AS_SOLD).setGroupID(a).setGroupMessageID(b).setDescription(c).setSurface(g.DELETE_INTERCEPT).log()},logClearCrossPostMenu:function(a){new i().setEvent(h.COMPOSER_CLEAR_CROSS_POST_MENU).setGroupID(a).log()},logOpenCrossPostMenu:function(a,b){new i().setEvent(h.COMPOSER_OPEN_CROSS_POST_MENU).setGroupID(a).addToExtraData("has_recent_places",b.toString()).log()},logSelectRecentPlaces:function(a){new i().setEvent(h.COMPOSER_SELECT_RECENT_CROSS_POST_PLACES).setGroupID(a).log()}};e.exports=j}),null);
__d("intlList",["React","fbt","invariant"],(function(a,b,c,d,e,f,g,h,i){"use strict";__p&&__p();var j={AND:"AND",NONE:"NONE",OR:"OR"},k={COMMA:"COMMA",SEMICOLON:"SEMICOLON"};a=function(a,b,c){__p&&__p();b=b||j.AND;c=c||k.COMMA;var d=a.length;if(d===0)return"";else if(d===1)return a[0];var e=a[d-1],f=a[0];for(var g=1;g<d-1;++g)switch(c){case k.SEMICOLON:f=h._("{previous items}; {following items}",[h._param("previous items",f),h._param("following items",a[g])]);break;default:f=h._("{previous items}, {following items}",[h._param("previous items",f),h._param("following items",a[g])])}return l(f,e,b,c)};function l(a,b,c,d){switch(c){case j.AND:return h._("{list of items} y {last item}",[h._param("list of items",a),h._param("last item",b)]);case j.OR:return h._("{list of items} o {last item}",[h._param("list of items",a),h._param("last item",b)]);case j.NONE:switch(d){case k.SEMICOLON:return h._("{previous items}; {last item}",[h._param("previous items",a),h._param("last item",b)]);default:return h._("{list of items}, {last item}",[h._param("list of items",a),h._param("last item",b)])}default:i(0,568,c)}}a.DELIMITERS=k;a.CONJUNCTIONS=j;e.exports=a}),null);
__d("MCompositionFormatFields",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({FORMAT_ID:"format_id",PREVIOUS_FORMAT_ID:"prev_format_id"})}),null);
__d("MCompositionFormatID",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({PHOTO:"photo",SLIDESHOW:"slideshow"})}),null);
__d("MCompositionPageRecommendationsFields",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({ENTRY_POINT:"entry_point",PAGE_ID:"page_id",PAGE_NAME:"page_name",RECOMMENDATION_TYPE:"recommendation_type",SURFACE:"surface"})}),null);
__d("MCompositionSlideshowFields",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({IS_VALID:"is_valid"})}),null);
__d("PrivacyRemindersLoggingTypes",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({ONLY_ME_IMPRESSION:"only_me_impression",ONLY_ME_CONVERSION:"only_me_conversion",EVERYONE_IMPRESSION:"everyone_impression",EVERYONE_CONVERSION:"everyone_conversion",EVERYONE_TESTS_IMPRESSION:"everyone_tests_impression",EVERYONE_TESTS_CONVERSION:"everyone_tests_conversion",PUBLIC_POSTING_FILTER_NUX_IMPRESSION:"public_posting_filter_nux_impression",PUBLIC_POSTING_FILTER_NUX_CONVERSION:"public_posting_filter_nux_conversion",DELTA_EVERYONE_IMPRESSION:"delta_everyone_impression",DELTA_EVERYONE_CONVERSION:"delta_everyone_conversion",DELTA_EVERYONE_OK_BUTTON_CLICKED:"delta_everyone_ok_button_clicked",DELTA_EVERYONE_CHANGE_BUTTON_CLICKED:"delta_everyone_change_button_clicked"})}),null);
__d("SlideshowCreationWaterfallEvent",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({SLIDESHOW_INTENT:"intent_slideshow",SLIDESHOW_CANCEL:"cancel_slideshow",SLIDESHOW_POST:"post_slideshow",SLIDESHOW_PREVIEW_INTENT:"intent_slideshow_preview",SLIDESHOW_PREVIEW_CANCEL:"cancel_slideshow_preview",SLIDESHOW_IMAGE_UPLOAD_STARTED:"image_upload_started_slideshow",SLIDESHOW_IMAGE_UPLOAD_SUCCESS:"image_upload_success_slideshow",SLIDESHOW_IMAGES_SELECT_CONFIRM:"images_select_confirm_slideshow",SLIDESHOW_IMAGE_REMOVE:"image_remove_slideshow",SLIDESHOW_ADD_VIDEO_CLICK:"add_video_click_slideshow",SLIDESHOW_VIDEO_UPLOAD_START:"video_upload_start_slideshow",SLIDESHOW_VIDEO_UPLOAD_ERROR:"video_upload_error_slideshow",SLIDESHOW_VIDEO_UPLOAD_SUCCESS:"video_upload_success_slideshow",SLIDESHOW_FRAME_IMAGES_START:"frame_images_start_slideshow",SLIDESHOW_FRAME_IMAGES_SUCCESS:"frame_images_success_slideshow",SLIDESHOW_FRAME_IMAGES_ERROR:"frame_images_error_slideshow",SLIDESHOW_STORYLINE_MOOD_SELECT:"storyline_mood_select_slideshow",SLIDESHOW_MUSIC_CATEGORY_SELECT:"music_category_select_slideshow",SLIDESHOW_STORYLINE_MOOD_REMOVE:"storyline_mood_remove_slideshow",SLIDESHOW_STORYLINE_MOOD_DELETE:"storyline_mood_delete_slideshow",SLIDESHOW_AUDIO_UPLOAD_START:"audio_upload_start_slideshow",SLIDESHOW_AUDIO_UPLOAD_ERROR:"audio_upload_error_slideshow",SLIDESHOW_AUDIO_UPLOAD_SUCCESS:"audio_upload_success_slideshow",SLIDESHOW_DURATION_CHANGE:"duration_change_slideshow",SLIDESHOW_TRANSITION_CHANGE:"transition_change_slideshow",SLIDESHOW_FORMAT_CHANGE:"format_change_slideshow",SLIDESHOW_TAB_CHANGE:"tab_change_slideshow"})}),null);
__d("UnpublishedContentTypeJSConstants",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({PUBLISHED:0,SCHEDULED:1,DRAFT:2,ADS_POST:3,GLOBAL_CONTENT:4,PREVIEW:5,INLINE_CREATED:6,VALIDATION:7,LOCATION:8,INSTANT_ARTICLE:9,TAROT_DIGEST:10,BOOST_CANDIDATE:11,REVIEWABLE_BRANDED_CONTENT:12,WOODHENGE:13,AD_BREAK_PREREVIEW:14})}),null);
__d("SlideshowCreationWaterfallLogger",["MarauderLogger"],(function(a,b,c,d,e,f,g){a={logEvent:function(b,c,a){c=c||{},g.log(b,a,c,void 0,void 0,void 0)}};e.exports=a}),null);
__d("SlideshowImageUtil",["immutable","SlideshowConstants","SlideshowConstants","invariant"],(function(a,b,c,d,e,f,g,h,i,j){"use strict";__p&&__p();var k=i.formats,l="-",m=24,n=1.3,o=10,p=460,q=32,r=.8,s={getCroppingSpec:function(a,b,c,d){if(d&&a){d=Object.keys(a)[0];a=a[d];return{format:h.formats.Original,topLeft:a[0],bottomRight:a[1]}}return this.getFullSizeImageBoxCroppingSpec({width:c.width?c.width:0,height:c.height?c.height:0},{width:b.width,height:b.height})},shouldCropImages:function(a){__p&&__p();var b=a[0].width,c=a[0].height;for(var a=a,d=Array.isArray(a),e=0,a=d?a:a[typeof Symbol==="function"?Symbol.iterator:"@@iterator"]();;){var f;if(d){if(e>=a.length)break;f=a[e++]}else{e=a.next();if(e.done)break;f=e.value}f=f;if(f.width!==b||f.height!==c)return!0}return!1},getCrops:function(a,b,c){a=this.calculateDefaultCoordinates(a,c);return c={},c[b]=a,c},calculateCropsForFormat:function(a,b,c){__p&&__p();if(!a.size)return g.Map();var d=g.Map();switch(b){case k.Original:var e=a.first();e=c.get(e.key);var f=e.height,i=e.width;a.forEach(function(a){d=d.set(a.key,this.getCrops(c.get(a.key),i+h.SIZE_DELIMITER+f,i/f))}.bind(this));break;case k.Wide:a.forEach(function(a){d=d.set(a.key,this.getCrops(c.get(a.key),b,h.LANDSCAPE_ASPECT_RATIO))}.bind(this));break;case k.Square:a.forEach(function(a){d=d.set(a.key,this.getCrops(c.get(a.key),b,h.SQUARE_ASPECT_RATIO))}.bind(this));break;case k.Vertical:a.forEach(function(a){d=d.set(a.key,this.getCrops(c.get(a.key),b,h.VERTICAL_ASPECT_RATIO))}.bind(this));break;default:}return d},calculateDefaultCoordinates:function(a,b){var c,d;a.width/b>a.height?(c=a.height,d=a.height*b):(d=a.width,c=a.width/b);b=(a.width-d)/2;a=(a.height-c)/2;var e=Math.floor(b)-b,f=Math.floor(a)-a;return[[b+e,a+f],[Math.round(b+d+e),Math.round(a+c+f)]]},getPreviewBoxDimensions:function(a,b){__p&&__p();var c=b,d=b;if(a.length>0){a=a[0];a=Object.keys(a)[0];switch(a){case h.formats.Wide:c=b/h.LANDSCAPE_ASPECT_RATIO;break;case h.formats.Vertical:d=b*h.VERTICAL_ASPECT_RATIO;break;case h.formats.Square:break;default:b=a.split(h.SIZE_DELIMITER);a=Number(b[0]);b=Number(b[1]);a>b?c=Math.floor(d*b/a):d=Math.floor(c*a/b);break}}return{width:d,height:c}},getFullSizeImageBoxCroppingSpec:function(a,b){b=b.width/b.height;a=this.calculateDefaultCoordinates(a,b);a.length===2||j(0,1043);return{format:h.formats.Original,topLeft:a[0],bottomRight:a[1]}},getDefaultCroppingSpec:function(a){a=this.calculateDefaultCoordinates(a,1);a.length===2||j(0,1043);return{format:h.formats.Square,topLeft:a[0],bottomRight:a[1]}},getHorizontalAlignmentForAPI:function(a){a=a.split(l);return a[1]},getFontSize:function(a){return Math.floor(m*a)},getFontWeight:function(a){return a?"bold":"normal"},getLineHeight:function(){return n},getOpacity:function(){return r},getTextoverlayMaxEdge:function(a,b){return a-q*b*2-o*b*2},getTextoverlayPadding:function(a){return o*a},getTextoverlayMargin:function(a){return q*a},getScaleMultiplierFromCrops:function(a){a=Object.keys(a)[0];a=a.split(h.SIZE_DELIMITER);var b=Number(a[0]);a=Number(a[1]);return s.getScaleMultiplier(b,a)},getScaleMultiplier:function(a,b){return Math.max(a/p,b/p)},getOuterTextboxCoordinatesForAPI:function(a,b,c){a=Object.keys(a)[0];a=a.split(h.SIZE_DELIMITER);var d=Number(a[0]);a=Number(a[1]);d=s.calculateTextboxCoordinates(a,d,b,c);return[Math.floor(d.marginLeft),Math.floor(a-d.marginTop-d.textHeight),Math.ceil(d.marginLeft+d.textWidth),Math.ceil(a-d.marginTop)]},getInnerTextboxCoordinatesForAPI:function(a,b,c){a=Object.keys(a)[0];a=a.split(h.SIZE_DELIMITER);var d=Number(a[0]);a=Number(a[1]);d=s.calculateTextboxCoordinates(a,d,b,c);return[Math.floor(d.marginLeft),Math.floor(a-d.marginTop-d.textHeight),Math.ceil(d.marginLeft+d.textWidth),Math.ceil(a-d.marginTop)]},convertHexToRGBA:function(a){if(!a)return null;a=a.replace("#","");var b=parseInt(a.substring(0,2),16),c=parseInt(a.substring(2,4),16);a=parseInt(a.substring(4,6),16);return"rgba("+b+","+c+","+a+","+s.getOpacity()+")"},calculateTextboxCoordinates:function(a,b,c,d){__p&&__p();var e=c.text_alignment.split(l),f=e[1];e=e[0];var g=s.getFontSize(d),h=s.getTextoverlayMaxEdge(b,d),i=s.getTextoverlayMaxEdge(a,d),j=document.createElement("div");j.textContent=c.textoverlay_content?c.textoverlay_content:"";j.style.visibility="hidden";j.style.display="inline-block";j.style.wordWrap="break-word";j.style.whiteSpace="pre-wrap";j.style.fontFamily=c.font;j.style.fontWeight=s.getFontWeight(c.bold);j.style.fontSize=g+"px";j.style.textAlign=f;j.style.maxWidth=h+"px";j.style.maxHeight=i+"px";j.style.lineHeight=s.getLineHeight()*g+"px";j.style.padding=s.getTextoverlayPadding(d)+"px";j.style.letterSpacing="0.2px";document.body.appendChild(j);c=j.clientWidth;h=j.clientHeight;document.body.removeChild(j);i=q*d;g=q*d;j=b-q*d;var k=a-q*d;f=="center"?i=Math.min((b-c)/2,j):f=="right"&&(i=Math.min(b-q*d-c,j));e=="center"?g=Math.min((a-h)/2,k):e=="bottom"&&(g=Math.min(a-q*d-h,k));return{marginLeft:i,marginTop:g,textHeight:h,textWidth:c}}};e.exports=s}),null);
__d("SlideshowFrameImage.react",["Image.react","React","SlideshowImageUtil"],(function(a,b,c,d,e,f,g,h,i){"use strict";__p&&__p();var j;j=babelHelpers.inherits(a,h.Component);j&&j.prototype;a.prototype.$5=function(){__p&&__p();this.props.croppingSpec?(this.$3={width:this.props.imageWidth,height:this.props.imageHeight},this.$4={x:-this.props.croppingSpec.topLeft[0],y:-this.props.croppingSpec.topLeft[1]},this.$1={width:this.props.croppingSpec.bottomRight[0]+this.$4.x,height:this.props.croppingSpec.bottomRight[1]+this.$4.y}):(this.$3={width:this.props.imageWidth,height:this.props.imageHeight},this.$4={x:0,y:0},this.$1={width:this.props.imageWidth,height:this.props.imageHeight});if(this.props.fitToMaxHeightAndWidth){var a=this.props.maxWidth/this.$1.width;this.$3.width*=a;this.$4.x*=a;this.$1.width*=a;a=this.props.maxHeight/this.$1.height;this.$3.height*=a;this.$4.y*=a;this.$1.height*=a}else{a=Math.min(this.props.maxWidth/this.$1.width,this.props.maxHeight/this.$1.height);this.$3.width*=a;this.$3.height*=a;this.$4.x*=a;this.$4.y*=a;this.$1.width*=a;this.$1.height*=a}this.$2={x:(this.props.maxWidth-this.$1.width)/2,y:(this.props.maxHeight-this.$1.height)/2}};a.prototype.$6=function(){var a=this.props.textoverlay,b=i.getScaleMultiplier(this.props.maxWidth,this.props.maxHeight);if(!a||!a.textoverlay_content)return null;var c=i.calculateTextboxCoordinates(this.props.maxHeight,this.props.maxWidth,a,b),d=a.text_alignment.split("-")[1];return h.createElement("div",{style:{backgroundColor:i.convertHexToRGBA(a.background_color),color:a.font_color,position:"absolute",fontFamily:a.font,fontSize:i.getFontSize(b),fontWeight:i.getFontWeight(a.bold),letterSpacing:"0.2px",lineHeight:i.getLineHeight(),marginLeft:c.marginLeft,marginTop:c.marginTop,maxHeight:i.getTextoverlayMaxEdge(this.props.maxHeight,b),maxWidth:i.getTextoverlayMaxEdge(this.props.maxWidth,b),overflow:"hidden",overflowWrap:"break-word",padding:i.getTextoverlayPadding(b),textAlign:d,whiteSpace:"pre-wrap"}},a.textoverlay_content)};a.prototype.render=function(){this.$5();return h.createElement("div",{className:this.props.className,style:{position:this.props.positionStyle,width:this.$1.width,height:this.$1.height,left:this.$2.x,top:this.$2.y,overflow:"hidden"}},h.createElement(g,{src:this.props.imageSrc,width:this.$3.width,height:this.$3.height,style:{position:"absolute",left:this.$4.x,top:this.$4.y}}),this.$6())};function a(){j.apply(this,arguments)}a.defaultProps={className:null,croppingSpec:null,fitToMaxHeightAndWidth:!1,positionStyle:"absolute",textoverlay:null};e.exports=a}),null);