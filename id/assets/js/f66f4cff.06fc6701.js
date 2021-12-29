"use strict";(self.webpackChunkdoc=self.webpackChunkdoc||[]).push([[142],{3905:function(e,t,r){r.d(t,{Zo:function(){return p},kt:function(){return f}});var n=r(7294);function o(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function i(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function l(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?i(Object(r),!0).forEach((function(t){o(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):i(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function a(e,t){if(null==e)return{};var r,n,o=function(e,t){if(null==e)return{};var r,n,o={},i=Object.keys(e);for(n=0;n<i.length;n++)r=i[n],t.indexOf(r)>=0||(o[r]=e[r]);return o}(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(n=0;n<i.length;n++)r=i[n],t.indexOf(r)>=0||Object.prototype.propertyIsEnumerable.call(e,r)&&(o[r]=e[r])}return o}var c=n.createContext({}),u=function(e){var t=n.useContext(c),r=t;return e&&(r="function"==typeof e?e(t):l(l({},t),e)),r},p=function(e){var t=u(e.components);return n.createElement(c.Provider,{value:t},e.children)},s={inlineCode:"code",wrapper:function(e){var t=e.children;return n.createElement(n.Fragment,{},t)}},d=n.forwardRef((function(e,t){var r=e.components,o=e.mdxType,i=e.originalType,c=e.parentName,p=a(e,["components","mdxType","originalType","parentName"]),d=u(r),f=o,m=d["".concat(c,".").concat(f)]||d[f]||s[f]||i;return r?n.createElement(m,l(l({ref:t},p),{},{components:r})):n.createElement(m,l({ref:t},p))}));function f(e,t){var r=arguments,o=t&&t.mdxType;if("string"==typeof e||o){var i=r.length,l=new Array(i);l[0]=d;var a={};for(var c in t)hasOwnProperty.call(t,c)&&(a[c]=t[c]);a.originalType=e,a.mdxType="string"==typeof e?e:o,l[1]=a;for(var u=2;u<i;u++)l[u]=r[u];return n.createElement.apply(null,l)}return n.createElement.apply(null,r)}d.displayName="MDXCreateElement"},9112:function(e,t,r){r.r(t),r.d(t,{frontMatter:function(){return a},contentTitle:function(){return c},metadata:function(){return u},toc:function(){return p},default:function(){return d}});var n=r(7462),o=r(3366),i=(r(7294),r(3905)),l=["components"],a={sidebar_position:1},c="Override Controller",u={unversionedId:"customization/override-controller",id:"customization/override-controller",title:"Override Controller",description:"To override the controller, you can follow the following steps:",source:"@site/docs/customization/override-controller.md",sourceDirName:"customization",slug:"/customization/override-controller",permalink:"/id/customization/override-controller",editUrl:"https://github.com/uasoft-indonesia/badaso-content-module/edit/main/website/docs/customization/override-controller.md",tags:[],version:"current",sidebarPosition:1,frontMatter:{sidebar_position:1},sidebar:"tutorialSidebar",previous:{title:"Supported Type Content",permalink:"/id/getting-started/supported-type-content"}},p=[],s={toc:p};function d(e){var t=e.components,r=(0,o.Z)(e,l);return(0,i.kt)("wrapper",(0,n.Z)({},s,r,{components:t,mdxType:"MDXLayout"}),(0,i.kt)("h1",{id:"override-controller"},"Override Controller"),(0,i.kt)("p",null,"To override the controller, you can follow the following steps:"),(0,i.kt)("ul",null,(0,i.kt)("li",{parentName:"ul"},"Create a new controller by using below command.")),(0,i.kt)("p",null,(0,i.kt)("inlineCode",{parentName:"p"},"php artisan make:controller ExampleController")),(0,i.kt)("ul",null,(0,i.kt)("li",{parentName:"ul"},"After the new controller is created, you can override the controller by registering the controller in the ",(0,i.kt)("inlineCode",{parentName:"li"},"config/badaso-content.php")," file in ",(0,i.kt)("inlineCode",{parentName:"li"},"controllers")," section. For example:")),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre",className:"language-php"},"return [\n    ...,\n\n    'controllers' => [\n        'ContentController@browse' => 'App\\Http\\Controllers\\ExampleController@browse',\n    ],\n];\n")),(0,i.kt)("ul",null,(0,i.kt)("li",{parentName:"ul"},"You can see the available keys of overrides in the ",(0,i.kt)("inlineCode",{parentName:"li"},"vendor/badaso/content-module/src/Routes/api.php")," file.")))}d.isMDXComponent=!0}}]);