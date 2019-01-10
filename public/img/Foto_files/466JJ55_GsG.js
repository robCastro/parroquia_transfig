if (self.CavalryLogger) { CavalryLogger.start_js(["l49yM"]); }

__d("FeedStoryCategory",[],(function(a,b,c,d,e,f){e.exports={UNKNOWN:0,ORGANIC:1,ENGAGEMENT:2,FIXED_POSITION:3,PROMOTION:4,SPONSORED:5,END_OF_FEED_CONTENT:6,FB_STORIES:7,HIGH_VALUE_PROMOTION:8}}),null);
__d("MStoriesStratcomEvents",[],(function(a,b,c,d,e,f){"use strict";a={DELETE_BUCKET:"fb:stories:mobile:story:viewer:story:deleted",DELETE_THREAD:"fb:stories:mobile:story:viewer:delete:thread",MUTE_BUCKET:"fb:stories:mobile:story:viewer:story:muted",MEDIA_PAUSE:"m:stories:thread:media:pause",MEDIA_PAUSE_WITH_COVER:"m:stories:thread:media:pause:with:cover",MEDIA_PLAY:"m:stories:thread:media:play",NEXT_BUCKET:"fb:stories:mobile:story:viewer:nextBucket",NEXT_CARD:"fb:stories:mobile:story:viewer:nextCard",PREV_BUCKET:"fb:stories:mobile:story:viewer:prevBucket",THREAD_MODAL_HIDE:"m:stories:card:modal:hide",VIDEO_PLAY:"m:video:player:play",VIDEO_PLAYING:"m:video:player:playing",VIEWER_SHEET_HIDE:"m-stories-viewer-sheet-hide",PRODUCTION_PREVIEW_CONTROLS_HIDE:"m:stories:production:preview-controls:hide",PRODUCTION_PREVIEW_CONTROLS_SHOW:"m:stories:production:preview-controls:show",PRODUCTION_TEXT_CONTROLS_HIDE:"m:stories:production:text-controls:hide",PRODUCTION_TEXT_CONTROLS_SHOW:"m:stories:production:text-controls:show",PRODUCTION_TEXT_OVERLAY_REMOVE:"m:stories:production:text-overlay:remove",PRODUCTION_TEXT_OVERLAY_FOCUS:"m:stories:production:text-overlay:focus",SWIPE_LEFT:"m:stories:swipe:left",SWIPE_RIGHT:"m:stories:swipe:right",SWIPE_DOWN:"m:stories:swipe:down",SWIPE_UP:"m:stories:swipe:up",SWIPE_REPLY:"fb:stories:mobile:story:viewer:swipe:reply",TOAST_SHOWING:"m:stories:toast:showing",TOAST_HIDING:"m:stories:toast:hiding",UPLOAD_FAILED:"m:stories:upload:failed",UPLOAD_SUCCESS:"m:stories:upload:success",OVERLAY_INTERACTION_PAUSE:"m:stories:overlay-interaction:pause",OVERLAY_INTERACTION_PLAY:"m:stories:overlay-interaction:play",SET_BUCKET_IDS_USE_FOR_TESTING_ONLY:"m:stories:set-bucket-ids-use-for-testing-only"};e.exports=a}),null);
__d("MFBStoriesTraySigil",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({POG:"m-stories-tray-pog",POG_CONTAINER:"m-stories-tray-pog-container",POG_PICTURE:"m-stories-tray-pog-picture",ARCHIVE_LINK:"m-stories-tray-archive-link",TRAY_ITEM_PREVIEW:"m-stories-tray-item-preview",RECTANGULAR_ITEM_COUNT:"m-stories-rectangular-item-count",RECTANGULAR_ITEM_COUNT_ERROR:"m-stories-rectangular-item-count-error",RECTANGULAR_ITEM_ADDING_STORY_TITLE:"m-stories-rectangular-item-adding-story-title",RECTANGULAR_ITEM_STORY_ERROR_TITLE:"m-stories-rectangular-item-story-error-title",RECTANGULAR_ITEM_TITLE:"m-stories-rectangular-item-title"})}),null);
__d("MFBStoriesTrayType",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({CIRCULAR:"circular",FBLITE_WITH_PROFILE_POG:"fblite_with_profile_pog"})}),null);
__d("MStoriesDOMUtils",["Bootloader","DOM"],(function(a,b,c,d,e,f,g,h){"use strict";__p&&__p();a={find:function(a,b,c){a=h.scry(a,b,c);if(a.length===0){g.loadModules(["FBLogger"],function(a){a("fbstories").mustfix("Failed to load dom element with tag %s and sigil %s",b,c||"")},"MStoriesDOMUtils");return null}return a[0]}};e.exports=a}),null);
__d("MStoriesGating",["gkx"],(function(a,b,c,d,e,f,g){"use strict";a={genShouldShowTextOverlays:function(){return g("676798")},genShouldShowStoriesEffects:function(){return g("676799")},shouldShowOptimisticPreviews:function(){return g("676800")}};e.exports=a}),null);
__d("MStoriesHideHeaderListener",["Bootloader","MArrays","MStoriesUIConstants","Stratcom","URI"],(function(a,b,c,d,e,f,g,h,i,j,k){"use strict";__p&&__p();var l="m:page:render:start";a={_hideHeaderListener:null,setup:function(){if(this._hideHeaderListener)return;this._hideHeaderListener=j.listen(l,null,function(a){a=new k(a.getData().path);a=a.getPath();h.findPrefix(i.HIDE_HEADER_URLS,a)&&(g.loadModules(["MStoriesDisplayUtils"],function(a){a.toggleChromeBar(!1)},"MStoriesHideHeaderListener"),j.removeCurrentListener(),this._hideHeaderListener=null)}.bind(this))}};e.exports=a}),null);
__d("MStoriesID",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({LOADING_SCREEN:"m-stories-viewer-thread-loading-spinner",PRIVACY_BLACKLIST_DIV:"m-stories-privacy-selector-blacklist",PRODUCTION_ADD_ITEM_DIV:"m-stories-add-item",PRODUCTION_ADD_ITEM_POG:"m-stories-add-item-pog",PRODUCTION_OWNER_ITEM_DIV:"m-stories-owner-bucket",PRODUCTION_OWNER_ITEM_POG:"m-stories-owner-bucket-pog",PRODUCTION_INPUT:"m-stories-production-input",PRODUCTION_ROOT:"m-stories-production-root",TRAY_DIV:"story_tray",PRODUCTION_COLOR_PICKER_PREFIX:"color-picker-",ARCHIVE_INTRO_DIALOG_BOX:"m-stories-archive-intro-dialog-box",PRODUCTION_EFFECTS_PREFIX:"effect-",VIEWER_ANCHOR:"m-stories-viewer-anchor",VIEWER_SHEET_ROOT:"m-stories-viewer-sheet-root"})}),null);
__d("MStoriesProductionTrayUtils",["CSS","MFBStoriesGatingConfig","MFBStoriesTraySigil","MFBStoriesTrayType","MStoriesDOMUtils","MStoriesID","MStoriesProductionInfo","MStoriesUploadStatus","cx"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o){"use strict";__p&&__p();var p={getAnimationPog:function(){var a=document.getElementById(l.PRODUCTION_OWNER_ITEM_POG);return a?a:document.getElementById(l.PRODUCTION_ADD_ITEM_POG)},getUploadingClass:function(){var a=h.trayType;return a===j.FBLITE_WITH_PROFILE_POG?"_6pvo":"_1zpf"},updateProductionPog:function(){__p&&__p();var a=m.getUploadStatus();if(a===n.UPLOADING){var b=p.getAnimationPog(),c=document.getElementById(l.PRODUCTION_ADD_ITEM_POG),d=document.getElementById(l.PRODUCTION_ADD_ITEM_DIV),e=document.getElementById(l.PRODUCTION_OWNER_ITEM_POG),f=p.getUploadingClass();b&&(g.addClass(b,f),b.id===l.PRODUCTION_OWNER_ITEM_POG?(c&&g.removeClass(c,f),d&&g.addClass(d,"disable")):(e&&g.removeClass(e,f),d&&g.removeClass(d,"disable")))}b=h.trayType;if(b!==j.CIRCULAR){c=document.getElementById(l.PRODUCTION_OWNER_ITEM_DIV);if(c){e=c.getAttribute("data-is-optimistic-item")!=null;f=a===n.UPLOADING||a===n.FAILED;e&&(f?g.removeClass(c,"hidden"):g.addClass(c,"hidden"))}this._updateProductionItemText()}this._updateErrorState()},_updateProductionItemText:function(){__p&&__p();var a=document.getElementById(l.PRODUCTION_OWNER_ITEM_DIV);if(!a)return;var b=k.find(a,"div",i.RECTANGULAR_ITEM_TITLE);a=k.find(a,"div",i.RECTANGULAR_ITEM_ADDING_STORY_TITLE);if(b&&a){var c=m.getUploadStatus();switch(c){case n.UPLOADING:g.addClass(b,"hidden");g.removeClass(a,"hidden");break;default:g.addClass(a,"hidden");g.removeClass(b,"hidden");break}}},_updateErrorState:function(){__p&&__p();var a=m.getUploadStatus(),b=h.trayType;switch(b){case j.FBLITE_WITH_PROFILE_POG:b=document.getElementById(l.PRODUCTION_OWNER_ITEM_DIV);if(b!=null){var c=k.find(b,"div",i.RECTANGULAR_ITEM_COUNT);b=k.find(b,"div",i.RECTANGULAR_ITEM_COUNT_ERROR);c&&b&&(a===n.FAILED?(g.addClass(c,"hiddenByError"),g.removeClass(b,"hidden")):(g.removeClass(c,"hiddenByError"),g.addClass(b,"hidden")))}break;default:c=this.getAnimationPog();c&&(a===n.FAILED?g.addClass(c,"_4ts1"):g.removeClass(c,"_4ts1"));break}}};e.exports=p}),null);
__d("MStoriesTrayUIConstants",[],(function(a,b,c,d,e,f){"use strict";a={REDIRECT_DELAY_IN_MS:20};e.exports=a}),null);
__d("MStoriesTrayAsync",["Bootloader","CSS","DOM","MFBStoriesGatingConfig","MFBStoriesTraySigil","MFBStoriesTrayType","MPageController","MStoriesDOMUtils","MStoriesGating","MStoriesHideHeaderListener","MStoriesID","MStoriesProductionTrayUtils","MStoriesStratcomEvents","MStoriesTrayInfo","MStoriesTrayUIConstants","Run","Stratcom","cx","requireCond","cr:710451","MFBStoriesOptimisticTrayGatedModule"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z){__p&&__p();var A=b("MFBStoriesOptimisticTrayGatedModule").module,B="m:page:render:cache:complete-with-replays";a={_currentItemLoading:null,_listeners:[],_spinner:null,updateSpinner:function(a){__p&&__p();this._spinner=a.spinner,this._listeners.length===0&&(this._listeners=[w.listen(B,null,function(){if(!t.getTrayNeedsRefresh())return;g.loadModules(["MStoriesTrayUtils"],function(a){a.refreshTray()},"MStoriesTrayAsync")}),w.listen("click",k.ARCHIVE_LINK,this._openArchive),w.listen("click",k.POG_CONTAINER,function(a){__p&&__p();var b=a.getNode(k.POG_CONTAINER);if(this._currentItemLoading){if(this._currentItemLoading===b)return;this._setLoadingStateHidden(this._currentItemLoading,!0)}if(!b)return;b.id===q.PRODUCTION_OWNER_ITEM_DIV?g.loadModules(["MStoriesProductionTrayAsync"],function(a){if(!b)return;if(a.handleFailedAddToStoryPogSelected())return;this._openViewer(b)}.bind(this),"MStoriesTrayAsync"):this._openViewer(b)}.bind(this)),w.listen(s.UPLOAD_SUCCESS,null,function(a){a=a.getData()||{};A&&A.handleUploadSuccess(a.newThreadID,a.optimisticThreadID)})]),p.setup(),A&&A.initializeOnTrayLoad(),r.updateProductionPog(),v.onLeave(function(){this._destroy()}.bind(this))},_openArchive:function(a){a=a.getNode(k.ARCHIVE_LINK);if(a!=null){var b=a.getAttribute("data-href");b&&window.setTimeout(function(){m.load(b,{hideLoadingIndicator:!1})})}},_setLoadingStateHidden:function(a,b){var c=j.trayType;b=b?h.removeClass:h.addClass;switch(c){case l.CIRCULAR:b(a,"loading");break;case l.FBLITE_WITH_PROFILE_POG:b(a,"_6pvo");break}},_openViewer:function(a){__p&&__p();this._currentItemLoading=a;var b=j.trayType;b=b!==l.CIRCULAR;if(!b){b=n.find(a,"i",k.POG_PICTURE);b!==null&&i.insertAfter(b,this._spinner)}var c=a.getAttribute("data-href");o.shouldShowOptimisticPreviews()&&a.id===q.PRODUCTION_OWNER_ITEM_DIV&&A&&(c=A.getURI(a));c&&(this._setLoadingStateHidden(a,!1),window.setTimeout(function(){m.load(c,{hideLoadingIndicator:!0})},u.REDIRECT_DELAY_IN_MS))},_destroy:function(){var a=r.getAnimationPog();a&&h.removeClass(a,r.getUploadingClass());this._listeners.forEach(function(a){return a.remove()});this._listeners=[]}};e.exports=a}),null);
__d("AdAllocationIntegrityGapsInfo",["FeedStoryCategory"],(function(a,b,c,d,e,f,g){__p&&__p();function a(a){"use strict";this.story_category=a,this.dist_to_top=-1,this.dist_to_fixed=-1,this.dist_to_promo=-1,this.dist_to_sponsored=-1,this.dist_to_engagement=-1}a.prototype.setDistToTop=function(a){"use strict";this.dist_to_top=a};a.prototype.setDistIfAbsent=function(a,b){"use strict";__p&&__p();if(b<0||a===g.UNKNOWN||a===g.ORGANIC)return;switch(a){case g.ENGAGEMENT:this.dist_to_engagement=this.$1(b,this.dist_to_engagement);break;case g.FIXED_POSITION:this.dist_to_fixed=this.$1(b,this.dist_to_fixed);break;case g.PROMOTION:this.dist_to_promo=this.$1(b,this.dist_to_promo);break;case g.SPONSORED:this.dist_to_sponsored=this.$1(b,this.dist_to_sponsored);break}};a.prototype.$1=function(a,b){"use strict";return b===-1?a:b};e.exports=a}),null);
__d("AdAllocationIntegrityUtils",["DataAttributeUtils","FBJSON","FeedStoryCategory"],(function(a,b,c,d,e,f,g,h,i){"use strict";__p&&__p();var j="data-story_category",k="data-dedupekey";a={getFeedStoryCategory:function(a){__p&&__p();var b=h.parse(a.getAttribute("data-ft"),e.id);a=g.getDataAttribute(a,j);if(a)switch(a){case"2":return i.ENGAGEMENT;case"3":return i.FIXED_POSITION;case"4":return i.PROMOTION;default:return i.UNKNOWN}else if("ei"in b)return i.SPONSORED;else return i.ORGANIC},isGapRuleCategory:function(a){if(a===i.SPONSORED||a===i.ENGAGEMENT||a===i.FIXED_POSITION||a===i.PROMOTION)return!0;else return!1},getDedupKey:function(a){return g.getDataAttribute(a,k)}};e.exports=a}),null);
__d("FBFeedLocations",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({NEWSFEED:1,GROUP:2,GROUP_PERMALINK:3,COMMUNITY:4,PERMALINK:5,SHARE_OVERLAY:6,PERMALINK_STREAM:7,GROUP_PINNED:8,FRIEND_LIST:9,TIMELINE:10,HASHTAG_FEED:11,TOPIC_FEED:12,PAGE:13,NOTIFICATION_FEED:14,GROUP_REPORTED:15,GROUP_PENDING:16,PAGES_FEED_IN_PAGES_MANAGER:17,TICKER_CLASSIC:18,PAGES_SUGGESTED_FEED_IN_PAGES_MANAGER:19,SEARCH:20,GROUP_SEARCH:21,NO_ATTACHMENT:22,EMBED:23,EMBED_FEED:24,ATTACHMENT_PREVIEW:25,STORIES_TO_SHARE:26,PROMPT_PERMALINK:27,TREND_HOVERCARD:28,OPEN_GRAPH_PREVIEW:30,HOTPOST_IN_PAGES_FEED:31,SCHEDULED_POSTS:32,TIMELINE_NOTES:33,PAGE_INSIGHTS:34,COMMENT_ATTACHMENT:35,PAGE_TIMELINE:36,GOODWILL_THROWBACK_PERMALINK:37,LIKE_CONFIRM:39,GOODWILL_THROWBACK_PROMOTION:40,BROWSE_CONSOLE:42,GROUP_FOR_SALE_COMPACT:43,ENTITY_FEED:44,GROUP_FOR_SALE_DISCUSSION:45,PAGES_CONTENT_TAB_PREVIEW:46,GOODWILL_THROWBACK_SHARE:47,TIMELINE_VIDEO_SHARES:48,EVENT:49,PAGE_PLUGIN:50,SRT:51,PAGES_CONTENT_TAB_INSIGHTS:52,ADS_PE_CONTENT_TAB_INSIGHTS:53,PAGE_ACTIVITY_FEED:54,VIDEO_CHANNEL:55,POST_TO_PAGE:56,GROUPS_GSYM_HOVERCARD:57,GROUP_POST_TOPIC_FEED:58,FEED_SURVEY:59,PAGES_MODERATION:60,SAVED_DASHBOARD:61,PULSE_SEARCH:62,GROUP_NUX:63,GROUP_NUX_POST_VIEW:64,EVENT_PERMALINK:65,FUNDRAISER_PAGE:66,EXPLORE_FEED:67,CRT:68,REVIEWS_FEED:69,VIDEO_HOME_CHANNEL:70,NEWS:71,TIMELINE_FRIENDSHIP:72,SAVED_REMINDERS:73,PSYM:74,ADMIN_FEED:75,CAMPFIRE_NOTE:76,PAGES_CONTEXT_CARD:77,ACTIVITY_LOG:78,WALL_POST_REPORT:79,TIMELINE_BREAKUP:80,TOWN_HALL:81,PRODUCT_DETAILS:82,SPORTS_PLAY_FEED:83,GROUP_TOP_STORIES:84,PAGE_TIMELINE_PERMALINK:86,OFFERS_WALLET:87,INSTREAM_VIDEO_IN_LIVE:88,SPOTLIGHT:89,SEARCH_DERP:90,SOCIAL_BALLOT:91,GROUP_SUGGESTIONS_WITH_STORY:92,SOCIAL_BALLOT_PERMALINK:93,LOCAL_SERP:94,FUNDRAISER_SELF_DONATION_FEED:95,CONVERSATION_NUB:97,GROUP_TOP_SALE_STORIES:98,GROUP_LEARNING_COURSE_UNIT_FEED:99,SUPPORT_INBOX_READ_TIME_BLOCK:100,PAGE_POSTS_CARD:101,CRISIS_POST:102,SUPPORT_INBOX_GROUP_RESPONSIBLE:103,PAGE_POST_DIALOG:104,CRISIS_DIALOG_POST:105,PAGE_LIVE_VIDEOS_CARD:106,PAGE_POSTS_CARD_COMPACT:107,GROUP_MEMBER_BIO_FEED:108,LIVE_COMMENT_ATTACHMENT:109,GROUP_COMPOSER:110,GROUP_INBOX_GROUP:111,GROUP_INBOX_AGGREGATED:112,ENDORSEMENTS:113,EVENTS_DASHBOARD:114,CURATED_COLLECTIONS_PAGE:115,OYML:116,COLLEGE_HOMEPAGE:117,GROUP_LIVE_VIDEOS_CARD:118,COLLEGE_HIGHLIGHTS:119,VIDEO_PERMALINK:120,JOB_CAROUSEL_NETEGO:121,TOPIC_PAGE:122,USER_SCHEDULED_POSTS:123,GOODWILL_THROWBACK_ATTACHMENT_PREVIEW:124,INSTREAM_VIDEO_IN_WASLIVE:125,INSTREAM_VIDEO_IN_NONLIVE:126,SIGNAL_APP:127,ALBUM_FEED:128,TOP_MARKETPLACE_STORIES:129,CE_PII_STRIPPED_FEED:130,TAHOE:131,SAVE_COUNT_DIALOG:132,GROUP_POST_TAG_FEED:133,GOV_DIGEST:134,GROUP_SCHEDULED:135,GAMEROOM_FEED:136,WORKPLACE_HUB_PREVIEW:137,BRANDED_CONTENT_TRENDING_POSTS:138,GROUP_ANNOUNCEMENTS:139,GROUP_ANNOUNCEMENTS_FEED:140,EXTERN_CE_PII_STRIPPED_FEED:141,CRISIS_HUB_DESKTOP:142,GROUP_DRAFT_POSTS:143,TRENDING_ISSUES:144,GAME_HUB_FEED:145,LUMOS_POST_PREVIEW:146,BRANDED_CONTENT_PAGE_SETTINGS:147,BC_MULTI_POST_REVIEW:149,ADS_TRANSPARENCY_SHOW_ADS:150,POLITICAL_POST_FEED:151,RECOMMENDATIONS_DASHBOARD:152,SEEN_CONTENT:153,AGGREGATED_FEED:154,GROUP_HOISTED:155,GROUP_MENTORSHIP_OVERVIEW_FEED:156,GROUP_MENTORSHIP_CURRICULUM_FEED:157,PAGE_SURFACE_RECOMMENDATIONS:158,SURVEY_GALLERY:159,GAMING_VIDEO_STREAMER_HUB:160,GROUP_MEETUP_FEED:161,GROUP_FLAGGED_FEED:162,PAGE_RECOMMENDATIONS_TOOL:163,MEDIA_MANAGER_HOME:164,WOODHENGE_EXCLUSIVE_FEED:165,PAGE_RECOMMENDATIONS_TAB_FEED:166,GROUP_ANNOUNCEMENTS_WITH_UFI:167,GROUP_ADMIN_TO_MEMBER_FEEDBACK:168,MEDIA_MANAGER_POST_INSIGHTS:169,MISINFORMATION_FACT_CHECKER_APP:170,WORKPLACE_TEAM_FEED:171,NEWS_STORYLINE_FEED:172,PAGE_RECOMMENDATIONS_VERTEX_TAB_FEED:173,MONTHLY_ACTIVITY_DIGEST:174,ACTOR_EXPERIENCE_APPEALS:175,WORKPLACE_NEWSFEED_PROMOTED_POST:176,ASSET3D_PHOTO_FULLSCREEN:177,MARKETPLACE_MEGAMALL:178,CIVIC_PROPOSAL:179,WORKPLACE_DISCOVERY_FEED:180,CE_PII_AND_ATTACHMENTS_STRIPPED_FEED:182,SOURCERY_PII_STRIPPED:183,ACTOR_GATEWAY:191,FBR:192,NEWS_STORYLINE_NEWSFEED_QP:193,JOBS_SINGLE_GROUP_BROWSER:194,JOBS_MULTI_GROUP_BROWSER:195,ACTION_EXPERIENCE:196,GROUP_ALERTED_FEED:197,CANDIDATE_PACKET_REVIEW:198,BUSINESS_FEED:199,NEWS_OCT_DRAFT_POST_PREVIEW:200})}),null);
__d("MEntstreamViewportTracking",["AdAllocationIntegrityGapsInfo","AdAllocationIntegrityUtils","Banzai","DataAttributeUtils","DOM","ErrorUtils","FBFeedLocations","FBJSON","MHistory","MURI","MViewport","MViewportTracking","Stratcom","StratcomManager","Vector"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u){"use strict";__p&&__p();var v,w=51,x={},y=null,z=null;a=babelHelpers.inherits(A,r);v=a&&a.prototype;function A(){var a,b;for(var c=arguments.length,d=new Array(c),e=0;e<c;e++)d[e]=arguments[e];return b=(a=v.constructor).call.apply(a,[this].concat(d)),this.enableCacheReadStoryIds=!1,b}A.init=function(a){t.enableDispatch(document,"scroll"),new A().init(a)};A.prototype.init=function(a){a.enable_cache_read_story_ids&&C(),v.init.call(this,a)};A.prototype.getDataFromConfig=function(a){a=a,this.isLoose=!0,this.isTimeTrackingEnabled=!!a.vpvd_logging,this.shouldWaterfallLogging=!!a.should_waterfall_logging,this.enableAdsAllocationIntegrityLogging=!!a.enable_ads_allocation_integrity_logging,this.enableCacheReadStoryIds=!!a.enable_cache_read_story_ids};A.prototype.__getStreamRoot=function(){this.$MEntstreamViewportTracking1||(this.$MEntstreamViewportTracking1=document.getElementById("root"));return this.$MEntstreamViewportTracking1};A.prototype.getFBFeedLocation=function(){return m.NEWSFEED};A.prototype.getAllStories=function(){return k.scry(this.__getStreamRoot(),"article","story-div")};A.prototype.getTimeout=function(){return 300};A.prototype.getDataToLog=function(a){__p&&__p();var b=Object.assign(n.parse(a.getAttribute("data-ft"),e.id),{evt:w});if(!this.isTimeTrackingEnabled){var c=k.scry(a,"*","data-is-cta").map(function(a){a=j.getDataFt(a);a=a&&JSON.parse(a);return a&&a.cta_types}).filter(function(a){return!!a});b.cta_types=c}if(this.enableAdsAllocationIntegrityLogging){c=h.getFeedStoryCategory(a);var d=new g(c),f=h.getDedupKey(a);if(h.isGapRuleCategory(c)&&f!==null){c=this.getAllStories();var i=-1;for(var l=c.length-1;l>=0;l--){var m=h.getDedupKey(c[l]);if(i<0)m!==null&&f===m&&(i=l,d.setDistToTop(i+1));else{m=h.getFeedStoryCategory(c[l]);h.isGapRuleCategory(m)&&d.setDistIfAbsent(m,i-l)}}}Object.assign(b,d)}"getBoundingClientRect"in a?(m=a.getBoundingClientRect(),c=m.height,f=m.top+q.getScrollTop()):(c=u.getDim(a).y,f=u.getPos(a).y);b.evt_value=c;b.offset=f;b.story_height=c;b.impression_type=q.isLandscape()?"landscape":"portrait";this.shouldWaterfallLogging&&(b.should_waterfall_logging=1,b["interface"]="m_touch");return b};A.prototype.getWaterfallData=function(a,b){a=this.getDataToLog(a);a.step=b;return a};A.prototype.getStoryID=function(a){a=a.getAttribute("data-ft");return!a?null:n.parse(a,e.id).mf_story_key};A.prototype.sendDataToLog=function(a){i.post("feed_tracking",{ft:a})};A.prototype.onUnload=function(){v.onUnload.call(this);if(!this.enableCacheReadStoryIds||!z)return;x[z]=this.readStoryIDs};A.prototype.getCachedReadStoryIDs=function(){if(!this.enableCacheReadStoryIds||!z)return;return x[z]||null};function B(a){var b=a||o.getPath();return b?l.guard(function(){return new p(b).normalize().getPath().toLowerCase()})():null}function C(){y||(y=s.listen("m:page:request-sent",null,function(a){if(a&&a.getData){a=B(a.getData().path);a&&delete x[a]}}));var a=B();a&&z===a?delete x[a]:z=a}e.exports=A}),null);
__d("MLoadTimeOutBanner",[],(function(a,b,c,d,e,f){function g(a){a=document.getElementById(a);a&&(a.style.display="inherit")}f.init=function(a,b){setTimeout(g.bind(null,a),b)}}),null);