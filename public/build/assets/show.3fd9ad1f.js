import{j as u,u as c,o as n,c as a,b as d,w as l,s as i,H as h,d as e,f as o,t as s,L as m,e as f,h as r}from"./main.09badf38.js";import x from"./RegistrationList.59b29a65.js";const g=e("h1",null,"Student's Profile",-1),v={class:""},k={class:"flex flex-col pb-10"},y={key:0},_=["src","alt"],b={class:"mb-1 text-xl font-medium text-gray-900 dark:text-white"},B={class:"text-sm text-gray-500 dark:text-gray-400"},w=r(),N={class:"text-sm"},S={class:"text-sm mt-4"},V=r("Add result for this year"),H=u({name:"show",props:{student:null},setup(t){return c(),(C,$)=>(n(),a("div",null,[d(i(h),null,{default:l(()=>[e("title",null,"Students/"+s(t.student.firstname)+" - Sysuniv",1)]),_:1}),g,e("div",null,[e("div",v,[e("div",k,[t.student.photo?(n(),a("div",y,[e("img",{src:`/avatars/${t.student.photo.src}`,alt:t.student.firstname},null,8,_)])):o("",!0),e("h5",b,s(t.student.firstname)+" "+s(t.student.lastname),1),e("div",B,[e("span",null,s(t.student.gender)+",",1),w,e("span",null,"lives "+s(t.student.address),1)]),e("div",N,"Born "+s(t.student.birthDate),1),e("div",S,[d(i(m),{class:"font-bold text-teal-700",href:`${t.student.id}/results/create`},{default:l(()=>[V]),_:1},8,["href"])]),t.student.registrations.length?(n(),f(x,{key:1,registrations:t.student.registrations},null,8,["registrations"])):o("",!0)])])])]))}});export{H as default};
