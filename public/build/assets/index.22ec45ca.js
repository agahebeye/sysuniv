import{j as g,u as k,o as s,c as o,b,w as r,s as a,H as v,e as c,L as d,f as u,d as t,t as l,F as m,q as h,B as C,C as w,h as _,D as B}from"./main.09badf38.js";const L=t("title",null,"Students - Sysuniv",-1),H=t("h1",null,"Students",-1),N=_("Register new student"),S=_("Enroll new student"),V={class:"!mb-0"},D={class:"pagination"},E={class:"max-w-md"},T=t("thead",{class:"text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400"},[t("tr",null,[t("th",{scope:"col",class:"pl-2 py-2"}," firstname "),t("th",{scope:"col",class:"px-4 py-2"}," lastname ")])],-1),A=["onClick"],F={class:"pl-2 py-1"},M={class:"pl-2 py-1"},z=g({name:"index",props:{students:null},setup(n){const{isAdmin:f,isEmployee:p,isUniversity:y}=k();function x(i){B.Inertia.visit(i)}return(i,$)=>(s(),o("div",null,[b(a(v),null,{default:r(()=>[L]),_:1}),H,a(f)||a(p)?(s(),c(a(d),{key:0,href:"/students/create",class:"link"},{default:r(()=>[N]),_:1})):u("",!0),a(y)?(s(),c(a(d),{key:1,href:"/registrations/create",class:"link"},{default:r(()=>[S]),_:1})):u("",!0),t("h2",V,l(n.students.meta.from)+" to "+l(n.students.meta.to)+" of "+l(n.students.meta.total)+" student(s)",1),t("div",D,[(s(!0),o(m,null,h(n.students.meta.links,e=>(s(),c(w(e.url?a(d):"span"),{href:e.url,innerHTML:e.label,class:C(["px-1 text-xs no-underline",{"text-black":e.url,"font-bold":e.active}])},null,8,["href","innerHTML","class"]))),256))]),t("table",E,[T,t("tbody",null,[(s(!0),o(m,null,h(n.students.data,e=>(s(),o("tr",{class:"cursor-pointer hover:bg-gray-100",onClick:j=>x(`/students/${e.id}`),"data-test":"student"},[t("td",F,l(e.firstname),1),t("td",M,l(e.lastname),1)],8,A))),256))])])]))}});export{z as default};
