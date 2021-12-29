"use strict";(self.webpackChunkdoc=self.webpackChunkdoc||[]).push([[852],{3905:function(e,t,n){n.d(t,{Zo:function(){return m},kt:function(){return d}});var a=n(7294);function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function i(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function o(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?i(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):i(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function l(e,t){if(null==e)return{};var n,a,r=function(e,t){if(null==e)return{};var n,a,r={},i=Object.keys(e);for(a=0;a<i.length;a++)n=i[a],t.indexOf(n)>=0||(r[n]=e[n]);return r}(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(a=0;a<i.length;a++)n=i[a],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(r[n]=e[n])}return r}var p=a.createContext({}),u=function(e){var t=a.useContext(p),n=t;return e&&(n="function"==typeof e?e(t):o(o({},t),e)),n},m=function(e){var t=u(e.components);return a.createElement(p.Provider,{value:t},e.children)},s={inlineCode:"code",wrapper:function(e){var t=e.children;return a.createElement(a.Fragment,{},t)}},c=a.forwardRef((function(e,t){var n=e.components,r=e.mdxType,i=e.originalType,p=e.parentName,m=l(e,["components","mdxType","originalType","parentName"]),c=u(n),d=r,k=c["".concat(p,".").concat(d)]||c[d]||s[d]||i;return n?a.createElement(k,o(o({ref:t},m),{},{components:n})):a.createElement(k,o({ref:t},m))}));function d(e,t){var n=arguments,r=t&&t.mdxType;if("string"==typeof e||r){var i=n.length,o=new Array(i);o[0]=c;var l={};for(var p in t)hasOwnProperty.call(t,p)&&(l[p]=t[p]);l.originalType=e,l.mdxType="string"==typeof e?e:r,o[1]=l;for(var u=2;u<i;u++)o[u]=n[u];return a.createElement.apply(null,o)}return a.createElement.apply(null,n)}c.displayName="MDXCreateElement"},4534:function(e,t,n){n.r(t),n.d(t,{frontMatter:function(){return l},contentTitle:function(){return p},metadata:function(){return u},toc:function(){return m},default:function(){return c}});var a=n(7462),r=n(3366),i=(n(7294),n(3905)),o=["components"],l={sidebar_position:1},p="Installation",u={unversionedId:"getting-started/installation",id:"getting-started/installation",title:"Installation",description:"1. Instal badaso dulu. Setelah itu, Anda dapat menginstal modul dengan perintah berikut.",source:"@site/i18n/id/docusaurus-plugin-content-docs/current/getting-started/installation.md",sourceDirName:"getting-started",slug:"/getting-started/installation",permalink:"/id/getting-started/installation",editUrl:"https://github.com/uasoft-indonesia/badaso-content-module/edit/main/website/docs/getting-started/installation.md",tags:[],version:"current",sidebarPosition:1,frontMatter:{sidebar_position:1},sidebar:"tutorialSidebar",previous:{title:"Introduction",permalink:"/id/"},next:{title:"Supported Type Content",permalink:"/id/getting-started/supported-type-content"}},m=[],s={toc:m};function c(e){var t=e.components,n=(0,r.Z)(e,o);return(0,i.kt)("wrapper",(0,a.Z)({},s,n,{components:t,mdxType:"MDXLayout"}),(0,i.kt)("h1",{id:"installation"},"Installation"),(0,i.kt)("ol",null,(0,i.kt)("li",{parentName:"ol"},"Instal badaso dulu. Setelah itu, Anda dapat menginstal modul dengan perintah berikut.")),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre",className:"language-bash"},"composer require badaso/commerce-module\n")),(0,i.kt)("ol",{start:2},(0,i.kt)("li",{parentName:"ol"},"Jalankan perintah berikut untuk mengatur modul dengan mudah.")),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre",className:"language-bash"},"php artisan migrate\nphp artisan badaso-commerce:setup\ncomposer dump-autoload\nphp artisan db:seed --class=BadasoCommerceModuleSeeder\n")),(0,i.kt)("ol",{start:3},(0,i.kt)("li",{parentName:"ol"},"Tambahkan plugin ke ",(0,i.kt)("inlineCode",{parentName:"li"},"MIX_BADASO_MODULES")," Anda ke ",(0,i.kt)("inlineCode",{parentName:"li"},".env"),". Jika Anda memiliki plugin lain yang diinstal, sertakan mereka menggunakan koma pembatas (,).")),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre"},"MIX_BADASO_MODULES=commerce-module\n")),(0,i.kt)("ol",{start:4},(0,i.kt)("li",{parentName:"ol"},"Tambahkan menu plugin ke ",(0,i.kt)("inlineCode",{parentName:"li"},"MIX_BADASO_MENU")," Anda ke ",(0,i.kt)("inlineCode",{parentName:"li"},".env"),". Jika Anda memiliki menu lain, sertakan menu tersebut menggunakan koma pembatas (,).")),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre"},"MIX_BADASO_MENU=admin,commerce-module\n")),(0,i.kt)("ol",{start:5},(0,i.kt)("li",{parentName:"ol"},(0,i.kt)("p",{parentName:"li"},"Isi variabel lain dalam file .env."),(0,i.kt)("ul",{parentName:"li"},(0,i.kt)("li",{parentName:"ul"},(0,i.kt)("inlineCode",{parentName:"li"},"COMMERCE_PRODUCTS_LIMIT_QUERY=10")," Limit query browse on product, default is 10."),(0,i.kt)("li",{parentName:"ul"},(0,i.kt)("inlineCode",{parentName:"li"},"MIX_PAYMENT_MODULE=commerce-module")," Register the payment module."))),(0,i.kt)("li",{parentName:"ol"},(0,i.kt)("p",{parentName:"li"},"Isi konfigurasi pembayaran di ",(0,i.kt)("inlineCode",{parentName:"p"},"badaso-commerce.php"),". Sebagai contoh:"),(0,i.kt)("ul",{parentName:"li"},(0,i.kt)("li",{parentName:"ul"},(0,i.kt)("inlineCode",{parentName:"li"},"'payments' => ['Uasoft\\Badaso\\Module\\Commerce\\BadasoCommerceModule']")))),(0,i.kt)("li",{parentName:"ol"},(0,i.kt)("p",{parentName:"li"},"Instal ",(0,i.kt)("a",{parentName:"p",href:"https://github.com/uasoft-indonesia/badaso-commerce-theme"},"commerce theme")))))}c.isMDXComponent=!0}}]);