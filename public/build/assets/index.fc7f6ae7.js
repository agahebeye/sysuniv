import{j as i,u,o as s,c as a,b as p,w as l,s as t,H as _,e as h,L as y,f,d as e,t as n,F as k,q as x,h as c}from"./main.09badf38.js";const g=e("title",null,"Employees - Sysuniv",-1),v=e("h1",null,"Employees",-1),w=c("Create new employee"),B=c(" employees"),C={class:"columns-2 gap-10 max-w-md"},E={class:"mb-2","data-test":"employee"},b=i({name:"index",props:{employees:null},setup(o){const{isAdmin:r,isEmployee:m}=u();return(N,V)=>(s(),a("div",null,[p(t(_),null,{default:l(()=>[g]),_:1}),v,t(r)||t(m)?(s(),h(t(y),{key:0,href:"/employees/create",class:"link"},{default:l(()=>[w]),_:1})):f("",!0),e("h2",null,[e("strong",null,n(o.employees.length),1),B]),e("div",C,[(s(!0),a(k,null,x(o.employees,d=>(s(),a("div",E,n(d.name),1))),256))])]))}});export{b as default};
