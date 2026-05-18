/**
 * Stitch — Live Website Scroll Animations Engine
 * Scroll reveals, parallax, counters, progress bar, text reveals, and micro-interactions.
 */

(function () {
    'use strict';

    // ─── Scroll Progress Bar ─────────────────────────────────
    var progressBar = document.createElement('div');
    progressBar.className = 'scroll-progress';
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', function () {
        var scrollTop = window.scrollY;
        var docHeight = document.documentElement.scrollHeight - window.innerHeight;
        var scrollPercent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        progressBar.style.width = scrollPercent + '%';
    });

    // ─── Theme Toggle Logic ──────────────────────────────────
    var themeToggle = document.getElementById('themeToggle');
    var savedTheme = localStorage.getItem('theme');
    var systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (savedTheme === 'dark' || (!savedTheme && systemDark)) {
        document.body.setAttribute('data-theme', 'dark');
    }

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            var currentTheme = document.body.getAttribute('data-theme');
            if (currentTheme === 'dark') {
                document.body.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
            } else {
                document.body.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    }

    // ─── Universal Scroll Reveal (all animation classes) ─────
    var revealSelectors = '.fade-up, .fade-down, .slide-left, .slide-right, .scale-up, .blur-in, .rotate-in, .img-reveal, .text-reveal';
    var revealEls = document.querySelectorAll(revealSelectors);

    if (revealEls.length) {
        var revealObserver = new IntersectionObserver(function (entries) {
            var queue = [];
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    queue.push(entry.target);
                    revealObserver.unobserve(entry.target);
                }
            });
            // Stagger each visible element by 80ms for smooth cascade
            queue.forEach(function (el, i) {
                setTimeout(function () {
                    el.classList.add('visible');
                }, i * 80);
            });
        }, { threshold: 0.06, rootMargin: '0px 0px -40px 0px' });

        revealEls.forEach(function (el) { revealObserver.observe(el); });
    }

    // ─── Gold Line Draw Animation ────────────────────────────
    var goldLines = document.querySelectorAll('.gold-line');
    if (goldLines.length) {
        var lineObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    lineObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        goldLines.forEach(function (el) { lineObserver.observe(el); });
    }

    // ─── Service Card Stagger on Section Enter ───────────────
    var cardGrids = document.querySelectorAll('.services-grid');
    cardGrids.forEach(function (grid) {
        var cards = grid.querySelectorAll('.service-card');
        var gridObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    cards.forEach(function (card, i) {
                        setTimeout(function () {
                            card.classList.add('visible');
                        }, i * 120);
                    });
                    gridObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });
        gridObserver.observe(grid);
    });

    // ─── Text Word-by-Word Reveal ────────────────────────────
    var textReveals = document.querySelectorAll('.text-reveal');
    textReveals.forEach(function (el) {
        var words = el.textContent.trim().split(/\s+/);
        el.innerHTML = '';
        words.forEach(function (word, i) {
            var span = document.createElement('span');
            span.className = 'word';
            span.textContent = word;
            span.style.transitionDelay = (i * 0.06) + 's';
            el.appendChild(span);
            // Add space between words
            if (i < words.length - 1) {
                el.appendChild(document.createTextNode(' '));
            }
        });
    });

    // ─── Animated Counters ───────────────────────────────────
    var counters = document.querySelectorAll('.stat-number[data-count]');
    if (counters.length) {
        var counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting && !entry.target.dataset.animated) {
                    entry.target.dataset.animated = 'true';
                    entry.target.classList.add('counting');
                    animateCounter(entry.target);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(function (el) { counterObserver.observe(el); });
    }

    function animateCounter(el) {
        var target = parseInt(el.dataset.count);
        var suffix = el.textContent.replace(/[0-9.,]/g, '').trim();
        var duration = 2000;
        var startTime = null;

        function easeOut(t) { return 1 - Math.pow(1 - t, 4); }

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            var current = Math.floor(easeOut(progress) * target);

            if (target >= 1000) {
                el.textContent = Math.floor(current / 1000) + 'K' + suffix;
            } else {
                el.textContent = current + suffix;
            }

            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                el.classList.remove('counting');
            }
        }
        requestAnimationFrame(step);
    }

    // ─── Parallax Scroll Effect ──────────────────────────────
    var parallaxElements = document.querySelectorAll('[data-parallax]');
    if (parallaxElements.length) {
        window.addEventListener('scroll', function () {
            var scrollY = window.scrollY;
            parallaxElements.forEach(function (el) {
                var speed = parseFloat(el.dataset.parallax) || 0.3;
                var rect = el.getBoundingClientRect();
                var inView = rect.top < window.innerHeight && rect.bottom > 0;
                if (inView) {
                    var offset = (scrollY - el.offsetTop) * speed;
                    el.style.transform = 'translateY(' + offset + 'px)';
                }
            });
        });
    }

    // ─── Section Opacity Fade on Scroll ──────────────────────
    var sections = document.querySelectorAll('section, .content, .footer');
    if (sections.length) {
        var sectionObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.05, rootMargin: '0px 0px -20px 0px' });

        sections.forEach(function (section) {
            // Only animate sections that don't already have animation classes
            if (!section.classList.contains('hero-section') &&
                !section.classList.contains('fade-up') &&
                !section.classList.contains('slide-left') &&
                !section.classList.contains('slide-right')) {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                sectionObserver.observe(section);
            }
        });
    }

    // ─── Back to Top ─────────────────────────────────────────
    var backBtn = document.getElementById('backToTop');
    if (backBtn) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 400) {
                backBtn.classList.add('visible');
            } else {
                backBtn.classList.remove('visible');
            }
        });
        backBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ─── Navbar Background on Scroll ─────────────────────────
    var header = document.querySelector('.header');
    if (header) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }

    // ─── Active Nav Link ─────────────────────────────────────
    var currentPage = window.location.pathname.split('/').pop() || 'index.php';
    document.querySelectorAll('.nav-menu li').forEach(function (li) {
        li.classList.remove('active');
        var link = li.querySelector('a');
        if (link && link.getAttribute('href') === currentPage) {
            li.classList.add('active');
        }
    });

    // ─── Form Focus Animations ──────────────────────────────
    document.querySelectorAll('.form-control').forEach(function (input) {
        input.addEventListener('focus', function () {
            this.closest('.col-md-6, .col-md-12, .form-group')?.classList.add('field-focused');
        });
        input.addEventListener('blur', function () {
            this.closest('.col-md-6, .col-md-12, .form-group')?.classList.remove('field-focused');
        });
    });

    // ─── Hero Parallax (subtle) ──────────────────────────────
    var heroImg = document.querySelector('.hero-section .hero-bg-image');
    if (heroImg) {
        window.addEventListener('scroll', function () {
            var scrolled = window.scrollY;
            if (scrolled < window.innerHeight) {
                heroImg.style.transform = 'scale(1.05) translateY(' + (scrolled * 0.15) + 'px)';
            }
        });
    }

    // ─── Glass Card Tilt (subtle, desktop only) ──────────────
    if (window.innerWidth > 768) {
        document.querySelectorAll('.glass-card, .service-card').forEach(function (card) {
            card.addEventListener('mousemove', function (e) {
                var rect = card.getBoundingClientRect();
                var x = (e.clientX - rect.left) / rect.width - 0.5;
                var y = (e.clientY - rect.top) / rect.height - 0.5;
                card.style.transform = 'translateY(-3px) perspective(600px) rotateX(' + (y * -4) + 'deg) rotateY(' + (x * 4) + 'deg)';
            });
            card.addEventListener('mouseleave', function () {
                card.style.transform = '';
            });
        });
    }

    // ─── Smooth Anchor Scroll ────────────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ─── Smooth Page Load ────────────────────────────────────
    document.body.classList.add('loaded');

    // ─── Mobile Navigation Toggle ────────────────────────────
    var navToggle = document.getElementById('navToggle');
    var navMenu = document.getElementById('navMenu');

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            navMenu.classList.toggle('open');
            this.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function (e) {
            if (!navMenu.contains(e.target) && !navToggle.contains(e.target) && navMenu.classList.contains('open')) {
                navMenu.classList.remove('open');
                navToggle.classList.remove('active');
            }
        });

        // Close menu when clicking a link
        navMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                navMenu.classList.remove('open');
                navToggle.classList.remove('active');
            });
        });
    }

})();
