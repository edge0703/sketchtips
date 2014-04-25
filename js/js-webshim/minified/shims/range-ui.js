(function(e){var t=function(e){return"number"==typeof e||e&&e==1*e},i=function(e,t){return"number"==typeof e||e&&e==1*e?1*e:t},n=["step","min","max","readonly","title","disabled","tabindex"],a={_create:function(){var t;for(this.element.addClass("ws-range").attr({role:"slider"}).append('<span class="ws-range-min" /><span class="ws-range-rail"><span class="ws-range-thumb" /></span>'),this.trail=e(".ws-range-rail",this.element),this.range=e(".ws-range-min",this.element),this.thumb=e(".ws-range-thumb",this.trail),this.updateMetrics(),this.orig=this.options.orig,t=0;n.length>t;t++)this[n[t]](this.options[n[t]]);this.value=this._value,this.value(this.options.value),this.initDataList(),this.element.data("rangeUi",this),this.addBindings(),this._init=!0},value:e.noop,_value:function(t,i,n){var a,r,o=this.options,s=t,l={},u={};i||parseFloat(t,10)==t||(t=o.min+(o.max-o.min)/2),i||(t=this.normalizeVal(t)),a=100*((t-o.min)/(o.max-o.min)),this._init&&t==o.value&&s==t||(this.options.value=t,this.thumb.stop(),this.range.stop(),u[this.dirs.width]=a+"%",this.vertical&&(a=Math.abs(a-100)),l[this.dirs.left]=a+"%",n?(n="object"!=typeof n?{}:e.extend({},n),n.duration||(r=Math.abs(a-parseInt(this.thumb[0].style[this.dirs.left]||50,10)),n.duration=Math.max(Math.min(999,5*r),99)),this.thumb.animate(l,n),this.range.animate(u,n)):(this.thumb.css(l),this.range.css(u)),this.orig&&(s!=t||!this._init&&this.orig.value!=t)&&this.options._change(t),this.element.attr({"aria-valuenow":this.options.value,"aria-valuetext":this.options.textValue?this.options.textValue(this.options.value):this.options.options[this.options.value]||this.options.value}))},initDataList:function(){if(this.orig){var t,i=this,n=function(){e(i.orig).jProp("list").off("updateDatalist",n).on("updateDatalist",n),clearTimeout(t),t=setTimeout(function(){i.list&&i.list()},9)};e(this.orig).on("listdatalistchange",n),this.list()}},list:function(){var i=this.options,n=i.min,a=i.max,r=this.trail,o=this;this.element.attr({"aria-valuetext":i.options[i.value]||i.value}),e(".ws-range-ticks",r).remove(),e(this.orig).jProp("list").find("option:not([disabled])").each(function(){i.options[e.prop(this,"value")]=e.prop(this,"label")||""}),e.each(i.options,function(s,l){if(!(!t(s)||n>s||s>a)){var u=100*((s-n)/(a-n)),c=i.showLabels&&l?' title="'+l+'"':"";o.vertical&&(u=Math.abs(u-100)),o.posCenter(e('<span class="ws-range-ticks"'+c+' data-label="'+l+'" style="'+o.dirs.left+": "+u+'%;" />').appendTo(r))}})},readonly:function(e){e=!!e,this.options.readonly=e,this.element.attr("aria-readonly",""+e),this._init&&this.updateMetrics()},disabled:function(e){e=!!e,this.options.disabled=e,e?this.element.attr({tabindex:-1,"aria-disabled":"true"}):this.element.attr({tabindex:this.options.tabindex,"aria-disabled":"false"}),this._init&&this.updateMetrics()},tabindex:function(e){this.options.tabindex=e,this.options.disabled||this.element.attr({tabindex:e})},title:function(e){this.element.prop("title",e)},min:function(e){this.options.min=i(e,0),this.value(this.options.value,!0)},max:function(e){this.options.max=i(e,100),this.value(this.options.value,!0)},step:function(e){var t=this.options,n="any"==e?"any":i(e,1);t.stepping&&("any"!=n&&t.stepping%n?webshims.error("wrong stepping value for type range:"+t.stepping%n):n=t.stepping),t.step=n,this.value(this.options.value)},normalizeVal:function(e){var t,i,n,a=this.options;return a.min>=e?e=a.min:e>=a.max?e=a.max:"any"!=a.step&&(n=a.step,t=(e-a.min)%n,i=e-t,2*Math.abs(t)>=n&&(i+=t>0?n:-n),e=1*i.toFixed(5)),e},doStep:function(e,t){var n=i(this.options.step,1);"any"==this.options.step&&(n=Math.min(n,(this.options.max-this.options.min)/10)),this.value(this.options.value+n*e,!1,t)},getStepedValueFromPos:function(e){var t,i,n,a;return 0>=e?t=this.options[this.dirs.min]:e>100?t=this.options[this.dirs.max]:(this.vertical&&(e=Math.abs(e-100)),t=(this.options.max-this.options.min)*(e/100)+this.options.min,a=this.options.step,"any"!=a&&(i=(t-this.options.min)%a,n=t-i,2*Math.abs(i)>=a&&(n+=i>0?a:-a),t=1*n.toFixed(5))),t},addRemoveClass:function(e,t){var i,n=-1!=this.element.prop("className").indexOf(e);!t&&n?(i="removeClass",this.element.removeClass(e),this.updateMetrics()):t&&!n&&(i="addClass"),i&&(this.element[i](e),this._init&&this.updateMetrics())},addBindings:function(){var t,i,n,a=this,r=this.options,o=function(){var t={};return{init:function(i,n,r){t[i]||(t[i]={fn:r},a.orig&&e(a.orig).on(i,function(){t[i].val=e.prop(a.orig,"value")})),t[i].val=n},call:function(e,i){t[e].val!=i&&(clearTimeout(t[e].timer),t[e].val=i,t[e].timer=setTimeout(function(){t[e].fn(i,a)},0))}}}(),s=function(e,n){var s=a.getStepedValueFromPos((e[a.dirs.mouse]-t)*i);s!=r.value&&(a.value(s,!1,n),o.call("input",s)),e&&"mousemove"==e.type&&e.preventDefault()},l=function(t){t&&"mouseup"==t.type&&(o.call("input",r.value),o.call("change",r.value)),a.addRemoveClass("ws-active"),e(document).off("mousemove",s).off("mouseup",l),e(window).off("blur",u)},u=function(e){e.target==window&&l()},c=function(n){var o;if(n.preventDefault(),e(document).off("mousemove",s).off("mouseup",l),e(window).off("blur",u),!r.readonly&&!r.disabled){if(a.element.focus(),a.addRemoveClass("ws-active",!0),t=a.element.focus().offset(),i=a.element[a.dirs.innerWidth](),!i||!t)return;o=a.thumb[a.dirs.outerWidth](),t=t[a.dirs.pos],i=100/i,s(n,r.animate),e(document).on({mouseup:l,mousemove:s}),e(window).on("blur",u),n.stopPropagation()}},d={mousedown:c,focus:function(){r.disabled||(o.init("input",r.value),o.init("change",r.value),a.addRemoveClass("ws-focus",!0),a.updateMetrics()),n=!0},blur:function(){a.element.removeClass("ws-focus ws-active"),a.updateMetrics(),n=!1,o.init("input",r.value),o.call("change",r.value)},keyup:function(){a.addRemoveClass("ws-active"),o.call("input",r.value),o.call("change",r.value)},keydown:function(e){var t=!0,i=e.keyCode;r.readonly||r.disabled||(39==i||38==i?a.doStep(1):37==i||40==i?a.doStep(-1):33==i?a.doStep(10,r.animate):34==i?a.doStep(-10,r.animate):36==i?a.value(a.options.max,!1,r.animate):35==i?a.value(a.options.min,!1,r.animate):t=!1,t&&(a.addRemoveClass("ws-active",!0),o.call("input",r.value),e.preventDefault()))}};o.init("input",r.value,this.options.input),o.init("change",r.value,this.options.change),d[e.fn.mwheelIntent?"mwheelIntent":"mousewheel"]=function(e,t){t&&n&&!r.readonly&&!r.disabled&&(a.doStep(t),e.preventDefault(),o.call("input",r.value))},this.element.on(d),this.thumb.on({mousedown:c}),window.webshims&&webshims.ready("WINDOWLOAD",function(){webshims.ready("dom-support",function(){e.fn.onWSOff&&a.element.onWSOff("updateshadowdom",function(){a.updateMetrics()})}),!e.fn.onWSOff&&webshims._polyfill&&webshims._polyfill(["dom-support"])})},posCenter:function(e,t){var i;!this.options.calcCenter||this._init&&!this.element[0].offsetWidth||(e||(e=this.thumb),t||(t=e[this.dirs.outerWidth]()),t/=-2,e.css(this.dirs.marginLeft,t),this.options.calcTrail&&e[0]==this.thumb[0]&&(i=this.element[this.dirs.innerHeight](),e.css(this.dirs.marginTop,(e[this.dirs.outerHeight]()-i)/-2),this.range.css(this.dirs.marginTop,(this.range[this.dirs.outerHeight]()-i)/-2),t*=-1,this.trail.css(this.dirs.left,t).css(this.dirs.right,t)))},updateMetrics:function(){var e=this.element.innerWidth();this.vertical=e&&this.element.innerHeight()-e>10,this.dirs=this.vertical?{mouse:"pageY",pos:"top",min:"max",max:"min",left:"top",right:"bottom",width:"height",innerWidth:"innerHeight",innerHeight:"innerWidth",outerWidth:"outerHeight",outerHeight:"outerWidth",marginTop:"marginLeft",marginLeft:"marginTop"}:{mouse:"pageX",pos:"left",min:"min",max:"max",left:"left",right:"right",width:"width",innerWidth:"innerWidth",innerHeight:"innerHeight",outerWidth:"outerWidth",outerHeight:"outerHeight",marginTop:"marginTop",marginLeft:"marginLeft"},this.element[this.vertical?"addClass":"removeClass"]("vertical-range")[this.vertical?"addClass":"removeClass"]("horizontal-range"),this.posCenter()}},r=function(e){function t(){}return t.prototype=e,new t};e.fn.rangeUI=function(t){return t=e.extend({readonly:!1,disabled:!1,tabindex:0,min:0,step:1,max:100,value:50,input:e.noop,change:e.noop,_change:e.noop,showLabels:!0,options:{},calcCenter:!0,calcTrail:!0},t),this.each(function(){var i=e.extend(r(a),{element:e(this)});i.options=t,i._create.call(i)})},window.webshims&&webshims.isReady&&(webshims.ready("es5",function(){webshims.isReady("range-ui",!0)}),webshims._polyfill&&webshims._polyfill(["es5"]))})(window.webshims?webshims.$:jQuery);