import{j as m,u,o as e,c as t,b as _,w as n,s as a,H as h,e as p,L as x,f as y,d as s,t as c,F as E,q as f,h as r}from"./main.c116dde0.js";var g="/build/storage/avatars/avatar-placeholder.jpeg";const v=s("title",null,"Employ\xE9es - Minist\xE8re d'\xE9ducation du Burundi",-1),k=s("h1",null,"Employ\xE9es",-1),b=r("Cr\xE9er une nouvelle employ\xE9e"),w={key:1,class:"mt-10 mb-8"},B=r(" employ\xE9e(s)"),C={key:2,class:"mt-10 mb-8"},N={class:"columns-3 gap-12 max-w-2xl"},V={class:"mb-6 flex items-center space-x-3","data-test":"employee"},A=["alt"],L={class:"text-base"},q=m({name:"index",props:{employees:null},setup(l){const{isAdmin:i,isEmployee:d}=u();return(j,F)=>(e(),t("div",null,[_(a(h),null,{default:n(()=>[v]),_:1}),k,a(i)||a(d)?(e(),p(a(x),{key:0,href:"/employees/create",class:"link"},{default:n(()=>[b]),_:1})):y("",!0),l.employees.length?(e(),t("h2",w,[s("strong",null,c(l.employees.length),1),B])):(e(),t("h2",C,"Aucune employ\xE9e enregistr\xE9e \xE0 la base")),s("div",N,[(e(!0),t(E,null,f(l.employees,o=>(e(),t("div",V,[s("img",{class:"w-8 max-w-full rounded-full",src:g,alt:`${o.name} profile avatar`},null,8,A),s("div",L,c(o.name),1)]))),256))])]))}});export{q as default};
