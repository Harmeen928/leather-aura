(function () {
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  gsap.registerPlugin(ScrollTrigger);

  var slides = [].slice.call(document.querySelectorAll('.slide'));
  var bars = [].slice.call(document.querySelectorAll('.bar'));
  var hero = document.querySelector('.hero');
  var curNum = document.getElementById('curNum');
  var cur = 0, timer = null, busy = false, DURATION = 6000;

  function intro(slide) {
    var tl = gsap.timeline();
    tl.fromTo(slide.querySelectorAll('.line > span'), { yPercent: 110, rotate: 3 }, { yPercent: 0, rotate: 0, duration: 0.9, stagger: 0.12, ease: 'power4.out' })
      .fromTo(slide.querySelector('.eyebrow'), { opacity: 0, x: -20 }, { opacity: 1, x: 0, duration: 0.6 }, 0.1)
      .fromTo(slide.querySelectorAll('.fade'), { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.6, stagger: 0.1 }, 0.5)
      .fromTo(slide.querySelector('.visual-card'), { clipPath: 'inset(0 0 100% 0)', scale: 1.15 }, { clipPath: 'inset(0 0 0% 0)', scale: 1, duration: 1.1, ease: 'power4.out' }, 0.1)
      .fromTo(slide.querySelector('.glow'), { opacity: 0, scale: 0.6 }, { opacity: 1, scale: 1, duration: 1.2 }, 0.2);
    return tl;
  }

  function go(next) {
    if (busy || next === cur) return;
    busy = true;
    var from = slides[cur], to = slides[next];
    var out = gsap.timeline({ onComplete: function () {
      from.classList.remove('is-active');
      to.classList.add('is-active');
      cur = next; busy = false;
      curNum.textContent = String(cur + 1).padStart(2, '0');
      bars.forEach(function (b, i) {
        b.classList.remove('is-active'); void b.offsetWidth;
        if (i === cur) b.classList.add('is-active');
      });
      intro(to); restart();
    }});
    out.to(from.querySelectorAll('.line > span'), { yPercent: -110, duration: 0.5, stagger: 0.06, ease: 'power3.in' })
       .to(from.querySelectorAll('.fade, .eyebrow'), { opacity: 0, duration: 0.3 }, 0)
       .to(from.querySelector('.visual-card'), { clipPath: 'inset(100% 0 0 0)', duration: 0.6, ease: 'power3.in' }, 0);
  }
  function restart() { clearTimeout(timer); timer = setTimeout(function () { go((cur + 1) % slides.length); }, DURATION); }

  bars.forEach(function (b) { b.addEventListener('click', function () { go(+b.dataset.go); }); });
  var tx = 0;
  hero.addEventListener('touchstart', function (e) { tx = e.touches[0].clientX; }, { passive: true });
  hero.addEventListener('touchend', function (e) {
    var d = e.changedTouches[0].clientX - tx;
    if (Math.abs(d) > 50) go(d < 0 ? (cur + 1) % slides.length : (cur - 1 + slides.length) % slides.length);
  });

  // mouse parallax on hero visual
  hero.addEventListener('mousemove', function (e) {
    var x = (e.clientX / innerWidth - 0.5) * 24, y = (e.clientY / innerHeight - 0.5) * 24;
    gsap.to('.slide.is-active .slide-visual', { x: x, y: y, duration: 0.8, ease: 'power2.out' });
  });

  // page loader -> start
  window.addEventListener('load', function () {
    gsap.timeline()
      .to('#loader span', { opacity: 0, y: -20, duration: 0.5, delay: 0.5 })
      .to('#loader', { yPercent: -100, duration: 0.8, ease: 'power4.inOut', onComplete: function () { document.getElementById('loader').remove(); } })
      .add(function () { if (slides.length) { intro(slides[0]); restart(); } }, '-=0.4');
  });

  // nav solid on scroll
  var nav = document.getElementById('nav');
  addEventListener('scroll', function () { nav.classList.toggle('solid', scrollY > 40); }, { passive: true });

  // scroll reveals
  if (!reduce) {
    gsap.utils.toArray('.reveal').forEach(function (el) {
      gsap.from(el, { opacity: 0, y: 60, duration: 0.9, ease: 'power3.out', scrollTrigger: { trigger: el, start: 'top 88%' } });
    });
    gsap.utils.toArray('.card-img img').forEach(function (img) {
      gsap.fromTo(img, { yPercent: -6 }, { yPercent: 6, ease: 'none', scrollTrigger: { trigger: img, scrub: true } });
    });
  }

  // card 3D tilt
  document.querySelectorAll('.tilt').forEach(function (c) {
    c.addEventListener('mousemove', function (e) {
      var r = c.getBoundingClientRect();
      var x = (e.clientX - r.left) / r.width - 0.5, y = (e.clientY - r.top) / r.height - 0.5;
      gsap.to(c, { rotateY: x * 8, rotateX: -y * 8, transformPerspective: 800, duration: 0.4 });
    });
    c.addEventListener('mouseleave', function () { gsap.to(c, { rotateX: 0, rotateY: 0, duration: 0.5 }); });
  });

  // FAQ accordion
  document.querySelectorAll('.faq-item').forEach(function (item) {
    var a = item.querySelector('.faq-a');
    item.querySelector('.faq-q').addEventListener('click', function () {
      var open = item.classList.contains('open');
      document.querySelectorAll('.faq-item.open').forEach(function (o) {
        o.classList.remove('open'); gsap.to(o.querySelector('.faq-a'), { height: 0, duration: 0.4 });
      });
      if (!open) { item.classList.add('open'); gsap.to(a, { height: 'auto', duration: 0.4 }); }
    });
  });

  // product buttons preselect form
  var sel = document.getElementById('productSelect');
  document.querySelectorAll('[data-product]').forEach(function (el) {
    el.addEventListener('click', function () { if (sel) sel.value = el.dataset.product; });
  });

  // custom cursor
  var cursor = document.getElementById('cursor');
  addEventListener('mousemove', function (e) { gsap.to(cursor, { x: e.clientX, y: e.clientY, duration: 0.2 }); });
  document.querySelectorAll('a,button,.card').forEach(function (el) {
    el.addEventListener('mouseenter', function () { cursor.classList.add('big'); });
    el.addEventListener('mouseleave', function () { cursor.classList.remove('big'); });
  });
})();