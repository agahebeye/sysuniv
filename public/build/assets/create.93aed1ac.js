import{j as _,l as f,o,c as n,b as a,w as i,s,H as h,e as g,f as d,d as t,t as v,n as x,h as b}from"./main.c116dde0.js";import{_ as k}from"./ValidationErrorList.3ebfbcbf.js";import{_ as y}from"./XButton.a3f0f7e0.js";const S={class:"max-w-sm"},w=t("title",null,"Add student photo - Sysuniv",-1),B=t("h1",null,"Add student photo",-1),N=["onSubmit"],V={class:"mb-6"},A=["value"],C=b("Add photo"),j=_({name:"create",props:{student:null},setup(u){const c=u,e=f({photo:null});function l(p){e.post(`/students/${c.student.id}/photos/store`)}return(p,r)=>(o(),n("div",S,[a(s(h),null,{default:i(()=>[w]),_:1}),B,s(e).hasErrors?(o(),g(k,{key:0,errors:s(e).errors},null,8,["errors"])):d("",!0),t("form",{onSubmit:x(l,["prevent"])},[t("div",V,[t("input",{type:"file",onInput:r[0]||(r[0]=m=>s(e).photo=m.target.files["0"]),required:"",class:"input-file"},null,32),s(e).progress?(o(),n("progress",{key:0,value:s(e).progress.percentage,max:"100"},v(s(e).progress.percentage)+"% ",9,A)):d("",!0)]),a(y,{processing:s(e).processing,class:"!m-0 button-sm"},{default:i(()=>[C]),_:1},8,["processing"])],40,N)]))}});export{j as default};
