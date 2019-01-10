if (self.CavalryLogger) { CavalryLogger.start_js(["G90a9"]); }

__d("MUFIConversationGuideTextItem.react",["ConversationGuideSuggestionType","ConversationGuideUIEvent","ConversationGuideUITypedLogger","React","ReactDOM","RelayModern","ShimButton.react","TextWithEmoticons.react","cx","joinClasses","MUFIConversationGuideTextItem_item.graphql"],(function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p){"use strict";__p&&__p();var q;c=l.createFragmentContainer;l.graphql;d=babelHelpers.inherits(a,j.Component);q=d&&d.prototype;function a(){__p&&__p();var a,b;for(var c=arguments.length,d=new Array(c),e=0;e<c;e++)d[e]=arguments[e];return b=(a=q.constructor).call.apply(a,[this].concat(d)),this.itemRef=j.createRef(),this.hasLoggedVPV=!1,this.$1=function(){var a=this.props,b=a.ftentidentifier,c=a.trackingID,d=a.rankedIndex;a=a.item;var e=a.id;a=a.text;this.props.handleTextAdd(a);new i().setEvent(h.SUGGESTION_SELECTED).setFeedbackID(b).setSuggestionType(g.TEXT).setSuggestionIndex(d).setSuggestionID(e).setTrackingID(c).setSessionID(this.props.sessionID).log();this.props.onClickHandled&&this.props.onClickHandled(this.props.key)}.bind(this),b}a.prototype.checkForVpv=function(a,b){if(this.hasLoggedVPV||!this.itemRef.current)return;var c=k.findDOMNode(this.itemRef.current);if(!c)return;c=c.getBoundingClientRect();(c.left>a.left&&c.left<a.right-b||c.right>a.left+b&&c.right<a.right)&&this.logVpv()};a.prototype.logVpv=function(){if(this.hasLoggedVPV)return;this.hasLoggedVPV=!0;var a=this.props,b=a.ftentidentifier,c=a.rankedIndex;a=a.item.id;new i().setEvent(h.SUGGESTION_VPV).setFeedbackID(b).setSuggestionType(g.TEXT).setSuggestionIndex(c).setSuggestionID(a).setTrackingID(this.props.trackingID).setSessionID(this.props.sessionID).log()};a.prototype.render=function(){var a=this.props.item.text;return!a?null:j.createElement(m,{onMouseDown:this.props.onMouseDown,ref:this.itemRef,"data-hover":"tooltip","aria-label":a,"data-tooltip-content":a,className:p("_7ano",this.props.className),onClick:this.$1},j.createElement(n,{className:"_7anp",renderEmoticons:!1,renderEmoji:!0,size:16,text:a}))};e.exports=c(a,{item:function(){return b("MUFIConversationGuideTextItem_item.graphql")}})}),null);