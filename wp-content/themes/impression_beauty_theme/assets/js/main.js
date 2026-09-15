/* Impression Beauty – custom scripts */

/* ── Nav pill: invisible at top, pill appears on scroll ── */
(function () {
    const nav = document.querySelector('.navbar');
    if (!nav) return;

    const THRESHOLD = 80;
    const forceScrolled = document.body.classList.contains('force-nav-scrolled');

    function updateNav() {
        if (forceScrolled || window.scrollY > THRESHOLD) {
            nav.classList.add('nav-scrolled');
        } else {
            nav.classList.remove('nav-scrolled');
        }
    }

    window.addEventListener('scroll', updateNav, { passive: true });
    updateNav();
}());

(function () {
    const slides = document.querySelectorAll('.hero-slide');
    const dots   = document.querySelectorAll('.hero-dot');

    if (!slides.length) return;

    let current = 0;
    let timer;

    function goTo(index) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = index;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
    }

    function next() {
        goTo((current + 1) % slides.length);
    }

    function startAuto() {
        timer = setInterval(next, 4000);
    }

    dots.forEach(function (dot) {
        dot.addEventListener('click', function () {
            clearInterval(timer);
            goTo(parseInt(this.dataset.index, 10));
            startAuto();
        });
    });

    startAuto();
}());

/* ── Hero h1: shrink font-size based on character length ── */
(function () {
    const h1 = document.querySelector('.hero h1');
    if (!h1) return;

    const len = h1.textContent.trim().length;

    if (len > 80) {
        // Very long title
        h1.style.fontSize = 'clamp(1.8rem, 1.4vw + 0.8rem, 2.8rem)';
    } else if (len > 60) {
        // Long title
        h1.style.fontSize = 'clamp(2.2rem, 1.6vw + 1rem, 3.2rem)';
    } else if (len > 40) {
        // Medium-long title
        h1.style.fontSize = 'clamp(2.6rem, 1.8vw + 1rem, 3.8rem)';
    }
    // ≤ 40 chars → keep the default CSS clamp (3.2rem … 4.5rem)
}());
