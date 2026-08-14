/* Impression Beauty – custom scripts */

/* ── Nav pill: invisible at top, pill appears on scroll ── */
(function () {
    const nav = document.querySelector('.navbar');
    if (!nav) return;

    const THRESHOLD = 80;

    function updateNav() {
        if (window.scrollY > THRESHOLD) {
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
