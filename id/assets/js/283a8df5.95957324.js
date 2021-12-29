"use strict";(self.webpackChunkdoc=self.webpackChunkdoc||[]).push([[850],{3905:function(e,t,n){n.d(t,{Zo:function(){return m},kt:function(){return s}});var r=n(7294);function a(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function o(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function p(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?o(Object(n),!0).forEach((function(t){a(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):o(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function l(e,t){if(null==e)return{};var n,r,a=function(e,t){if(null==e)return{};var n,r,a={},o=Object.keys(e);for(r=0;r<o.length;r++)n=o[r],t.indexOf(n)>=0||(a[n]=e[n]);return a}(e,t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);for(r=0;r<o.length;r++)n=o[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(a[n]=e[n])}return a}var u=r.createContext({}),i=function(e){var t=r.useContext(u),n=t;return e&&(n="function"==typeof e?e(t):p(p({},t),e)),n},m=function(e){var t=i(e.components);return r.createElement(u.Provider,{value:t},e.children)},c={inlineCode:"code",wrapper:function(e){var t=e.children;return r.createElement(r.Fragment,{},t)}},d=r.forwardRef((function(e,t){var n=e.components,a=e.mdxType,o=e.originalType,u=e.parentName,m=l(e,["components","mdxType","originalType","parentName"]),d=i(n),s=a,x=d["".concat(u,".").concat(s)]||d[s]||c[s]||o;return n?r.createElement(x,p(p({ref:t},m),{},{components:n})):r.createElement(x,p({ref:t},m))}));function s(e,t){var n=arguments,a=t&&t.mdxType;if("string"==typeof e||a){var o=n.length,p=new Array(o);p[0]=d;var l={};for(var u in t)hasOwnProperty.call(t,u)&&(l[u]=t[u]);l.originalType=e,l.mdxType="string"==typeof e?e:a,p[1]=l;for(var i=2;i<o;i++)p[i]=n[i];return r.createElement.apply(null,p)}return r.createElement.apply(null,n)}d.displayName="MDXCreateElement"},2376:function(e,t,n){n.r(t),n.d(t,{frontMatter:function(){return l},contentTitle:function(){return u},metadata:function(){return i},toc:function(){return m},default:function(){return d}});var r=n(7462),a=n(3366),o=(n(7294),n(3905)),p=["components"],l={sidebar_position:2},u="Supported Type Content",i={unversionedId:"getting-started/supported-type-content",id:"getting-started/supported-type-content",title:"Supported Type Content",description:"1. Text",source:"@site/docs/getting-started/supported-type-content.md",sourceDirName:"getting-started",slug:"/getting-started/supported-type-content",permalink:"/id/getting-started/supported-type-content",editUrl:"https://github.com/uasoft-indonesia/badaso-content-module/edit/main/website/docs/getting-started/supported-type-content.md",tags:[],version:"current",sidebarPosition:2,frontMatter:{sidebar_position:2},sidebar:"tutorialSidebar",previous:{title:"Installation",permalink:"/id/getting-started/installation"},next:{title:"Override Controller",permalink:"/id/customization/override-controller"}},m=[{value:"JSON example output",id:"json-example-output",children:[],level:5},{value:"JSON example output",id:"json-example-output-1",children:[],level:5},{value:"JSON example output",id:"json-example-output-2",children:[],level:5},{value:"JSON example output",id:"json-example-output-3",children:[],level:5},{value:"JSON example output all fetch",id:"json-example-output-all-fetch",children:[],level:5}],c={toc:m};function d(e){var t=e.components,n=(0,a.Z)(e,p);return(0,o.kt)("wrapper",(0,r.Z)({},c,n,{components:t,mdxType:"MDXLayout"}),(0,o.kt)("h1",{id:"supported-type-content"},"Supported Type Content"),(0,o.kt)("ol",null,(0,o.kt)("li",{parentName:"ol"},"Text")),(0,o.kt)("p",null,"Support text type value content."),(0,o.kt)("h5",{id:"json-example-output"},"JSON example output"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},'{\n    "text-exmaple" : {\n        "name" : "text-example",\n        "label" : "Text Example",\n        "type" : "text",\n        "data" : "Lorem ibsum siamet dor..."\n    }\n}\n')),(0,o.kt)("ol",{start:2},(0,o.kt)("li",{parentName:"ol"},"Image")),(0,o.kt)("p",null,"Support image type value content, image your choice for value content automatic save ",(0,o.kt)("inlineCode",{parentName:"p"},"storage/app")," in laravel project."),(0,o.kt)("h5",{id:"json-example-output-1"},"JSON example output"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},'{\n    "image-example" : {\n        "name" : "image-example",\n        "label" : "Image Example",\n        "type" : "image",\n        "data" : "image-example.png"\n    }\n}\n')),(0,o.kt)("ol",{start:3},(0,o.kt)("li",{parentName:"ol"},"URL")),(0,o.kt)("p",null,"Support url type value content."),(0,o.kt)("h5",{id:"json-example-output-2"},"JSON example output"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},'{\n    "url-example" : {\n        "name" : "url-example",\n        "label" : "URL Example",\n        "type" : "url",\n        "data" : {\n            "url" : "http://example.com",\n            "text" : "Somthing Text"\n        }\n    }\n}\n')),(0,o.kt)("ol",{start:4},(0,o.kt)("li",{parentName:"ol"},"Group")),(0,o.kt)("p",null,"Support value type content groups that accommodate other types of content."),(0,o.kt)("h5",{id:"json-example-output-3"},"JSON example output"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},'{\n    "group-example" : {\n        "name" : "group-example",\n        "label" : "Group Example",\n        "type" : "group",\n        "data" : {\n            "url-example" : {\n                "name" : "url-example",\n                "label" : "URL Example",\n                "type" : "url",\n                "data" : {\n                    "url" : "http://example.com",\n                    "text" : "Somthing Text"\n                }\n            },\n            ... \n        }\n    }\n}\n')),(0,o.kt)("h5",{id:"json-example-output-all-fetch"},"JSON example output all fetch"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},'{\n    "id" : 1,\n    "slug" : "example-content",\n    "label" : "Example Content",\n    "value" : {\n        "group-example" : {\n            "name" : "group-example",\n            "label" : "Group Example",\n            "type" : "group",\n            "data" : {\n                "url-example" : {\n                    "name" : "url-example",\n                    "label" : "URL Example",\n                    "type" : "url",\n                    "data" : {\n                        "url" : "http://example.com",\n                        "text" : "Somthing Text"\n                    }\n                },\n                ...\n            }\n        }\n        ...\n    }\n}\n')))}d.isMDXComponent=!0}}]);