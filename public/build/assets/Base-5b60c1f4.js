import{o as r,f as n,b as e,a as o,w as l,t as s,u as c,j as d,d as h,F as u,k as m,r as f}from"./app-3b324130.js";import{_}from"./NavLink-e454b8b6.js";const b={class:"mb-8"},x={class:"bg-slate-100 py-8 shadow-xl shadow-slate-500 mb-8"},g={id:"site-header",class:"container-full"},v={id:"site-title",class:"text-center md:text-right border-0 md:border-l border-slate-700 mb-4 md:mb-0"},k=["src"],w={class:"font-headerSans"},y={id:"site-tag",class:"self-center p-3 font-headerSans text-lg text-right hidden md:block"},L={id:"site-nav",class:"container-full self-end text-center"},B={class:"list-none m-0"},S={class:"container-full border-t border-slate-500"},F={__name:"Base",props:["copyrightYear","navLinks","author"],setup(t){return(i,N)=>(r(),n("div",b,[e("header",x,[e("div",g,[e("section",v,[o(c(d),{href:i.route("home"),class:"text-neutral-700 hover:text-neutral-700"},{default:l(()=>[e("img",{src:t.author.image.url,style:{"max-width":"150px"},class:"inline"},null,8,k),e("h1",w,s(t.author.name),1)]),_:1},8,["href"]),o(c(d),{href:t.author.linkedInUrl},{default:l(()=>[h("Connect with me on LinkedIn")]),_:1},8,["href"])]),e("section",y,s(t.author.tagLine),1),e("nav",L,[e("ul",B,[(r(!0),n(u,null,m(t.navLinks,a=>(r(),n("li",{key:a.url,class:"inline mx-6"},[o(_,{href:a.url,active:!0},{default:l(()=>[h(s(a.label),1)]),_:2},1032,["href"])]))),128))])])])]),f(i.$slots,"default"),e("footer",S," © "+s(t.copyrightYear)+" "+s(t.author.name),1)]))}};export{F as _};
