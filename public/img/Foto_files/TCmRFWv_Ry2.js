if (self.CavalryLogger) { CavalryLogger.start_js(["u\/raj"]); }

__d("PagesLoggerEventEnum",[],(function(a,b,c,d,e,f){e.exports={CLICK:"click",CREATE:"create",DELETE:"delete",DRAG:"drag",HOVER:"hover",IMPRESSION:"impression",RECEIVE_REQUEST:"receive_request",RECEIVE_RESPONSE:"receive_response",SAVE:"save",SCROLL:"scroll",SEND_REQUEST:"send_request",SEND_RESPONSE:"send_response",UNSAVE:"unsave",UPDATE:"update"}}),null);
__d("PagesTypedLogger",["Banzai","GeneratedLoggerUtils","nullthrows"],(function(a,b,c,d,e,f,g,h,i){"use strict";__p&&__p();function a(){this.$1={}}a.prototype.log=function(){h.log("logger:PagesLoggerConfig",this.$1,g.BASIC)};a.prototype.logVital=function(){h.log("logger:PagesLoggerConfig",this.$1,g.VITAL)};a.prototype.logImmediately=function(){h.log("logger:PagesLoggerConfig",this.$1,{signal:!0})};a.prototype.clear=function(){this.$1={};return this};a.prototype.getData=function(){return babelHelpers["extends"]({},this.$1)};a.prototype.updateData=function(a){this.$1=babelHelpers["extends"]({},this.$1,a);return this};a.prototype.setConnectionClass=function(a){this.$1.connection_class=a;return this};a.prototype.setEvent=function(a){this.$1.event=a;return this};a.prototype.setEventLocation=function(a){this.$1.event_location=a;return this};a.prototype.setEventTarget=function(a){this.$1.event_target=a;return this};a.prototype.setLogSource=function(a){this.$1.log_source=a;return this};a.prototype.setPageID=function(a){this.$1.page_id=a;return this};a.prototype.setRawClientTime=function(a){this.$1.raw_client_time=a;return this};a.prototype.setSessionid=function(a){this.$1.sessionid=a;return this};a.prototype.setTags=function(a){this.$1.tags=h.serializeVector(a);return this};a.prototype.setTime=function(a){this.$1.time=a;return this};a.prototype.setWeight=function(a){this.$1.weight=a;return this};a.prototype.updateExtraData=function(a){a=i(h.serializeMap(a));h.checkExtraDataFieldNames(a,j);this.$1=babelHelpers["extends"]({},this.$1,a);return this};a.prototype.addToExtraData=function(a,b){var c={};c[a]=b;return this.updateExtraData(c)};var j={connection_class:!0,event:!0,event_location:!0,event_target:!0,log_source:!0,page_id:!0,raw_client_time:!0,sessionid:!0,tags:!0,time:!0,weight:!0};e.exports=a}),null);
__d("MNTClickListener",["CancelableEventListener","ge","MNTActions"],(function(a,b,c,d,e,f,g,h){"use strict";e.exports={attachListener:function(a,c){a=h(a);var d=c;d!==null&&d!==void 0&&a!=null&&g.listen(a,"click",null,function(a){a=b("MNTActions");a.performAction(d)})}}}),null);
__d("MNTExpandableTextListener",["CSS","DataStore","EventListener","Stratcom","csx","MNTActions"],(function(a,b,c,d,e,f,g,h,i,j,k){"use strict";__p&&__p();a={listen:function(a,b){var c=i.listen(a,"click",function(){var c=a.querySelector(".text_exposed_root");if(!c)return;h.get(a,"expanded",!1)?(g.removeClass(c,"text_exposed"),b.collapseAction&&this._executeAction(b.collapseAction),h.set(a,"expanded",!1)):(g.addClass(c,"text_exposed"),b.expandAction&&this._executeAction(b.expandAction),h.set(a,"expanded",!0))}.bind(this)),d=j.listen("m:page:unload",null,function(){c.remove(),d.remove()})},_executeAction:function(a){var c=b("MNTActions");c.performAction(a)}};e.exports=a}),null);
__d("MNTTapActionWrapperListener",["EventListener","Run","SubscriptionsHandler","MNTActions"],(function(a,b,c,d,e,f,g,h,i){"use strict";__p&&__p();e.exports={attachListeners:function(a,c,d){__p&&__p();if(c){this._subscriptions=new i();var e=c;this._subscriptions.addSubscriptions(g.capture(a,"click",function(a){a.preventDefault();var c=b("MNTActions");c.performAction(e);d&&a.stopPropagation()}));h.onLeave(function(){return this._subscriptions.release()}.bind(this))}}}}),null);
__d("MUFISocialSentence",["Bootloader","CSS","DOM","MLiveData","Stratcom","SubscriptionsHandler","cx","fbt"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m,n){__p&&__p();function a(a,b,c,d,e,f){"use strict";__p&&__p();if(!f&&!c)return;this.$1=a;this.$2=j.get(b);this.$3=d;this.$4=e;this.$5=f;this.$6=c;this.$7=new l();this.$7.addSubscriptions(this.$2.listen("change",this.onChange.bind(this)),k.listen("m:page:unload",null,this.onUnload.bind(this)))}a.prototype.onChange=function(){"use strict";__p&&__p();var a=this.$2.getData();if(a.request_id===this.$4)return;h.removeClass(this.$1,"like_opt");var b=this.$5&&a.like_count?a[this.$3][0]:null,c=this.$6&&a.comment_count?a.comment_count:null;if(b&&b.text){this.$8={text:b,ftid:a.ft_ent_identifier};b=b.text;this.$6||g.loadModules(["MReactComponentRenderer","MUFISocialSentenceTextWithEntities.react"],function(a,b){a(b,this.$1,this.$8)}.bind(this),"MUFISocialSentence");return}if(b){var d=this.$3!=="like_counts"&&!a.like_fallback&&c?"div":"span";b=i.create(d,null,b);h.addClass(b,"_28wy")}c&&(c=c>1?n._({"*":"{count} comentarios"},[n._param("count",c,[0])]):n._({"*":"{count} comentario"},[n._param("count",c,[0])]),c=i.create("span",{},c),h.addClass(c,"_28wy"));i.setContent(this.$1,[b,c]);this.$9(a)};a.prototype.$9=function(a){"use strict";var b=this.$5&&(a.like_count||a.reactioncount);a=this.$6&&a.comment_count;h.conditionShow(this.$1,!!(b||a))};a.prototype.onUnload=function(){"use strict";this.$7.release(),this.$7=null};e.exports=a}),null);
__d("PagesLogger",["PagesLoggerEventEnum","PagesTypedLogger"],(function(a,b,c,d,e,f,g,h){__p&&__p();var i="extra_data_";a={log:function(a,b,c,d,e,f){d===void 0&&(d=null);e===void 0&&(e=[]);var g={},j=f||{};Object.keys(j||{}).forEach(function(a){var b=j[a];(b instanceof Array||b instanceof Object)&&(b=JSON.stringify(b));g[i+a]=b});new h().setPageID(a).setEvent(b).setEventTarget(c).setEventLocation(d).setLogSource("pages_logger").setTags(e).updateExtraData(g).log()},registerLogOnClick:function(a,b,c,d,e,f){d===void 0&&(d=null),e===void 0&&(e=[]),f===void 0&&(f={}),a.addEventListener("click",function(){this.log(b,g.CLICK,c,d,e,f)}.bind(this))}};e.exports=a}),null);