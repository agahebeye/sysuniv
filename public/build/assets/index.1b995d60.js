import{d as m,o as t,c as e,b as l,w as i,e as a,H as _,F as o,a as s,g as h,L as f,h as x,t as u,l as p,j as r}from"./main.f1e6f1a4.js";import{u as k}from"./auth.b0e84393.js";import{D as g}from"./default.21443a92.js";import"./plugin-vue_export-helper.21dcd24c.js";import"./AppHeader.608c0921.js";import"./XIcon.d7b1197c.js";const E=s("title",null,"Instituts - Minist\xE8re de l'\xE9ducation du Burundi",-1),y=s("h1",null,"Instituts",-1),B=r("Cr\xE9er nouveau institut"),b={key:1,class:"mt-10 mb-8"},C=r(" institut(s)"),L={key:2,class:"mt-10 mb-8"},N={class:"flex flex-col flex-wrap list-disc list-inside"},V={class:"mb-2","data-test":"institute"},M=m({name:"index",props:{institutes:null},setup(n){const{isUniversity:c}=k();return(v,w)=>(t(),e(o,null,[l(a(_),null,{default:i(()=>[E]),_:1}),l(g,null,{default:i(()=>[s("div",null,[y,a(c)?x("",!0):(t(),h(a(f),{key:0,href:"/institutes/create",class:"link"},{default:i(()=>[B]),_:1})),n.institutes.length?(t(),e("h2",b,[s("strong",null,u(n.institutes.length),1),C])):(t(),e("h2",L,"Aucune institut a \xE9t\xE9 enregistr\xE9")),s("ul",N,[(t(!0),e(o,null,p(n.institutes,d=>(t(),e("li",V,u(d.name),1))),256))])])]),_:1})],64))}});export{M as default};
