if (self.CavalryLogger) { CavalryLogger.start_js(["S8i2G"]); }

__d("MStoriesUIConstants",["fbt"],(function(a,b,c,d,e,f,g){"use strict";a={PROGRESS_BAR:{DEFAULT_TIMER_DURATION_IN_SEC:6,STORY_UPDATE_TICK_IN_SEC:.1},REDIRECT_DELAY_IN_MS:20,REFRESH_TIMEOUT_IN_MS:10*60*1e3,SEC_TO_MS:1e3,SWIPE_DISTANCE:80,SWIPE_DOWN_DISTANCE:150,CACHE_EXPIRATION_IN_MS:10*60*1e3,HIDE_HEADER_URLS:["/stories/view_tray","/stories/preview/"],UPLOAD_SUCCESSFUL:g._("Se ha a\u00f1adido la historia"),UPLOAD_FAILED:g._("No se puede a\u00f1adir la historia"),EFFECTS_LIST_FAILED:g._("No se pueden cargar los efectos"),EFFECT_APPLY_FAILED:g._("No se puede aplicar el efecto")};e.exports=a}),null);
__d("BanzaiConsts",[],(function(a,b,c,d,e,f){a={SEND:"Banzai:SEND",OK:"Banzai:OK",ERROR:"Banzai:ERROR",SHUTDOWN:"Banzai:SHUTDOWN",VITAL_WAIT:1e3,BASIC_WAIT:6e4,EXPIRY:30*6e4,LAST_STORAGE_FLUSH:"banzai:last_storage_flush",STORAGE_FLUSH_INTERVAL:12*60*6e4};e.exports=a}),null);
/**
 * License: https://www.facebook.com/legal/license/qZmK4zWM8-v/
 */
