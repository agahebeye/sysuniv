import{_ as p,H as v,l as h,o as t,c as o,b as i,w as l,t as m,f as d,F as x,q as g,d as e,m as w,v as b,n as y,r as u,h as k}from"./main.c116dde0.js";import{_ as q}from"./GuestLayout.e0b219b1.js";import{_ as V}from"./XButton.a3f0f7e0.js";const B={props:{status:String},layout:q,components:{Head:v,XButton:V},setup(){return{form:h({email:""})}}},H={class:"max-w-sm"},N=e("title",null,"Reset password link - Sysuniv",-1),S=e("h1",null,"Demande de r\xE9initialisation de mot de passe",-1),C=e("p",null," Informez-nous de votre email et on vous enverra le lien qui vous dirigera vers la page de r\xE9initialisation de mot de passe ",-1),D={key:0,class:"mb-4 font-medium text-sm text-green-600"},F={key:1,class:"errors"},E={class:"mb-4"},M=e("label",{for:"email"},"email",-1),R=k(" lien de r\xE9initialisation ");function T(c,r,n,s,z,I){const _=u("Head"),f=u("x-button");return t(),o("div",H,[i(_,null,{default:l(()=>[N]),_:1}),S,C,n.status?(t(),o("div",D,m(n.status),1)):d("",!0),s.form.hasErrors?(t(),o("div",F,[(t(!0),o(x,null,g(s.form.errors,a=>(t(),o("div",null,m(a),1))),256))])):d("",!0),e("form",{onSubmit:r[1]||(r[1]=y(a=>s.form.post("/request-password-reset"),["prevent"]))},[e("div",E,[M,w(e("input",{id:"email",type:"email","onUpdate:modelValue":r[0]||(r[0]=a=>s.form.email=a),class:"input",required:"",autofocus:"",autocomplete:"username"},null,512),[[b,s.form.email]])]),i(f,{processing:s.form.processing},{default:l(()=>[R]),_:1},8,["processing"])],32)])}var X=p(B,[["render",T]]);export{X as default};
