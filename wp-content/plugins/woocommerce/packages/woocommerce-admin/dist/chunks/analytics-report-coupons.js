(window.__wcAdmin_webpackJsonp=window.__wcAdmin_webpackJsonp||[]).push([[7],{486:function(e,t,o){"use strict";o.r(t);var n=o(0),r=o(1),c=o.n(r),a=o(2),s=o(540),i=o(4),u=o(21),m=o(12),d=o(120),l=o(13),p=o(20),b=o(509),_=o(503);class y extends n.Component{constructor(){super(),this.getHeadersContent=this.getHeadersContent.bind(this),this.getRowsContent=this.getRowsContent.bind(this),this.getSummary=this.getSummary.bind(this)}getHeadersContent(){return[{label:Object(a.__)("Coupon code",'woocommerce'),key:"code",required:!0,isLeftAligned:!0,isSortable:!0},{label:Object(a.__)("Orders",'woocommerce'),key:"orders_count",required:!0,defaultSort:!0,isSortable:!0,isNumeric:!0},{label:Object(a.__)("Amount discounted",'woocommerce'),key:"amount",isSortable:!0,isNumeric:!0},{label:Object(a.__)("Created",'woocommerce'),key:"created"},{label:Object(a.__)("Expires",'woocommerce'),key:"expires"},{label:Object(a.__)("Type",'woocommerce'),key:"type"}]}getRowsContent(e){const{query:t}=this.props,o=Object(m.getPersistedQuery)(t),r=Object(l.f)("dateFormat",p.defaultTableDateFormat),{formatAmount:c,formatDecimal:s,getCurrencyConfig:b}=this.context;return Object(i.map)(e,e=>{const{amount:t,coupon_id:i,orders_count:l}=e,p=e.extended_info||{},{code:_,date_created:y,date_expires:f,discount_type:j}=p,O=i>0?Object(m.getNewPath)(o,"/analytics/coupons",{filter:"single_coupon",coupons:i}):null,h=null===O?_:Object(n.createElement)(u.Link,{href:O,type:"wc-admin"},_),g=i>0?Object(m.getNewPath)(o,"/analytics/orders",{filter:"advanced",coupon_includes:i}):null;return[{display:h,value:_},{display:null===g?l:Object(n.createElement)(u.Link,{href:g,type:"wc-admin"},Object(d.formatValue)(b(),"number",l)),value:l},{display:c(t),value:s(t)},{display:y?Object(n.createElement)(u.Date,{date:y,visibleFormat:r}):Object(a.__)("N/A",'woocommerce'),value:y},{display:f?Object(n.createElement)(u.Date,{date:f,visibleFormat:r}):Object(a.__)("N/A",'woocommerce'),value:f},{display:this.getCouponType(j),value:j}]})}getSummary(e){const{coupons_count:t=0,orders_count:o=0,amount:n=0}=e,{formatAmount:r,getCurrencyConfig:c}=this.context,s=c();return[{label:Object(a._n)("Coupon","Coupons",t,'woocommerce'),value:Object(d.formatValue)(s,"number",t)},{label:Object(a._n)("Order","Orders",o,'woocommerce'),value:Object(d.formatValue)(s,"number",o)},{label:Object(a.__)("Amount discounted",'woocommerce'),value:r(n)}]}getCouponType(e){return{percent:Object(a.__)("Percentage",'woocommerce'),fixed_cart:Object(a.__)("Fixed cart",'woocommerce'),fixed_product:Object(a.__)("Fixed product",'woocommerce')}[e]||Object(a.__)("N/A",'woocommerce')}render(){const{advancedFilters:e,filters:t,isRequesting:o,query:r}=this.props;return Object(n.createElement)(b.a,{compareBy:"coupons",endpoint:"coupons",getHeadersContent:this.getHeadersContent,getRowsContent:this.getRowsContent,getSummary:this.getSummary,summaryFields:["coupons_count","orders_count","amount"],isRequesting:o,itemIdField:"coupon_id",query:r,searchBy:"coupons",tableQuery:{orderby:r.orderby||"orders_count",order:r.order||"desc",extended_info:!0},title:Object(a.__)("Coupons",'woocommerce'),columnPrefsKey:"coupons_report_columns",filters:t,advancedFilters:e})}}y.contextType=_.a;var f=y,j=o(512),O=o(510),h=o(513),g=o(508);class w extends n.Component{getChartMeta(){const{query:e}=this.props,t="compare-coupons"===e.filter&&e.coupons&&e.coupons.split(",").length>1?"item-comparison":"time-comparison";return{itemsLabel:Object(a.__)("%d coupons",'woocommerce'),mode:t}}render(){const{isRequesting:e,query:t,path:o}=this.props,{mode:r,itemsLabel:c}=this.getChartMeta(),a={...t};return"item-comparison"===r&&(a.segmentby="coupon"),Object(n.createElement)(n.Fragment,null,Object(n.createElement)(g.a,{query:t,path:o,filters:s.c,advancedFilters:s.a,report:"coupons"}),Object(n.createElement)(h.a,{charts:s.b,endpoint:"coupons",isRequesting:e,query:a,selectedChart:Object(j.a)(t.chart,s.b),filters:s.c,advancedFilters:s.a}),Object(n.createElement)(O.a,{charts:s.b,filters:s.c,advancedFilters:s.a,mode:r,endpoint:"coupons",path:o,query:a,isRequesting:e,itemsLabel:c,selectedChart:Object(j.a)(t.chart,s.b)}),Object(n.createElement)(f,{isRequesting:e,query:t,filters:s.c,advancedFilters:s.a}))}}w.propTypes={query:c.a.object.isRequired};t.default=w},504:function(e,t,o){"use strict";o.d(t,"e",(function(){return d})),o.d(t,"a",(function(){return l})),o.d(t,"b",(function(){return p})),o.d(t,"c",(function(){return b})),o.d(t,"d",(function(){return _})),o.d(t,"f",(function(){return y})),o.d(t,"h",(function(){return f})),o.d(t,"g",(function(){return j}));var n=o(16),r=o(19),c=o.n(r),a=o(4),s=o(12),i=o(11),u=o(13),m=o(505);function d(e,t=a.identity){return function(o="",r){const a="function"==typeof e?e(r):e,i=Object(s.getIdsFromQuery)(o);if(i.length<1)return Promise.resolve([]);const u={include:i.join(","),per_page:i.length};return c()({path:Object(n.addQueryArgs)(a,u)}).then(e=>e.map(t))}}d(i.NAMESPACE+"/products/attributes",e=>({key:e.id,label:e.name}));const l=d(i.NAMESPACE+"/products/categories",e=>({key:e.id,label:e.name})),p=d(i.NAMESPACE+"/coupons",e=>({key:e.id,label:e.code})),b=d(i.NAMESPACE+"/customers",e=>({key:e.id,label:e.name})),_=d(i.NAMESPACE+"/products",e=>({key:e.id,label:e.name})),y=d(i.NAMESPACE+"/taxes",e=>({key:e.id,label:Object(m.a)(e)}));function f({attributes:e,name:t}){const o=Object(u.f)("variationTitleAttributesSeparator"," - ");if(t&&t.indexOf(o)>-1)return t;const n=(e||[]).map(({option:e})=>e).join(", ");return n?t+o+n:t}const j=d(({products:e})=>e?i.NAMESPACE+`/products/${e}/variations`:i.NAMESPACE+"/variations",e=>({key:e.id,label:f(e)}))},505:function(e,t,o){"use strict";o.d(t,"a",(function(){return r}));var n=o(2);function r(e){return[e.country,e.state,e.name||Object(n.__)("TAX",'woocommerce'),e.priority].map(e=>e.toString().toUpperCase().trim()).filter(Boolean).join("-")}},540:function(e,t,o){"use strict";o.d(t,"b",(function(){return u})),o.d(t,"a",(function(){return m})),o.d(t,"c",(function(){return l}));var n=o(2),r=o(31),c=o(7),a=o(504),s=o(55);const{addCesSurveyForAnalytics:i}=Object(c.dispatch)(s.c),u=Object(r.applyFilters)("woocommerce_admin_coupons_report_charts",[{key:"orders_count",label:Object(n.__)("Discounted orders",'woocommerce'),order:"desc",orderby:"orders_count",type:"number"},{key:"amount",label:Object(n.__)("Amount",'woocommerce'),order:"desc",orderby:"amount",type:"currency"}]),m=Object(r.applyFilters)("woocommerce_admin_coupon_report_advanced_filters",{filters:{},title:Object(n._x)("Coupons match {{select /}} filters","A sentence describing filters for Coupons. See screen shot for context: https://cloudup.com/cSsUY9VeCVJ",'woocommerce')}),d=[{label:Object(n.__)("All coupons",'woocommerce'),value:"all"},{label:Object(n.__)("Single coupon",'woocommerce'),value:"select_coupon",chartMode:"item-comparison",subFilters:[{component:"Search",value:"single_coupon",chartMode:"item-comparison",path:["select_coupon"],settings:{type:"coupons",param:"coupons",getLabels:a.b,labels:{placeholder:Object(n.__)("Type to search for a coupon",'woocommerce'),button:Object(n.__)("Single Coupon",'woocommerce')}}}]},{label:Object(n.__)("Comparison",'woocommerce'),value:"compare-coupons",settings:{type:"coupons",param:"coupons",getLabels:a.b,labels:{title:Object(n.__)("Compare Coupon Codes",'woocommerce'),update:Object(n.__)("Compare",'woocommerce'),helpText:Object(n.__)("Check at least two coupon codes below to compare",'woocommerce')},onClick:i}}];Object.keys(m.filters).length&&d.push({label:Object(n.__)("Advanced filters",'woocommerce'),value:"advanced"});const l=Object(r.applyFilters)("woocommerce_admin_coupons_report_filters",[{label:Object(n.__)("Show",'woocommerce'),staticParams:["chartType","paged","per_page"],param:"filter",showFilters:()=>!0,filters:d}])}}]);