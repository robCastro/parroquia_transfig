if (self.CavalryLogger) { CavalryLogger.start_js(["ZAP5N"]); }

__d("CommentsTimeSpentTypedLogger",["Banzai","GeneratedLoggerUtils","nullthrows"],(function(a,b,c,d,e,f,g,h,i){"use strict";__p&&__p();function a(){this.$1={}}a.prototype.log=function(){h.log("logger:CommentsTimeSpentLoggerConfig",this.$1,g.BASIC)};a.prototype.logVital=function(){h.log("logger:CommentsTimeSpentLoggerConfig",this.$1,g.VITAL)};a.prototype.logImmediately=function(){h.log("logger:CommentsTimeSpentLoggerConfig",this.$1,{signal:!0})};a.prototype.clear=function(){this.$1={};return this};a.prototype.getData=function(){return babelHelpers["extends"]({},this.$1)};a.prototype.updateData=function(a){this.$1=babelHelpers["extends"]({},this.$1,a);return this};a.prototype.setEndTime=function(a){this.$1.end_time=a;return this};a.prototype.setOrderingMode=function(a){this.$1.ordering_mode=a;return this};a.prototype.setPostFbid=function(a){this.$1.post_fbid=a;return this};a.prototype.setStartTime=function(a){this.$1.start_time=a;return this};a.prototype.setTimeSpentID=function(a){this.$1.time_spent_id=a;return this};a.prototype.setViewerHasInteracted=function(a){this.$1.viewer_has_interacted=a;return this};b={end_time:!0,ordering_mode:!0,post_fbid:!0,start_time:!0,time_spent_id:!0,viewer_has_interacted:!0};e.exports=a}),null);
__d("MUFICommentViewportTracking",["MarauderLogger","MLegacyDataStore","MUFIConfig","MViewportTracking"],(function(a,b,c,d,e,f,g,h,i,j){"use strict";__p&&__p();var k;k=babelHelpers.inherits(a,j);k&&k.prototype;a.prototype.getDataFromConfig=function(a){this.vpvLoggingEnabled=a.vpvLoggingEnabled};a.prototype.getStoryID=function(a){return h.get(a).token};a.prototype.getDataToLog=function(a){return this.getStoryID(a)};a.prototype.sendDataToLog=function(a){this.vpvLoggingEnabled&&g.log("comment_vpv",void 0,null,"comment",a)};a.prototype.getTimeout=function(){return i.vpvLoggingTimeout};function a(){k.apply(this,arguments)}e.exports=a}),null);
__d("MUFIStaticCommentViewportTracking",["CommentsTimeSpentTypedLogger","MUFICommentViewportTracking","Stratcom","pageID"],(function(a,b,c,d,e,f,g,h,i,j){"use strict";__p&&__p();var k,l={},m=null;a=babelHelpers.inherits(n,h);k=a&&a.prototype;n.trackStatically=function(a,b,c,d,e){var f=e+"_"+d,g=l[f];g||(g=new n(),l[f]=g,g.init({is_loose:!1,throttle_no_delay:!1,relaxed_min_size:!0,vpv_debug:!1,triggerOverride:[["scroll",null],["touchmove","ufi-overlay"]],vpvLoggingEnabled:b,timeTrackingEnabled:c,orderingMode:d,targetFBID:e}));m||(m=i.listen("m:page:unload",null,n.resetAll));g.addComments(a);g.fireEvent()};n.resetAll=function(){m&&m.remove(),m=null,l={}};function n(){k.constructor.call(this),this.resetTimeSpentInterval(),this.comments=[]}n.prototype.addComments=function(a){this.comments.push.apply(this.comments,a)};n.prototype.getDataFromConfig=function(a){k.getDataFromConfig.call(this,a),this.isTimeTrackingEnabled=a.timeTrackingEnabled,this.orderingMode=a.orderingMode,this.targetFBID=a.targetFBID};n.prototype.getAllStories=function(){return this.comments};n.prototype.recordVPVDurations=function(a,b){this.recordVPVDurationsInternal(a,b),(b||!a.length)&&(this.timeSpentIntervalStart<this.timeSpentIntervalEnd&&new g().setOrderingMode(this.orderingMode).setPostFbid(this.targetFBID).setStartTime(this.timeSpentIntervalStart).setEndTime(this.timeSpentIntervalEnd).setTimeSpentID(j).log(),this.resetTimeSpentInterval())};n.prototype.sendTimetrackingDataToLog=function(a){var b=Math.round(a.vpvd_start_timestamp);b<this.timeSpentIntervalStart&&(this.timeSpentIntervalStart=b);b=b+Math.round(a.vpvd_time_delta/1e3);b>this.timeSpentIntervalEnd&&(this.timeSpentIntervalEnd=b)};n.prototype.resetTimeSpentInterval=function(){this.timeSpentIntervalStart=Number.MAX_VALUE,this.timeSpentIntervalEnd=0};e.exports=n}),null);