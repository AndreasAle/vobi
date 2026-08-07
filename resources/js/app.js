const rm=matchMedia('(prefers-reduced-motion:reduce)').matches;
  document.body.classList.add('loaded');
  // apply images
  if(window.IMG){document.querySelectorAll('[data-bg]').forEach(el=>{const u=window.IMG[el.dataset.bg];if(u)el.style.backgroundImage='url('+u+')';});}
  // apply background video (+poster fallback, pause on reduced-motion)
  if(window.VID){document.querySelectorAll('[data-vid]').forEach(v=>{const u=window.VID[v.dataset.vid];if(!u)return;
    if(window.IMG&&window.IMG[v.dataset.vid])v.poster=window.IMG[v.dataset.vid];
    v.src=u;
    if(rm){v.removeAttribute('autoplay');try{v.pause();}catch(e){}}else{const p=v.play();if(p&&p.catch)p.catch(()=>{});}});}
  // sticky nav
  const nav=document.querySelector('header.nav');
  addEventListener('scroll',()=>nav.classList.toggle('scrolled',scrollY>30),{passive:true});
  // reveal + count
  const io=new IntersectionObserver((es)=>{es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target);if(e.target.querySelector&&e.target.querySelector('[data-c]'))countIn(e.target);}})},{threshold:.14});
  document.querySelectorAll('.rv,.st').forEach(el=>io.observe(el));
  function countIn(scope){scope.querySelectorAll('[data-c]').forEach(el=>{if(el.dataset.done)return;el.dataset.done=1;
    const t=+el.dataset.c,pre=el.dataset.pre||'',suf=el.dataset.suf||'',dur=1400,t0=performance.now();
    if(rm){el.textContent=pre+t.toLocaleString('id-ID')+suf;return;}
    (function tick(n){const p=Math.min(1,(n-t0)/dur),e=1-Math.pow(1-p,3);el.textContent=pre+Math.round(t*e).toLocaleString('id-ID')+suf;if(p<1)requestAnimationFrame(tick);})(t0);});}
  // ticker loop
  const track=document.getElementById('track');if(track)track.appendChild(track.firstElementChild.cloneNode(true));
  // brand wall seamless loop
  document.querySelectorAll('.btrack').forEach(t=>{t.innerHTML+=t.innerHTML;});
  // faq
  document.querySelectorAll('.fitem .fq').forEach(b=>b.addEventListener('click',()=>{
    const it=b.parentElement,fa=it.querySelector('.fa'),open=it.classList.contains('open');
    document.querySelectorAll('.fitem.open').forEach(o=>{o.classList.remove('open');o.querySelector('.fa').style.maxHeight=null});
    if(!open){it.classList.add('open');fa.style.maxHeight=fa.scrollHeight+'px';}}));
  // layanan strip: drag-to-scroll
  const strip=document.getElementById('svcstrip');
  if(strip){let down=false,moved=false,sx=0,sl=0;
    strip.addEventListener('pointerdown',e=>{down=true;moved=false;sx=e.clientX;sl=strip.scrollLeft;});
    strip.addEventListener('pointermove',e=>{
      if(!down)return;
      const dx=e.clientX-sx;
      if(!moved&&Math.abs(dx)>6){moved=true;strip.style.cursor='grabbing';try{strip.setPointerCapture(e.pointerId);}catch(_){}}
      if(moved)strip.scrollLeft=sl-dx;
    });
    const end=()=>{down=false;strip.style.cursor='';};
    strip.addEventListener('pointerup',end);
    strip.addEventListener('pointercancel',end);
    // cegah navigasi HANYA kalau barusan nge-drag (klik biasa tetap jalan)
    strip.addEventListener('click',e=>{if(moved)e.preventDefault();},true);
    const nx=document.getElementById('svcnext');if(nx)nx.addEventListener('click',()=>strip.scrollBy({left:360,behavior:'smooth'}));
  }
// home: ecosystem staggered showcase (reveal + mouse parallax)
(function(){
  var eco = document.getElementById('eco2');
  if(!eco) return;
  var pars = [].slice.call(eco.querySelectorAll('.epar'));
  var io = new IntersectionObserver(function(es){
    es.forEach(function(e){
      if(e.isIntersecting){
        pars.forEach(function(p,i){ setTimeout(function(){ p.classList.add('in'); }, i*120); });
        io.disconnect();
      }
    });
  }, { threshold: 0.2 });
  io.observe(eco);

  if(matchMedia('(hover:hover) and (pointer:fine)').matches && !matchMedia('(prefers-reduced-motion:reduce)').matches){
    eco.addEventListener('mousemove', function(e){
      var r = eco.getBoundingClientRect();
      var dx = (e.clientX - r.left - r.width/2) / r.width;
      var dy = (e.clientY - r.top - r.height/2) / r.height;
      pars.forEach(function(p,i){
        var f = (i % 2 ? -1 : 1) * (7 + i*3);
        p.style.transform = 'translate(' + (dx*f).toFixed(1) + 'px,' + (dy*f*0.6).toFixed(1) + 'px)';
      });
    });
    eco.addEventListener('mouseleave', function(){
      pars.forEach(function(p){ p.style.transform = ''; });
    });
  }
})();

// mobile nav drawer
(function(){
  var burger = document.getElementById('navBurger');
  var drawer = document.getElementById('navDrawer');
  if(!burger || !drawer) return;
  function set(open){
    burger.classList.toggle('open', open);
    drawer.classList.toggle('open', open);
    burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    drawer.setAttribute('aria-hidden', open ? 'false' : 'true');
    document.body.style.overflow = open ? 'hidden' : '';
  }
  burger.addEventListener('click', function(){ set(!drawer.classList.contains('open')); });
  drawer.querySelectorAll('a').forEach(function(a){ a.addEventListener('click', function(){ set(false); }); });
  document.addEventListener('keydown', function(e){ if(e.key === 'Escape') set(false); });
})();
