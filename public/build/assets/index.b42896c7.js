import{d,o as e,g as c,w as l,b as f,e as n,H as m,a as t,L as _,h,c as s,t as o,l as x,F as p,j as i}from"./main.f1e6f1a4.js";import{u as E}from"./auth.b0e84393.js";import{D as k}from"./default.21443a92.js";import"./plugin-vue_export-helper.21dcd24c.js";import"./AppHeader.608c0921.js";import"./XIcon.d7b1197c.js";const y=t("title",null,"Faculties - Sysuniv",-1),g=t("h1",null,"Facult\xE9s",-1),b=i("Cr\xE9er une nouvelle facult\xE9"),v={key:1,class:"mt-10 mb-8"},B=i(" facult\xE9(s)"),C={key:2,class:"mt-10 mb-8"},F={class:"flex flex-col flex-wrap list-disc list-inside"},L={class:"mb-2","data-test":"faculty"},T=d({name:"index",props:{faculties:null},setup(a){const{isUniversity:u}=E();return(N,V)=>(e(),c(k,null,{default:l(()=>[f(n(m),null,{default:l(()=>[y]),_:1}),t("div",null,[g,n(u)?h("",!0):(e(),c(n(_),{key:0,href:"/faculties/create",class:"link"},{default:l(()=>[b]),_:1})),a.faculties.length?(e(),s("h2",v,[t("strong",null,o(a.faculties.length),1),B])):(e(),s("h2",C,"Aucune facult\xE9 a \xE9t\xE9 enregistr\xE9e")),t("ul",F,[(e(!0),s(p,null,x(a.faculties,r=>(e(),s("li",L,o(r.name),1))),256))])])]),_:1}))}});export{T as default};