__d("SnappyCompress",[],(function(a,b,c,d,e,f){__p&&__p();(function a(b,c,d){__p&&__p();function e(g,h){__p&&__p();if(!c[g]){if(!b[g]){var i=typeof requireSnappy=="function"&&requireSnappy;if(!h&&i)return i(g,!0);if(f)return f(g,!0);h=new Error("Cannot find module '"+g+"'");throw h.code="MODULE_NOT_FOUND",h}i=c[g]={exports:{}};b[g][0].call(i.exports,function(a){var c=b[g][1][a];return e(c?c:a)},i,i.exports,a,b,c,d)}return c[g].exports}var f=typeof requireSnappy=="function"&&requireSnappy;for(var g=0;g<d.length;g++)e(d[g]);return e})({1:[function(c,a,b){a=window.SnappyJS||{};a.uncompress=c("./index").uncompress,a.compress=c("./index").compress,window.SnappyJS=a},{"./index":2}],2:[function(c,a,b){"use strict";__p&&__p();function a(){return"object"==typeof process&&"object"==typeof process.versions&&"undefined"!=typeof process.versions.node?!0:!1}function d(a){return a instanceof Uint8Array&&(!k||!Buffer.isBuffer(a))}function g(a){return a instanceof ArrayBuffer}function h(a){return k?Buffer.isBuffer(a):!1}function i(a){__p&&__p();if(!d(a)&&!g(a)&&!h(a))throw new TypeError(n);var b=!1,c=!1;d(a)?b=!0:g(a)&&(c=!0,a=new Uint8Array(a));a=new l(a);var e=a.readUncompressedLength();if(-1===e)throw new Error("Invalid Snappy bitstream");if(b){if(b=new Uint8Array(e),!a.uncompressToBuffer(b))throw new Error("Invalid Snappy bitstream")}else if(c){if(b=new ArrayBuffer(e),c=new Uint8Array(b),!a.uncompressToBuffer(c))throw new Error("Invalid Snappy bitstream")}else if(b=new Buffer(e),!a.uncompressToBuffer(b))throw new Error("Invalid Snappy bitstream");return b}function j(a){if(!d(a)&&!g(a)&&!h(a))throw new TypeError(n);var b=!1,c=!1;d(a)?b=!0:g(a)&&(c=!0,a=new Uint8Array(a));var e;a=new m(a);var f=a.maxCompressedLength();return b?(b=new Uint8Array(f),e=a.compressToBuffer(b)):c?(b=new ArrayBuffer(f),c=new Uint8Array(b),e=a.compressToBuffer(c)):(b=new Buffer(f),e=a.compressToBuffer(b)),b.slice(0,e)}var k=a(),l=c("./snappy_decompressor").SnappyDecompressor,m=c("./snappy_compressor").SnappyCompressor,n="Argument compressed must be type of ArrayBuffer, Buffer, or Uint8Array";b.uncompress=i,b.compress=j},{"./snappy_compressor":3,"./snappy_decompressor":4}],3:[function(c,a,b){"use strict";__p&&__p();function d(a,b){return 506832829*a>>>b}function g(a,b){return a[b]+(a[b+1]<<8)+(a[b+2]<<16)+(a[b+3]<<24)}function h(a,b,c){return a[b]===a[c]&&a[b+1]===a[c+1]&&a[b+2]===a[c+2]&&a[b+3]===a[c+3]}function i(a,b,c,d,e){var f;for(f=0;e>f;f++)c[d+f]=a[b+f]}function j(a,b,c,d,e){return 60>=c?(d[e]=c-1<<2,e+=1):256>c?(d[e]=240,d[e+1]=c-1,e+=2):(d[e]=244,d[e+1]=c-1&255,d[e+2]=c-1>>>8,e+=3),i(a,b,d,e,c),e+c}function k(a,b,c,d){return 12>d&&2048>c?(a[b]=1+(d-4<<2)+(c>>>8<<5),a[b+1]=255&c,b+2):(a[b]=2+(d-1<<2),a[b+1]=255&c,a[b+2]=c>>>8,b+3)}function l(a,b,c,d){for(;d>=68;)b=k(a,b,c,64),d-=64;return d>64&&(b=k(a,b,c,60),d-=60),k(a,b,c,d)}function m(a,b,c,e,f){__p&&__p();for(var i=1;c>=1<<i&&p>=i;)i+=1;i-=1;var k=32-i;"undefined"==typeof q[i]&&(q[i]=new Uint16Array(1<<i));var m;i=q[i];for(m=0;m<i.length;m++)i[m]=0;var n,o,r,s,t;m=b+c;var u=b,v=b,w=!0,x=15;if(c>=x)for(c=m-x,b+=1,x=d(g(a,b),k);w;){s=32,o=b;do{if(b=o,n=x,t=s>>>5,s+=1,o=b+t,b>c){w=!1;break}x=d(g(a,o),k),r=u+i[n],i[n]=b-u}while(!h(a,b,r));if(!w)break;f=j(a,v,b-v,e,f);do{for(t=b,n=4;m>b+n&&a[b+n]===a[r+n];)n+=1;if(b+=n,o=t-r,f=l(e,f,o,n),v=b,b>=c){w=!1;break}s=d(g(a,b-1),k),i[s]=b-1-u,t=d(g(a,b),k),r=u+i[t],i[t]=b-u}while(h(a,b,r));if(!w)break;b+=1,x=d(g(a,b),k)}return m>v&&(f=j(a,v,m-v,e,f)),f}function n(a,b,c){do b[c]=127&a,a>>>=7,a>0&&(b[c]+=128),c+=1;while(a>0);return c}function c(a){this.array=a}a=16;var o=1<<a,p=14,q=new Array(p+1);c.prototype.maxCompressedLength=function(){var a=this.array.length;return 32+a+Math.floor(a/6)},c.prototype.compressToBuffer=function(a){var b,c=this.array,d=c.length,e=0,f=0;for(f=n(d,a,f);d>e;)b=Math.min(d-e,o),f=m(c,e,b,a,f),e+=b;return f},b.SnappyCompressor=c},{}],4:[function(c,a,b){"use strict";__p&&__p();function d(a,b,c,d,e){var f;for(f=0;e>f;f++)c[d+f]=a[b+f]}function g(a,b,c,d){var e;for(e=0;d>e;e++)a[b+e]=a[b-c+e]}function c(a){this.array=a,this.pos=0}var h=[0,255,65535,16777215,4294967295];c.prototype.readUncompressedLength=function(){for(var a,b,c=0,d=0;32>d&&this.pos<this.array.length;){if(a=this.array[this.pos],this.pos+=1,b=127&a,b<<d>>>d!==b)return-1;if(c|=b<<d,128>a)return c;d+=7}return-1},c.prototype.uncompressToBuffer=function(a){__p&&__p();for(var b,c,e,f,i=this.array,j=i.length,k=this.pos,l=0;k<i.length;)if(b=i[k],k+=1,0===(3&b)){if(c=(b>>>2)+1,c>60){if(k+3>=j)return!1;e=c-60,c=i[k]+(i[k+1]<<8)+(i[k+2]<<16)+(i[k+3]<<24),c=(c&h[e])+1,k+=e}if(k+c>j)return!1;d(i,k,a,l,c),k+=c,l+=c}else{switch(3&b){case 1:c=(b>>>2&7)+4,f=i[k]+(b>>>5<<8),k+=1;break;case 2:if(k+1>=j)return!1;c=(b>>>2)+1,f=i[k]+(i[k+1]<<8),k+=2;break;case 3:if(k+3>=j)return!1;c=(b>>>2)+1,f=i[k]+(i[k+1]<<8)+(i[k+2]<<16)+(i[k+3]<<24),k+=4}if(0===f||f>l)return!1;g(a,l,f,c),l+=c}return!0},b.SnappyDecompressor=c},{}]},{},[1]),e.exports=SnappyJS}),null);
__d("SnappyCompressUtil",["SnappyCompress"],(function(a,b,c,d,e,f,g){"use strict";__p&&__p();var h={compressUint8ArrayToSnappy:function(a){__p&&__p();if(a==null)return null;var b=null;try{b=g.compress(a)}catch(a){return null}a="";for(var c=0;c<b.length;c++)a+=String.fromCharCode(b[c]);return window.btoa(a)},compressStringToSnappy:function(a){__p&&__p();if(window.Uint8Array===void 0||window.btoa===void 0)return null;var b=new window.Uint8Array(a.length);for(var c=0;c<a.length;c++){var d=a.charCodeAt(c);if(d>127)return null;b[c]=d}return h.compressUint8ArrayToSnappy(b)}};e.exports=h}),null);
__d("BanzaiAdapter",["BanzaiConsts","CurrentUser","DTSG","DTSGUtils","MBanzaiConfig","MRequest","MRequestConfig","MRequestDataSerializer","MSession","Run","SnappyCompressUtil","SprinkleConfig","Stratcom","Visibility","ZeroCategoryHeader"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u){__p&&__p();var v="/a/bz",w="banzai",x=[],y={config:k,endpoint:v,useBeacon:k.gks&&k.gks.mtouch_use_beacon,inform:function(a){s.invoke(a)},subscribe:function(a,b){return s.listen(a,null,b)},cleanup:function(){var a=x;x=[];a.forEach(function(a){a.abort()})},send:function(a,b,c,d){__p&&__p();var e=new l(v);e.setAutoProcess(!1);e.setData(y.prepForTransit(a));e.setRequestHeader("X_FB_BACKGROUND_STATE",1);b&&e.listen("done",b);d||e.listen("done",function(a){y.inform(g.OK)});e.listen("error",function(a){a.isHandled=!0;a=e.getTransport().status;c&&c(a);d||y.inform(g.ERROR)});m.cleanFinishedRequest&&e.listen("finally",function(){var a=x.indexOf(e);a>=0&&x.splice(a,1)});e.setFailureLogging(w);x.push(e);e.send()},readyToSend:function(){return navigator.onLine},setHooks:function(a){t.addListener("hidden",a._store),t.addListener("visible",a._restore),window.addEventListener("pagehide",a._store),window.addEventListener("pageshow",a._restore),window.addEventListener("blur",a._store),window.addEventListener("focus",a._restore)},setUnloadHook:function(a){p.onUnload(a._unload)},onUnload:function(a){p.onUnload(a)},addRequestAuthData:function(a){var b=i.getCachedToken(),c=[["fb_dtsg",b],["__ajax__",m.ajaxResponseToken.encrypted],["__user",h.getID()],["__fbbk",1]];m.lsd&&c.push(["lsd",m.lsd]);b&&r.param_name&&c.push([r.param_name,j.getNumericValue(b)]);for(var d in a)c.push([d,a[d]]);return n.defaultDataSerializer(c)},prepForTransit:function(a){a=JSON.stringify(a);return{data:a,ts:Date.now(),ph:o.push_phase}},prepWadForTransit:function(a){if(a.snappy==null||a.snappy===!0){var b=Date.now(),c=JSON.stringify(a.posts),d=q.compressStringToSnappy(c);d!=null&&d.length<c.length?(a.posts=d,a.snappy_ms=Date.now()-b):delete a.snappy}},isOkToSendViaBeacon:function(){return!u.value&&i.getCachedToken()}};e.exports=y}),null);
__d("ViewportTrackingHooks",["Base64"],(function(a,b,c,d,e,f,g){__p&&__p();var h={},i=[];a={registerFeedObject:function(a,b){h[a]=g.encode(b)},updateVisibleViewportObjects:function(a){var b=[],c=!1;for(var d=0;d<a.length;d++){var e=a[d],f=e.id;while(!(f in h)&&e.firstChild!=void 0&&e.firstChild.id!=void 0&&e.firstChild.id.startsWith("u_"))f=e.firstChild.id,e=e.firstChild;f in h&&(b.push(h[f]),(!(d in i)||i[d]!=h[f])&&(c=!0))}!c&&i.length!=b.length&&(c=!0);c&&(i=b,typeof __EXT__updateVisibleViewportObjects==="function"&&__EXT__updateVisibleViewportObjects(i))}};e.exports=a}),null);
__d("MViewportTracking",["DataAttributeUtils","DOM","FBJSON","MPageController","MViewport","NavigationMetrics","Stratcom","Style","Vector","ViewportTrackingHooks","Visibility","VisibilityTrackingHelper","gkx","invariant","onAfterTTI","setTimeoutAcrossTransitions"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v){"use strict";__p&&__p();var w=97,x=200,y=new Map();function z(){this.$2=[],this.debugConsole=!1,this.activeStories={},this.cachedViewportHeight=0,this.discardVPVDIntervalThreshold=9e4,this.isLoose=!1,this.isTimeTrackingEnabled=!1,this.latestTimeTrackingTimestamp=0,this.maxScrollPosition=0,this.minSizeToBeVisible=0,this.readStoryIDs={},this.relaxedMinSize=!1,this.throttleNoDelay=!1,this.trackingHooks=!1,this.vpvdDebug=!1,this.vpvDebug=!1,this.enableAdsAllocationIntegrityLogging=!1}z.prototype.getDataFromConfig=function(a){t(0,2199)};z.prototype.getStoryID=function(a){t(0,2200)};z.prototype.getDataToLog=function(a){t(0,2201)};z.prototype.sendDataToLog=function(a){t(0,2202)};z.prototype.getTimeout=function(){t(0,2203)};z.prototype.getAllStories=function(){t(0,2204)};z.prototype.init=function(a){__p&&__p();this.isLoose=!!a.is_loose;this.throttleNoDelay=!!a.throttle_no_delay;this.relaxedMinSize=!!a.relaxed_min_size;this.vpvDebug=!!a.vpv_debug;this.trackingHooks=!!a.tracking_hooks;this.isTimeTrackingEnabled=!1;var b=z.shouldRunTrackingAfterTTI();b||(this.cachedViewportHeight=k.getHeight());this.getDataFromConfig(a);this.maxScrollPosition=0;this.readStoryIDs=this.getCachedReadStoryIDs()||{};this.$2=[m.listen("m:page:unload",null,this.onUnload.bind(this)),m.listen("m:viewport:update-complete",null,function(){this.cachedViewportHeight=k.getHeight()}.bind(this))];a.triggerOverride?this.$2=this.$2.concat(a.triggerOverride.map(function(a){var b=a[0];a=a[1];return m.listen(b,a,this.queueLogAction.bind(this))}.bind(this))):this.$2.push(m.listen("scroll",null,this.queueLogAction.bind(this)));this.isTimeTrackingEnabled&&(this.$2.push(q.addListener(q.VISIBLE,function(){return this.startRecordingTimeTrackingData()}.bind(this))),this.$2.push(q.addListener(q.HIDDEN,function(){return this.stopRecordingTimeTrackingData()}.bind(this))));this.$2.push(m.listen("m:newsfeed:popup-visible",null,function(){this.stopRecordingTimeTrackingData()}.bind(this)),m.listen("m:newsfeed:popup-hidden",null,function(){this.startRecordingTimeTrackingData(),this.fireEvent()}.bind(this)));b?u(function(){this.fireEvent()}.bind(this),!1):(this.fireEvent(),l.addRetroactiveListener(l.Events.EVENT_OCCURRED,function(a,b){a=b.event;a==="tti"&&(this.fireEvent(),l.removeCurrentListener())}.bind(this)))};z.prototype.getFBFeedLocation=function(){return-1};z.prototype.unitTestOnlyGetListeners=function(){return[].concat(this.$2)};z.prototype.getCachedReadStoryIDs=function(){return null};z.prototype.getMinSizeToBeVisible=function(a){if(!this.relaxedMinSize)return x;a="getBoundingClientRect"in a?a.getBoundingClientRect().height:o.getDim(a).y;return Math.min(x,a*.5)};z.prototype.fireEvent=function(){__p&&__p();if(r.isSnippetFlyoutVisible())return;var a=this.getAllStoriesInView();for(var b=0;b<a.length;b++){var c=a[b],d=this.getStoryID(c);if(!d||d in this.readStoryIDs)continue;this.readStoryIDs[d]=!0;this.sendDataToLog(this.getDataToLog(c));if(this.vpvDebug){d=h.scry(c,"div")[0];d&&n.set(d,"background-color","#fffbe2")}this.markStoryRead(c);this.fireStoryVisibleHandlers(c)}this.trackingHooks&&p.updateVisibleViewportObjects(this.getAllStoriesInView(!0))};z.prototype.fireStoryVisibleHandlers=function(a){(y.get(a)||[]).forEach(function(a){return a()}),y["delete"](a)};z.prototype.markStoryRead=function(a){};z.prototype.queueLogAction=function(){this.isLoose?this.$3||(this.$3=v(function(){this.isTimeTrackingEnabled&&this.startRecordingTimeTrackingData(),this.$3=null,this.maxScrollPosition=Math.max(this.maxScrollPosition,k.getScrollTop()),!this.throttleNoDelay?(clearTimeout(this.$1),this.$1=v(function(){return this.fireEvent()}.bind(this),this.getTimeout())):this.fireEvent()}.bind(this),100)):(clearTimeout(this.$1),this.$1=v(function(){this.isTimeTrackingEnabled&&this.startRecordingTimeTrackingData(),this.fireEvent()}.bind(this),this.getTimeout()))};z.prototype.getTimetrackingDataToLog=function(a){var b=h.scry(a.story,"*","data-is-cta").map(function(a){a=g.getDataFt(a);a=a&&JSON.parse(a);return a&&a.cta_types}).filter(function(a){return!!a});this.cachedViewportHeight===0&&z.shouldRunTrackingAfterTTI()&&(this.cachedViewportHeight=k.getHeight());return{evt:w,fbfeed_location:this.getFBFeedLocation(),story_height:a.story_height,viewport_height:this.cachedViewportHeight,vpvd_start_timestamp:a.evp_ts/1e3,vpvd_time_delta:Math.round(a.vpvd||0),cta_types:b}};z.prototype.recordTimeStoryWasInView=function(a){if(this.isTimeTrackingEnabled&&a.vpvd>0){var b=this.getTimetrackingDataToLog(a);if(typeof b!=="string"){a=g.getDataFt(a.story);a&&(b=babelHelpers["extends"]({},b,i.parse(a,e.id)))}this.sendTimetrackingDataToLog(b)}};z.prototype.startRecordingTimeTrackingData=function(){this.$4(!1)};z.prototype.stopRecordingTimeTrackingData=function(){this.$4(!0)};z.prototype.$4=function(a){__p&&__p();this.activeStories||(this.activeStories={});var b=Date.now();this.latestTimeTrackingTimestamp||(this.latestTimeTrackingTimestamp=b);var c=this.getAllStoriesInView();this.updateVPVDurations(b);if(this.debugConsole){var d=Object.values(this.activeStories);d.length&&(console.table&&console.table(d))}d=this.updateActiveStories(c,b);this.debugConsole&&(d.length&&(console.table&&console.table(d)));this.recordVPVDurations(c,a);this.latestTimeTrackingTimestamp=a?0:b};z.prototype.updateVPVDurations=function(a){var b=a-this.latestTimeTrackingTimestamp;if(b>this.discardVPVDIntervalThreshold)return;b=a-this.latestTimeTrackingTimestamp;for(var c in this.activeStories)Object.prototype.hasOwnProperty.call(this.activeStories,c)&&(this.activeStories[c].vpvd+=b)};z.prototype.isVisible=function(a,b){for(var c=0;c<b.length;c++)if(this.getStoryID(b[c])===a)return!0;return!1};z.prototype.recordVPVDurations=function(a,b){this.recordVPVDurationsInternal(a,b)};z.prototype.recordVPVDurationsInternal=function(a,b){for(var c in this.activeStories)Object.prototype.hasOwnProperty.call(this.activeStories,c)&&((b||!this.isVisible(c,a))&&(this.recordTimeStoryWasInView(this.activeStories[c]),delete this.activeStories[c]))};z.prototype.updateActiveStories=function(a,b){var c=[];for(var d=0;d<a.length;d++){var e=this.getStoryID(a[d]);if(!e)break;e in this.activeStories||(this.activeStories[e]={evp_ts:b,story:a[d],vpvd:0,story_height:a[d].offsetHeight},c.push(this.activeStories[e]));this.activeStories[e].ts=b}return c};z.prototype.getAllStoriesInView=function(a){__p&&__p();a===void 0&&(a=!1);var b=[],c=this.getAllStories(),d=k.getScrollTop(),e=k.getHeight(),f=this.isLoose,g=e+this.maxScrollPosition-d;for(var h=0;h<c.length;h++){var i=c[h],j=this.getStoryBounds(d,i),l=j.top;j=j.bottom;if(!l&&!j)continue;var m=this.getMinSizeToBeVisible(i);if(!f&&l>e-m)break;m=!f&&l<=e-m&&j>=m||f&&l<g;a&&(j<0||l>e)&&(m=!1);m&&b.push(i)}return b};z.prototype.getStoryBounds=function(a,b){if("getBoundingClientRect"in b){var c=b.getBoundingClientRect();return{bottom:c.bottom,top:c.top}}else{c=o.getPos(b).y-a;return{top:c,bottom:c+o.getDim(b).y}}};z.prototype.cleanup=function(){this.$2.forEach(function(a){return a.remove()}),this.$2=[],y.clear()};z.prototype.onUnload=function(){this.isTimeTrackingEnabled&&this.stopRecordingTimeTrackingData(),this.cleanup()};z.prototype.sendTimetrackingDataToLog=function(a){this.sendDataToLog(a)};z.shouldRunTrackingAfterTTI=function(){return j.isHomeishPath(location.href)&&s("676812")};z.addStoryVisibleHandler=function(a,b){y.set(a,[].concat(y.get(a)||[],[b]));return{remove:function(){y.set(a,(y.get(a)||[]).filter(function(a){return a!==b}))}}};e.exports=z}),null);
__d("MCommentViewportTracking",["Banzai","DataStore","DOM","FBJSON","MParent","MViewportTracking","Stratcom","StratcomManager","compactArray","gkx","onAfterTTI"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q){"use strict";__p&&__p();var r,s=null,t={m_group_stories_container:"group",m_newsfeed_stream:"",m_story_permalink_view:"",structured_composer_async_container:"user",root:""};r=babelHelpers.inherits(u,l);r&&r.prototype;u.loadedReplies=function(){m.invoke("m:commentViewportTracking:loadedReplies")};u.loadedComments=function(){s&&s.isTimeTrackingEnabled&&s.startRecordingTimeTrackingData()};u.singleton=function(a){__p&&__p();if(!s){a={triggerOverride:[["scroll",null],["m:commentViewportTracking:loadedReplies",null],["m:feed-ufi-flyout:comments-displayed",null],["m:ufi:live-comments:render",null],["m:ufi:live-comments:new-comment",null],["m:feed-ufi-flyout:reset",null],["m:page:render:complete",null]]};n.enableDispatch(document,"scroll");s=new u();s.init(a);s.debugConsole;s.isTimeTrackingEnabled&&(l.shouldRunTrackingAfterTTI()?q(function(){s instanceof u&&s.startRecordingTimeTrackingData()},!1):s.startRecordingTimeTrackingData());m.listen("m:page:unload",null,function(){s=null,m.removeCurrentListener()})}};u.registerFlyout=function(a,b){var c;s&&(s.debugConsole,s.streamRoot=a);t=babelHelpers["extends"]((c={},c[a.id]=b||"",c),t)};u.prototype.getDataFromConfig=function(){this.debugConsole=p("676811"),this.isTimeTrackingEnabled=!0,this.idle_timeout=5e3,this.min_duration_to_log=100,this.min_visible_size=200,this.relaxedMinSize=!0};u.prototype.__getRootNode=function(){this.streamRoot||(this.streamRoot=o(Object.keys(t).map(function(a){return document.getElementById(a)}))[0]||null);return this.streamRoot};u.prototype.__getStaticTemplateRootNode=function(){this.staticElementRoot||(this.staticElementRoot=document.getElementById("static_templates"));return this.staticElementRoot};u.prototype.getAllStories=function(){var a=this.__getRootNode();if(!a)return[];a=i.scry(this.__getRootNode(),"div","comment-body");return this.__getStaticTemplateRootNode()?a.concat(i.scry(this.__getStaticTemplateRootNode(),"div","comment-body")):a};u.prototype.getTimeout=function(){return this.min_duration_to_log};u.prototype.getDataToLog=function(a){return{}};u.prototype.getStoryID=function(a){var b=a.getAttribute("data-commentid");return!b?String(h.get(a,"token"))||null:b};u.prototype.getContainerModule=function(){var a=this.__getRootNode();return!a||!(a.id in t)?"other":t[a.id]};u.prototype.getTimetrackingDataToLog=function(a){var b=a.story,c;try{var d=k.bySigil(a.story,"story-div")||k.bySigil(a.story,"m-feed-single-story");d&&(c=j.parse(d.getAttribute("data-ft"),e.id))}catch(a){}return{comment_id:this.getStoryID(b),duration_ms:Math.round(a.vpvd),container_module:this.getContainerModule(),mf_story_key:c?c.mf_story_key||c.top_level_post_id:null}};u.prototype.sendDataToLog=function(a){if(a.comment_id){this.debugConsole;var b=g.isEnabled("comment_vpv_vital")?g.VITAL:null;g.post("comment_vpvd",a,b)}};function u(){r.apply(this,arguments)}e.exports=u}),null);
__d("XLynxAsyncCallbackController",["XController"],(function(a,b,c,d,e,f){e.exports=b("XController").create("/si/linkclick/ajax_callback/",{lynx_uri:{type:"String"}})}),null);
__d("FBLynxLogging",["BanzaiODS","MRequest","XLynxAsyncCallbackController"],(function(a,b,c,d,e,f,g,h,i){"use strict";a={log:function(a){var b=i.getURIBuilder().getURI();b=new h(b).setData({lynx_uri:a});b.listen("error",function(a){a.code?(a.isHandled=!0,g.bumpEntityKey("linkshim","click_log.post.fail."+a)):g.bumpEntityKey("linkshim","click_log.post.fail.unknown")});b.send()}};e.exports=a}),null);
__d("FBLynxBase",["FBLynxLogging","LinkshimHandlerConfig","URI","$","isLinkshimURI"],(function(a,b,c,d,e,f,g,h,i,j,k){"use strict";__p&&__p();function l(a){if(!k(a))return null;a=a.getQueryData().u;return!a?null:a}var m={logAsyncClick:function(a){m.swapLinkWithUnshimmedLink(a);a=a.getAttribute("data-lynx-uri");if(!a)return;g.log(a)},originReferrerPolicyClick:function(a){var b=j("meta_referrer");b.content=h.switched_meta_referrer_policy;m.logAsyncClick(a);setTimeout(function(){b.content=h.default_meta_referrer_policy},100)},swapLinkWithUnshimmedLink:function(a){var b=a.href,c=l(new i(b));if(!c)return;a.setAttribute("data-lynx-uri",b);a.href=c},revertSwapIfLynxURIPresent:function(a){var b=a.getAttribute("data-lynx-uri");if(!b)return;a.removeAttribute("data-lynx-uri");a.href=b}};e.exports=m}),null);
__d("LynxMsiteJSMode",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({ORIGINLAZY:"MLynx_originlazy",ASYNCLAZY:"MLynx_asynclazy"})}),null);
__d("MLynx",["FBLynxBase","LynxMsiteJSMode","Stratcom","URI","isLinkshimURI"],(function(a,b,c,d,e,f,g,h,i,j,k){"use strict";__p&&__p();var l={alreadySetup:!1,setupDelegation:function(a){__p&&__p();a===void 0;if(l.alreadySetup)return;l.alreadySetup=!0;i.listen("click",h.ORIGINLAZY,function(a){a=a.getNode(h.ORIGINLAZY);a instanceof HTMLAnchorElement&&g.originReferrerPolicyClick(a)});i.listen("click",h.ASYNCLAZY,function(a){a=a.getNode(h.ASYNCLAZY);a instanceof HTMLAnchorElement&&g.logAsyncClick(a)})},isShimmedLink:function(a){var b=a.getAttribute("href");b=b?k(new j(b)):!1;return b||a.hasAttribute("data-lynx-uri")}};e.exports=l}),null);
__d("MUFILikeButton",["ActorURI","CSS","DOM","MLegacyDataStore","MLiveData","MParent","MUFIReactionsUtils","MUFIRequest","Stratcom","SubscriptionsHandler","cx","emptyFunction"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r){__p&&__p();var s={is_like:1},t={is_like:0};function a(a,b,c,d){"use strict";this.$1=a,this.$2=k.get(b),this.$4=b,this.$5=c||{log:r},this.$6=d,this.$7=m.getConfigForBackgroundRetry(b),this.$3=new p(),this.$3.addSubscriptions(i.listen(this.$1,"click",null,this.onClick.bind(this)),this.$2.listen("change",this.onChange.bind(this)),o.listen("m:page:unload",null,this.onUnload.bind(this)))}a.prototype.onChange=function(){"use strict";var a=this.$2.getData();if(a.request_id===this.$6)return;a=a.has_viewer_liked;h.conditionClass(this.$1,"_77la",a);o.removeSigil(this.$1,a?"like":"unlike");o.addSigil(this.$1,a?"unlike":"like")};a.prototype.getFeedbackData=function(){"use strict";var a=this.$2.getData(),b=a.has_viewer_liked,c=b?a.like_count-1:a.like_count+1,d=a.reduced_like_count;isNaN(d)||(d=c.toString());return{has_viewer_liked:!b,like_count:c,like_counts:[a.like_counts[1]||null,a.like_counts[0]],like_friend_sentences:[a.like_friend_sentences[1]||null,a.like_friend_sentences[0]],like_sentences:[a.like_sentences[1]||null,a.like_sentences[0]],reduced_like_count:d}};a.prototype.getRequestData=function(){"use strict";return null};a.prototype.onClick=function(a){"use strict";__p&&__p();a.prevent();var b=a.getNode("tag:a");b||(b=a.getNode("tag:div"));if(!b)return;a=n.getURI(b.getAttribute("href")||b.getAttribute("data-uri"));this.$2.getData().has_viewer_liked?(a.addQueryData("ul",!0),a.removeQueryData("reaction_type")):a.removeQueryData(["ul","reaction_type"]);b=l.bySigil(this.$1,"feed-ufi-metadata");if(b){b=j.get(b).actor_id;b&&(a=g.create(a,String(b)))}n.send(this.$4,this.getFeedbackData(),a,this.getRequestData(),this.$7);this.$5.log("like",void 0,this.$2.getData().has_viewer_liked?t:s)};a.prototype.onUnload=function(){"use strict";this.$3.release(),this.$3=null};e.exports=a}),null);
__d("UFIUIEvents",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({ActionAddComment:"UFIUIEvents/ufiActionAddComment",ActionLinkLike:"UFIUIEvents/ufiActionLinkLike",Blur:"ufi/blur",Changed:"ufi/changed",Comment:"ufi/comment",CommentChanged:"ufi/commentChanged",CommentPager:"CommentUFI.Pager",CommentPivot:"ufi/comment_pivot",Focus:"ufi/focus",InputHeightChanged:"ufi/inputHeightChanged",PageCleared:"ufi/page_cleared",PhotoPreviewHeightChanged:"ufi/photoPreviewHightChanged",TranslationRendered:"ufi/translationRendered",ReactionButtonClicked:"ufi/reactionButtonClicked"})}),null);
__d("MUFIReactionButton",["CSS","DOM","MAudioController","MLiveData","MUFILikeButton","MUFIReactionsUtils","Stratcom","Style","UFIReactionIcons","UFIReactionTypes","UFIUIEvents","createIxElement","cx","fbt","gkx"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u){__p&&__p();var v,w=1,x=0,y=16;b=babelHelpers.inherits(a,k);v=b&&b.prototype;function a(a,b,c,d,e,f,g){"use strict";v.constructor.call(this,a,b,c,d),this.$MUFIReactionButton1=a,this.$MUFIReactionButton2=j.get(b),this.$MUFIReactionButton3=b,this.$MUFIReactionButton4=d,this.$MUFIReactionButton5=e||y,this.$MUFIReactionButton6=!!g,a.href&&a.setAttribute("data-uri",a.href),a.removeAttribute("href")}a.prototype.onChange=function(){"use strict";__p&&__p();var a=this.$MUFIReactionButton2.getData();if(a.request_id===this.$MUFIReactionButton4)return;var b,c;a=a.viewerreaction;var d=!!a;a&&!p.reactions[a]&&(a=null);if(!a)b="inherit",c=t._("Me gusta"),this.$MUFIReactionButton6&&(c=h.create("span",{className:"_780q"},c));else{var e=null;if(a!==w){var f=o[a][this.$MUFIReactionButton5];f||(f=o[a][y]);e=r(f);g.addClass(e,"_4h-b")}b=p.reactions[a].color;f=p.reactions[a].display_name;this.$MUFIReactionButton6&&(f=h.create("span",{className:"_780q"},f));c=[e,f]}h.setContent(this.$MUFIReactionButton1,c);this.$MUFIReactionButton1.setAttribute("aria-pressed",d);g.conditionClass(this.$MUFIReactionButton1,"_77ld",d&&a!==w);g.conditionClass(this.$MUFIReactionButton1,"_77la",d&&a===w);n.set(this.$MUFIReactionButton1,"color",b);m.removeSigil(this.$MUFIReactionButton1,d?"like":"unlike");m.addSigil(this.$MUFIReactionButton1,d?"unlike":"like");m.invoke(q.ReactionButtonClicked,null,this.getRequestData())};a.prototype.getFeedbackData=function(){"use strict";var a=this.$MUFIReactionButton2.getData();return l.getReactionData(a,a.has_viewer_liked||a.viewerreaction?x:w)};a.prototype.getRequestData=function(){"use strict";var a=this.$MUFIReactionButton2.getData(),b=a.has_viewer_liked||a.viewerreaction;return{reaction_type:b?x:w,ft_ent_identifier:a.ft_ent_identifier}};a.prototype.onClick=function(a){"use strict";var b=this.$MUFIReactionButton2.getData().viewerreaction;b===x&&(u("676818")&&i.play("reactions","like"));if(m.hasSigil(this.$MUFIReactionButton1,"kaios-like-react-trigger")){b=this.$MUFIReactionButton2.getData();b.viewerreaction&&a.stop()}v.onClick.call(this,a)};e.exports=a}),null);
__d("MArrays",[],(function(a,b,c,d,e,f){"use strict";e.exports={findPrefix:function(a,b){for(var c=0;c<a.length;c++)if(b.startsWith(a[c]))return!0;return!1}}}),null);
__d("BanzaiBase",["BanzaiAdapter","BanzaiConsts","BanzaiLazyQueue","ErrorUtils","FBLogger"],(function(a,b,c,d,e,f,g,h,i,j,k){__p&&__p();var l=g,m="ods:banzai",n="send_via_beacon_failure",o=0,p=1,q=2,r=null,s,t=[],u=null,v=[];function w(a,b){a.__meta.status=o,a[3]=(a[3]||0)+1,!a.__meta.retry&&b>=400&&b<600&&t.push(a)}var x={adapter:l,SEND:h.SEND,OK:h.OK,ERROR:h.ERROR,SHUTDOWN:h.SHUTDOWN,VITAL_WAIT:h.VITAL_WAIT,BASIC_WAIT:h.BASIC_WAIT,VITAL:{delay:l.config.MIN_WAIT||h.VITAL_WAIT},BASIC:{delay:l.config.MAX_WAIT||h.BASIC_WAIT},isEnabled:function(a){return l.config.gks&&l.config.gks[a]},post:function(a,b,c){__p&&__p();a||k("banzai").mustfix("Banzai.post called without specifying a route");c=c||{};var d=c.retry;if(l.config.disabled)return;var e=l.config.blacklist;if(e&&(e.indexOf&&(typeof e.indexOf=="function"&&e.indexOf(a)!=-1)))return;var f=x._wrapData(a,b,x._getEventTime(),d);c.callback&&(f.__meta.callback=c.callback);c.compress!=null&&(f.__meta.compress=c.compress);e=c.delay;e==null&&(e=h.BASIC_WAIT);if(c.signal){f.__meta.status=p;b=[{user:x._getUserId(),page_id:x._getPageId(),posts:[f],trigger:a}];l.send(b,function(){f.__meta.status=q,f.__meta.callback&&f.__meta.callback()},function(a){w(f,a)},!0);if(!d)return}t.push(f);(x._schedule(e)||!u)&&(u=a);c=i.flushQueue();c.forEach(function(a){return x.post.apply(x,a)})},registerToSendWithBeacon:function(a,b,c,d){if(!(navigator&&navigator.sendBeacon&&l.isOkToSendViaBeacon()))return!1;if(!a){k("banzai").mustfix("Banzai.registerToSendWithBeacon called without specifying a route");return!1}v.push({cb:b,route:a,onSuccess:c,onFailure:d});return!0},flush:function(b,c){a.clearTimeout(r),r=null,x._sendWithCallbacks(b,c)},subscribe:l.subscribe,canUseNavigatorBeacon:function(){return navigator&&navigator.sendBeacon&&l.isOkToSendViaBeacon()},_canSend:function(a){return a[2]>=x._getEventTime()-(l.config.EXPIRY||h.EXPIRY)},_getPostBuffer:function(){return t},_clearPostBuffer:function(){t=[]},_schedule:function(b){var c=x._getEventTime()+b;if(!s||c<s){s=c;r&&a.clearTimeout(r);r=a.setTimeout(function(){x._sendWithCallbacks()},b);return!0}return!1},_sendWithCallbacks:function(a,b){__p&&__p();s=null;x._schedule(x.BASIC.delay);if(!l.readyToSend()){b&&b();return}if(x.isEnabled("flush_storage_periodically")||x.isEnabled("error_impact_test")){var c=x._getStorage();j.applyWithGuard(c.flush,c)}l.inform(h.SEND);c=[];var d=[];t=x._gatherWadsAndPostsFromBuffer(c,d,!0,t);if(c.length<=0){l.inform(h.OK);a&&a();return}c[0].trigger=u;u=null;c[0].send_method="ajax";c.map(l.prepWadForTransit);l.send(c,function(){d.forEach(function(a){a.__meta.status=q,a.__meta.callback&&a.__meta.callback()}),a&&a()},function(a){d.forEach(function(b){w(b,a)}),b&&b()})},_gatherWadsAndPostsFromBuffer:function(a,b,c,d){__p&&__p();var e={};return d.filter(function(d){__p&&__p();var f=d.__meta;if(f.status>=q||!x._canSend(d))return!1;if(f.status>=p)return!0;var g=f.compress!=null?f.compress:!0,h=f.pageID+f.userID+(g?"compress":""),i=e[h];i||(i={user:f.userID,page_id:f.pageID,posts:[],snappy:g},e[h]=i,a.push(i));f.status=p;i.posts.push(d);b.push(d);return c&&f.retry})},_resetPostStatus:function(a){a.__meta.status=o},_store:function(a){a=x._getStorage();j.applyWithGuard(a.store,a)},_restore:function(a){a=x._getStorage();j.applyWithGuard(a.restore,a);x._schedule(l.config.RESTORE_WAIT||h.VITAL_WAIT)},_wrapData:function(a,b,c,d){a=[a,b,c,0];a.__meta={pageID:x._getPageId(),userID:x._getUserId(),retry:d===!0,status:o};return a},_tryToSendViaBeacon:function(){__p&&__p();if(!(navigator&&navigator.sendBeacon&&l.isOkToSendViaBeacon()))return!1;var b=[],c=[];t=x._gatherWadsAndPostsFromBuffer(b,c,!1,t);if(b.length<=0)return!1;b[0].send_method="beacon";b.map(l.prepWadForTransit);b=new Blob([l.addRequestAuthData(l.prepForTransit(b))],{type:"application/x-www-form-urlencoded"});b=a.navigator.sendBeacon(x.adapter.endpoint,b);if(!b){c.forEach(function(a){t.push(a)});t.push(x._wrapData(m,(b={},b[n]=[1],b),x._getEventTime()));return!1}return!0},_processCallbacksAndSendViaBeacon:function(){__p&&__p();var b=[];v.forEach(function(a){var c=a.cb();c.forEach(function(c){var d=a.route;if(d){d=x._wrapData(d,c,x._getEventTime());d.__meta.onSuccess=a.onSuccess;d.__meta.onFailure=a.onFailure;b.push(d)}})});v=[];var c=[],d=[];x._gatherWadsAndPostsFromBuffer(c,d,!0,b);if(c.length>0){c[0].send_method="beacon";c.map(l.prepWadForTransit);c=new Blob([l.addRequestAuthData(l.prepForTransit(c))],{type:"application/x-www-form-urlencoded"});c=a.navigator.sendBeacon(x.adapter.endpoint,c);c?d.forEach(function(a){return a.__meta&&a.__meta.onSuccess&&a.__meta.onSuccess()}):d.forEach(function(a){return a.__meta&&a.__meta.onFailure&&a.__meta.onFailure()})}},_unload:function(){navigator&&navigator.sendBeacon&&l.isOkToSendViaBeacon()&&x._processCallbacksAndSendViaBeacon(),l.cleanup(),l.inform(h.SHUTDOWN),t.length>0&&((!x.adapter.useBeacon||!x._tryToSendViaBeacon())&&x._store(!1))},_getEventTime:function(){return Date.now()},_testState:function(){return{postBuffer:t,triggerRoute:u}},_getStorage:function(){return{store:function(){},restore:function(){},flush:function(){}}},_getPageId:function(){return"0"},_getUserId:function(){return"0"},_initialize:function(){}};e.exports=x}),null);
__d("BanzaiStreamPayloads",[],(function(a,b,c,d,e,f){"use strict";var g={};a={addPayload:function(a,b){g[a]=b},removePayload:function(a){delete g[a]},unload:function(a){Object.keys(g).forEach(function(b){b=g[b];a(b.route,b.payload)})}};e.exports=a}),null);
__d("SetIdleTimeoutAcrossTransitions",["NavigationMetrics","cancelIdleCallback","clearTimeout","nullthrows","requestIdleCallbackAcrossTransitions","setTimeoutAcrossTransitions"],(function(a,b,c,d,e,f,g,h,i,j,k,l){"use strict";__p&&__p();var m=!1,n=new Map();b={start:function(a,b){if(m){var c=l(function(){var b=k(function(){a(),n["delete"](b)});n.set(c,b)},b);return c}else return l(a,b)},clear:function(a){i(a),n.has(a)&&(h(j(n.get(a))),n["delete"](a))}};g.addRetroactiveListener(g.Events.EVENT_OCCURRED,function(b,c){c.event==="all_pagelets_loaded"&&(m=!!a.requestIdleCallback)});e.exports=b}),null);
__d("WebStorageMutex",["WebStorage","clearTimeout","pageID","setTimeoutAcrossTransitions"],(function(a,b,c,d,e,f,g,h,i,j){__p&&__p();var k=null,l=!1,m=i;function n(){l||(l=!0,k=g.getLocalStorage());return k}function a(a){"use strict";this.name=a}a.testSetPageID=function(a){"use strict";m=a};a.prototype.$1=function(){"use strict";if(!n())return m;var a=n().getItem("mutex_"+this.name);a=a?a.split(":"):null;return a&&a[1]>=Date.now()?a[0]:null};a.prototype.$2=function(a){"use strict";if(!n())return;a=Date.now()+(a||1e4);g.setItemGuarded(n(),"mutex_"+this.name,m+":"+a)};a.prototype.hasLock=function(){"use strict";return this.$1()==m};a.prototype.lock=function(a,b,c){"use strict";this.$3&&h(this.$3),m==(this.$1()||m)&&this.$2(c),this.$3=j(function(){this.$3=null;var c=this.hasLock()?a:b;c&&c(this)}.bind(this),0)};a.prototype.unlock=function(){"use strict";this.$3&&h(this.$3),n()&&this.hasLock()&&n().removeItem("mutex_"+this.name)};e.exports=a}),null);
__d("BanzaiNew",["BanzaiBase","BanzaiConsts","BanzaiStreamPayloads","CurrentUser","ExecutionEnvironment","FBJSON","NavigationMetrics","SetIdleTimeoutAcrossTransitions","TimeSlice","Visibility","WebStorage","emptyFunction","isInIframe","lowerFacebookDomain","pageID","performanceAbsoluteNow","WebStorageMutex"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v){__p&&__p();var w="bz:",x={_getStorage:g._getStorage,_getPageId:g._getPageId,_getUserId:g._getUserId,_initialize:g._initialize,_schedule:g._schedule,flush:g.flush,_unload:g._unload,post:g.post},y=s(),z=null,A,B,C,D,E=!1;function F(){E||(E=!0,D=q.getLocalStorage());return D}function G(){var a="check_quota";try{var b=F();if(!b)return!1;b.setItem(a,a);b.removeItem(a);return!0}catch(a){return!1}}g._getStorage=function(){__p&&__p();C||(!y?C={store:function(){var a=F();if(!a||g._getPostBuffer().length<=0)return;var b=g._getPostBuffer().map(function(a){return[a[0],a[1],a[2],a[3]||0,a.__meta]});g._clearPostBuffer();q.setItemGuarded(a,w+u+"."+g._getEventTime(),l.stringify(b))},restore:function(){__p&&__p();var a=F();if(!a)return;var c=b("WebStorageMutex"),d=function(b){__p&&__p();var c=[];for(var d=0;d<a.length;d++){var e=a.key(d);e.indexOf(w)===0&&e.indexOf("bz:__")!==0&&c.push(e)}c.forEach(function(b){__p&&__p();var c=a.getItem(b);a.removeItem(b);if(!c)return;b=l.parse(c);b.forEach(function(a){if(!a)return;var b=a.__meta=a.pop(),c=g._canSend(a);if(!c)return;c=j.getID();(b.userID===c||c==="0")&&(g._resetPostStatus(a),g._getPostBuffer().push(a))})});b&&b.unlock()};G()?new c("banzai").lock(d):n.start(d,0)},flush:function(){var a=F();if(a){z===null&&(z=parseInt(a.getItem(h.LAST_STORAGE_FLUSH),10));var b=z&&v()-z>=h.STORAGE_FLUSH_INTERVAL;b&&g._restore(!1);(b||!z)&&(z=v(),q.setItemGuarded(a,h.LAST_STORAGE_FLUSH,z.toString()))}}}:C={store:r,restore:r,flush:r});return C};g._getPageId=function(){return u};g._getUserId=function(){return j.getID()};g._initialize=function(){k.canUseDOM&&(g.adapter.useBeacon&&p.isSupported()?(p.addListener(p.HIDDEN,function(){g._getPostBuffer().length>0&&(g._tryToSendViaBeacon()||g._store(!1))}),(g.isEnabled("enable_client_logging_clear_on_visible")||g.isEnabled("error_impact_test"))&&p.addListener(p.VISIBLE,function(){g._tryToSendViaBeacon()||g._restore(!1)})):g.adapter.setHooks(g),g.adapter.setUnloadHook(g),m.addListener(m.Events.NAVIGATION_DONE,function(a,b){if(b.pageType!=="normal")return;g._restore(!1);m.removeCurrentListener()}))};g._getEventTime=function(){return v()};var H=o.guard(function(){A=null,g._sendWithCallbacks()},"Banzai.send",{propagationType:o.PropagationType.ORPHAN});g._schedule=function(a){__p&&__p();var b=g._getEventTime()+a;if(!A||b<A){A=b;n.clear(B);b=function(){B=n.start(H,a)};b();return!0}return!1};g.flush=function(a,b){n.clear(B),A=null,g._sendWithCallbacks(a,b)};g._unload=function(){i.unload(g.post),x._unload()};g.post=function(b,c,d){__p&&__p();if(g.adapter.config.disabled)return;if(!k.canUseDOM)return;if(y&&t.isValidDocumentDomain()){var e;try{e=a.top.require("Banzai")}catch(a){e=null}if(e){e.post.apply(e,arguments);return}}x.post(b,c,d)};g._initialize();e.exports=g}),null);
__d("BanzaiOriginal",["requireCond","cr:682174"],(function(a,b,c,d,e,f,g,h){e.exports=h}),null);