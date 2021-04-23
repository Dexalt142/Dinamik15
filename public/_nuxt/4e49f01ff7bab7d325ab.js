(window.webpackJsonp=window.webpackJsonp||[]).push([[8],{157:function(t,e,r){"use strict";r.r(e);r(29);var n=r(10),o=r(240),l=r(242),c=r(30),d={middleware:"guest",head:function(){return{title:"Login - ".concat("Dinamik 15")}},components:{Card:o.default,FormInput:l.default},data:function(){return{authCredential:{email:"",password:""},formErrors:{},loading:!1}},methods:{submitLogin:function(){var t=this;return Object(n.a)(regeneratorRuntime.mark((function e(){var r,n;return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return t.loading=!0,t.formErrors={},e.prev=2,e.next=5,t.$axios.post(c.a.API_ENDPOINT.LOGIN,t.authCredential);case 5:n=e.sent,r=n.data,e.next=14;break;case 9:return e.prev=9,e.t0=e.catch(2),"Network Error"!==e.t0.message&&e.t0.response.data&&(t.formErrors=e.t0.response.data.errors),t.loading=!1,e.abrupt("return");case 14:return t.$store.dispatch("auth/saveToken",{token:r.token,tokenExpiration:r.expires_in}),e.next=17,t.$store.dispatch("auth/fetchUserData");case 17:return e.next=19,t.$store.dispatch("team/fetchTeamData");case 19:t.$store.getters["auth/userVerified"]?t.$router.push({name:"dashboard"}):t.$router.push({name:"verification"});case 20:case"end":return e.stop()}}),e,null,[[2,9]])})))()}},mounted:function(){}},m=r(25),component=Object(m.a)(d,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"container main-container"},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-6 mx-auto"},[r("Card",{attrs:{color:"white",title:"Login",loading:t.loading,loading_title:"Mengotentikasi"}},[r("form",{on:{submit:function(e){return e.preventDefault(),t.submitLogin(e)}}},[r("FormInput",{attrs:{name:"email",label:"Email",type:"email",autocomplete:!0,error:t.formErrors.email},model:{value:t.authCredential.email,callback:function(e){t.$set(t.authCredential,"email",e)},expression:"authCredential.email"}}),t._v(" "),r("FormInput",{attrs:{name:"password",label:"Password",type:"password",error:t.formErrors.password},model:{value:t.authCredential.password,callback:function(e){t.$set(t.authCredential,"password",e)},expression:"authCredential.password"}}),t._v(" "),r("div",{staticClass:"form-group d-flex justify-content-center"},[r("button",{staticClass:"btn btn-primary"},[t._v("Login")]),t._v(" "),r("router-link",{staticClass:"ml-auto",attrs:{to:{name:"password.forgot"}}},[t._v("Lupa password?")])],1),t._v(" "),r("hr"),t._v(" "),r("p",[t._v("Belum memiliki akun? "),r("router-link",{attrs:{to:{name:"register"}}},[t._v("Daftar")])],1)],1)])],1)])])}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{FormInput:r(242).default,Card:r(240).default})},239:function(t,e,r){"use strict";r.r(e);var n={name:"LoadingSpinner",props:{title:{type:String}}},o=r(25),component=Object(o.a)(n,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"loading"},[e("div",{staticClass:"spinner"}),this._v(" "),this.title?e("div",{staticClass:"title"},[this._v(this._s(this.title))]):this._e()])}),[],!1,null,null,null);e.default=component.exports},240:function(t,e,r){"use strict";r.r(e);r(239);var n={name:"Card",props:{title:{type:String},color:{type:String},loading:{type:Boolean},loading_title:{type:String}}},o=r(25),component=Object(o.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"card",class:{"card-white":"white"===t.color}},[r("div",{staticClass:"card-body"},[t.title?r("div",{staticClass:"card-title"},[t._v(t._s(t.title))]):t._e(),t._v(" "),t._t("default")],2),t._v(" "),t.loading?r("LoadingSpinner",{class:{"loading-white":"white"===t.color},attrs:{title:t.loading_title}}):t._e()],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{LoadingSpinner:r(239).default})},241:function(t,e,r){"use strict";r.r(e);var n={name:"FormError",props:{message:{type:Array}}},o=r(25),component=Object(o.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"invalid-feedback"},t._l(t.message,(function(e){return r("div",{key:e},[t._v(t._s(e))])})),0)}),[],!1,null,null,null);e.default=component.exports},242:function(t,e,r){"use strict";r.r(e);var n=r(241),o={name:"FormInput",props:{name:{type:String},label:{type:String},type:{type:String,required:!0,default:"text"},error:{type:Array},autocomplete:{type:Boolean,default:!1},value:{}},components:{FormError:n.default},methods:{updateValue:function(){this.$emit("input",this.$refs.inputRef.value)}}},l=r(25),component=Object(l.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-group"},[t.label?r("label",[t._v(t._s(t.label))]):t._e(),t._v(" "),r("input",{ref:"inputRef",staticClass:"form-control",class:{"is-invalid":t.error},attrs:{type:t.type,name:t.name,autocomplete:t.autocomplete?"on":"off"},domProps:{value:t.value},on:{input:function(e){return t.updateValue()}}}),t._v(" "),t.error?r("FormError",{attrs:{message:t.error}}):t._e()],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{FormError:r(241).default})}}]);