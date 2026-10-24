document.addEventListener("DOMContentLoaded", function () {
    const words = ["easy", "fast", "portable", "global", "safe", "profitable"];
    const phrases = {
        "easy": "Designed with convenience from the ground up",
        "fast": "With over 400,000+ pre-installed products, setup has never been faster",
        "portable": "No light? No problem, sell with your phone or a tab",
        "global": "Sell and monitor your store from anywhere in the world",
        "safe": "Catch expired products before they leave the shelf",
        "profitable": "See daily, weekly, monthly and yearly growth reports"
    };

    const span = document.querySelector(".changing-text span");
    const subTextP = document.querySelector(".welcome-text .sub-text p");

    // Only run typewriter if hero text elements exist (homepage only)
    if (span && subTextP) {
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let typeSpeed = 50;
        const changeInterval = 6000;

        let currentWord = words[wordIndex];

        function type() {
            if (isDeleting) {
                span.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;
                typeSpeed = 50;
            } else {
                span.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;
                typeSpeed = 50;
            }

            if (!isDeleting && charIndex === currentWord.length) {
                isDeleting = true;
                typeSpeed = changeInterval;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex = (wordIndex + 1) % words.length;
                currentWord = words[wordIndex];
                updatePhrase();
                typeSpeed = 50;
            }

            setTimeout(type, typeSpeed);
        }

        function updatePhrase() {
            const phrase = phrases[currentWord];

            gsap.timeline()
                .to(subTextP, {
                    y: -20,
                    opacity: 0,
                    duration: 0.3,
                    ease: "power2.in",
                    onComplete: () => {
                        subTextP.textContent = phrase;
                    }
                })
                .fromTo(subTextP, 
                    { y: 20, opacity: 0 },
                    { y: 0, opacity: 1, duration: 0.4, ease: "power2.out" }
                );
        }

        type();
    }

    // Go-to-store button hover animation
    const goToStore = document.querySelector(".go-to-store");
    const goToStoreText = document.querySelector(".go-to-store .text");
    const arrowImg = document.querySelector(".go-to-store .arrow img");

    // Only run hover animation when go-to-store button exists
    if (goToStore && goToStoreText && arrowImg) {
        // Start with text invisible
        gsap.set(goToStoreText, { opacity: 0 });

        // Go-to-store button hover animation timeline (perfectly synchronized)
        const hoverTl = gsap.timeline({ paused: true });

        hoverTl.to(goToStore, {
            width: 170,
            duration: 0.8,
            ease: "power2.out"
        }, 0);

        hoverTl.to(arrowImg, {
            rotation: 360,
            duration: 0.8,
            ease: "power2.out"
        }, 0);

        hoverTl.to(goToStoreText, {
            opacity: 1,
            duration: 0.2,
            ease: "power2.out"
        }, 0.4);

        goToStore.addEventListener("mouseenter", () => {
            hoverTl.play();
        });

        goToStore.addEventListener("mouseleave", () => {
            hoverTl.reverse();
        });
    }

    // Nav header scroll behavior (only menu button sticks on scroll down, full nav reveals on scroll up)
    let lastScrollY = window.scrollY;
    const topNav = document.querySelector(".top-nav");
    if (topNav) {
        const handleNavScroll = () => {
            const currentScrollY = window.scrollY;
            if (currentScrollY > 50) {
                if (currentScrollY > lastScrollY) {
                    // Scrolling DOWN
                    topNav.classList.add("nav-scrolled-down");
                } else {
                    // Scrolling UP
                    topNav.classList.remove("nav-scrolled-down");
                }
            } else {
                // At the top
                topNav.classList.remove("nav-scrolled-down");
            }
            lastScrollY = currentScrollY;
        };
        window.addEventListener("scroll", handleNavScroll, { passive: true });
        handleNavScroll();
    }

    // ── Menu button dropdown toggle ───────────────────────────────────────────
    const menuBtn = document.getElementById("menu-btn");
    const navDropdown = document.getElementById("nav-dropdown");

    if (menuBtn && navDropdown) {
        // Toggle open on click
        menuBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            const isOpen = navDropdown.classList.toggle("open");
            menuBtn.classList.toggle("open", isOpen);
            menuBtn.setAttribute("aria-expanded", isOpen);
            navDropdown.setAttribute("aria-hidden", !isOpen);
        });

        // Close when clicking outside
        document.addEventListener("click", (e) => {
            if (!navDropdown.contains(e.target) && !menuBtn.contains(e.target)) {
                navDropdown.classList.remove("open");
                menuBtn.classList.remove("open");
                menuBtn.setAttribute("aria-expanded", false);
                navDropdown.setAttribute("aria-hidden", true);
            }
        });

        // ── Custom "Menu" cursor pill ─────────────────────────────────────────
        const menuCursor = document.getElementById("menu-cursor");
        if (menuCursor) {
            const isTouchOrMobile = () => window.innerWidth <= 768 || window.matchMedia("(hover: none)").matches || window.matchMedia("(pointer: coarse)").matches;

            // Move pill to follow the mouse precisely (fixed positioning = clientX/Y)
            menuBtn.addEventListener("mousemove", (e) => {
                if (isTouchOrMobile()) return;
                menuCursor.style.left = e.clientX + "px";
                menuCursor.style.top  = e.clientY + "px";
            });

            // Show on enter, hide on leave
            menuBtn.addEventListener("mouseenter", () => {
                if (isTouchOrMobile()) return;
                menuCursor.classList.add("visible");
            });

            menuBtn.addEventListener("mouseleave", () => {
                menuCursor.classList.remove("visible");
            });
        }
    }

    // Top nav info marquee scroll (infinite seamless loop with wheel interaction)
    const navSubText = document.querySelector(".top-nav-info .sub-text");
    if (navSubText) {
        const originalP = navSubText.querySelector("p");
        if (originalP) {
            const textContent = originalP.textContent;

            navSubText.innerHTML = "";
            const container = document.createElement("div");
            container.className = "marquee-inner";
            container.style.display = "inline-block";
            container.style.whiteSpace = "nowrap";

            // Create two sets of text and dividers to cover the screen for seamless looping
            for (let i = 0; i < 2; i++) {
                const textSpan = document.createElement("span");
                textSpan.className = "marquee-text";
                textSpan.textContent = textContent;

                const dividerSpan = document.createElement("span");
                dividerSpan.className = "marquee-divider";
                dividerSpan.textContent = "|";

                container.appendChild(textSpan);
                container.appendChild(dividerSpan);
            }
            navSubText.appendChild(container);

            const firstText = container.children[0];
            const firstDivider = container.children[1];

            let pos = 0;
            let W = (firstText.offsetWidth + firstDivider.offsetWidth) || 800;
            let isWheeling = false;
            let wheelTimeout;

            const getMarqueeWidth = () => firstText.offsetWidth + firstDivider.offsetWidth;

            if (document.fonts) {
                document.fonts.ready.then(() => {
                    W = getMarqueeWidth();
                });
            }

            window.addEventListener("resize", () => {
                W = getMarqueeWidth();
            });

            let marqueeRafId = null;
            let isMarqueeVisible = true;

            function updateMarquee() {
                if (!isWheeling && isMarqueeVisible) {
                    pos += 0.5; // scroll speed (slowed down)
                    if (pos >= W) {
                        pos -= W;
                    }
                    gsap.set(container, { x: -pos });
                }
                if (isMarqueeVisible) {
                    marqueeRafId = requestAnimationFrame(updateMarquee);
                }
            }

            const navInfoBox = document.querySelector(".top-nav-info");
            if (navInfoBox) {
                navInfoBox.addEventListener("wheel", (e) => {
                    const delta = e.deltaX || e.deltaY;
                    if (delta !== 0) {
                        e.preventDefault();
                        isWheeling = true;
                        clearTimeout(wheelTimeout);

                        pos += delta * 0.4;

                        if (pos < 0) {
                            pos += W;
                        } else if (pos >= W) {
                            pos -= W;
                        }

                        gsap.set(container, { x: -pos });

                        wheelTimeout = setTimeout(() => {
                            isWheeling = false;
                        }, 800);
                    }
                }, { passive: false });
            }

            if ('IntersectionObserver' in window) {
                const navObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            if (!isMarqueeVisible) {
                                isMarqueeVisible = true;
                                cancelAnimationFrame(marqueeRafId);
                                marqueeRafId = requestAnimationFrame(updateMarquee);
                            }
                        } else {
                            isMarqueeVisible = false;
                            cancelAnimationFrame(marqueeRafId);
                        }
                    });
                }, { threshold: 0.05 });
                navObserver.observe(navSubText);
            }

            updateMarquee();
        }
    }

    gsap.registerPlugin(ScrollTrigger);

    const phone = document.querySelector(".phone");
    const phoneDevice = phone && phone.querySelector(".phone-device");

    // Only run hero/phone scroll animations when the phone element exists (homepage only)
    if (phoneDevice) {
        // How phone.png is drawn in img/section3/phone-store-top-side.png: an isometric view
        // at 1.0907x the png's size, with the screen centred at (837.9, 481.7) in the 1675px-wide
        // artwork. The flying phone finishes in exactly this pose so it can stand in for it.
        const ROOF_ART = { width: 1675, scale: 1.0907, center: [837.9, 481.7] };
        const PHONE_PNG_WIDTH = 772;
        // Chassis depth relative to the phone's width, measured from the same artwork
        const PHONE_DEPTH_RATIO = 0.0605;
        const PHONE_LAYERS = 20;
        // rotateX + rotateZ that give a true isometric view
        const ISO_TILT = 54.7356;
        const ISO_SPIN = -45;

        // Give the flat phone.png a solid chassis: stack thin rounded slices behind
        // the screen along Z so the device reads as 3D at any tilt. The slices darken
        // towards the back to fake light falling on the edges.
        const phoneBody = document.createElement("div");
        phoneBody.className = "phone-body";
        phoneBody.setAttribute("aria-hidden", "true");

        const shade = gsap.utils.interpolate("#4a4a4a", "#232323");
        const bodyLayers = [];
        for (let i = 1; i <= PHONE_LAYERS; i++) {
            const layer = document.createElement("div");
            layer.className = "phone-body-layer";
            layer.style.backgroundColor = shade(i / PHONE_LAYERS);
            bodyLayers.push(layer);
        }

        // iPhone details on the chassis: mic holes, charging port and speaker holes along
        // the bottom, and the volume buttons on the left side
        const phoneBottom = document.createElement("div");
        phoneBottom.className = "phone-bottom";
        phoneBottom.innerHTML = '<span class="phone-grille"></span><span class="phone-port"></span><span class="phone-grille"></span>';
        const phoneSide = document.createElement("div");
        phoneSide.className = "phone-side";
        phoneSide.innerHTML = '<span class="phone-volume"></span><span class="phone-volume"></span>';

        phoneBody.append(...bodyLayers, phoneBottom, phoneSide);
        phoneDevice.prepend(phoneBody);

        function setPhoneDepth(width) {
            const depth = width * PHONE_DEPTH_RATIO;
            gsap.set(bodyLayers, { z: (i) => -depth * (i + 1) / PHONE_LAYERS });
            // Sizes the bottom edge and side in main.css
            phoneBody.style.setProperty("--phone-depth", `${depth}px`);
        }
        setPhoneDepth(phoneDevice.offsetWidth);

        const mm = gsap.matchMedia();

        // Desktop: the phone flies from the hero onto the Pharmacies store and docks as its roof.
        // gsap.matchMedia reverts all of this if the window is resized down to mobile.
        mm.add("(min-width: 821px)", () => {
            const hero = document.querySelector(".hero-section");
            const phoneSlot = phone.querySelector(".phone-slot");
            const storeWrap = document.querySelector(".section3-4-wrap");
            const store = document.querySelector(".section-3");
            const imgCont = store && store.querySelector(".img-cont");
            const roofArt = imgCont && imgCont.querySelector(".store-top");
            if (!hero || !phoneSlot || !storeWrap || !roofArt) return;

            const lerp = gsap.utils.interpolate;
            // Perspective drops away quickly, as it did when it was tweened from 900px to 7000px
            const flattenEase = gsap.parseEase("power3.out");
            const layout = {};
            let docked = false;

            phone.classList.add("is-flying");
            phoneDevice.classList.add("is-flying");
            // The phone itself becomes the roof, so the flat roof artwork is only shown on mobile.
            // It stays in the layout so we can measure where the roof goes.
            gsap.set(roofArt, { autoAlpha: 0 });

            // Measure once per layout change so scrolling only does maths
            function measure() {
                const heroBox = hero.getBoundingClientRect();
                const slotBox = phoneSlot.getBoundingClientRect();
                const wrapBox = storeWrap.getBoundingClientRect();
                const storeBox = store.getBoundingClientRect();
                const roofBox = roofArt.getBoundingClientRect();
                const { width, height } = slotBox;
                const artToRoof = roofBox.width / ROOF_ART.width;
                const roofScale = ROOF_ART.scale * (PHONE_PNG_WIDTH / width) * artToRoof;

                // The hero pose from main.css at this width (the phone is flat up to 900px)
                const heroStyle = getComputedStyle(phoneDevice);
                const heroValue = (name) => parseFloat(heroStyle.getPropertyValue(name)) || 0;

                // Offset from the phone's pivot (top centre) to its centre in the roof pose
                const centre = new DOMMatrix()
                    .rotateAxisAngle(1, 0, 0, ISO_TILT)
                    .rotateAxisAngle(0, 0, 1, ISO_SPIN)
                    .scale3d(roofScale)
                    .transformPoint(new DOMPoint(0, height / 2));

                Object.assign(layout, {
                    width,
                    height,
                    roofScale,
                    heroTilt: heroValue("--hero-tilt"),
                    heroPerspective: heroValue("--hero-perspective"),
                    // The phone holds still while the hero scrolls away, so it starts where the
                    // slot sits when the hero is at the top of the viewport
                    heroPivot: [slotBox.left + width / 2, slotBox.top - heroBox.top],
                    // Distance from the phone's top edge up to where the hero perspective is seen from
                    vanish: heroValue("--hero-eye"),
                    // Where the pivot lands in the viewport once the store has pinned to the top
                    roofPivot: [
                        roofBox.left + ROOF_ART.center[0] * artToRoof - centre.x,
                        roofBox.top - wrapBox.top + ROOF_ART.center[1] * artToRoof - centre.y
                    ],
                    // The pinned store's viewport position, which docked transforms are relative to
                    storeOrigin: [storeBox.left, storeBox.top - wrapBox.top]
                });

                phoneDevice.style.width = `${width}px`;
                phoneDevice.style.height = `${height}px`;
                setPhoneDepth(width);
            }

            function render(progress) {
                if (!layout.width) return;

                // Hand the phone to the store once it has landed, and take it back on the way up.
                // Both sit at the viewport's top left at that moment, so the swap is invisible
                // and the phone then scrolls and gets wiped away with the store.
                if ((progress >= 1) !== docked) {
                    docked = progress >= 1;
                    if (docked) {
                        store.appendChild(phoneDevice);
                    } else {
                        phone.insertBefore(phoneDevice, phoneSlot);
                    }
                    phoneDevice.classList.toggle("is-docked", docked);
                }

                const t = Math.min(progress, 1);
                const { heroPivot, roofPivot, storeOrigin } = layout;
                const pivot = [lerp(heroPivot[0], roofPivot[0], t), lerp(heroPivot[1], roofPivot[1], t)];
                if (docked) {
                    pivot[0] -= storeOrigin[0];
                    pivot[1] -= storeOrigin[1];
                }
                const scale = lerp(1, layout.roofScale, t);
                // Fade the perspective out so the phone lands as a flat isometric drawing
                const perspective = new DOMMatrix();
                perspective.m34 = layout.heroPerspective ? -lerp(1 / layout.heroPerspective, 0, flattenEase(t)) : 0;

                phoneDevice.style.transform = new DOMMatrix()
                    .translate(pivot[0], pivot[1] - layout.vanish)
                    .multiply(perspective)
                    .translate(0, layout.vanish)
                    .rotateAxisAngle(1, 0, 0, lerp(layout.heroTilt, ISO_TILT, t))
                    .rotateAxisAngle(0, 0, 1, lerp(0, ISO_SPIN, t))
                    .scale3d(scale)
                    .translate(-layout.width / 2, 0)
                    .toString();
            }

            // Follows the scroll exactly (no scrub smoothing) so the phone and the store
            // reach the hand-off point on the same frame
            const flight = ScrollTrigger.create({
                trigger: hero,
                start: "top top",
                endTrigger: storeWrap,
                end: "top top",
                refreshPriority: 1,
                onUpdate: (self) => render(self.progress)
            });

            const relayout = () => {
                measure();
                render(flight.progress);
            };
            ScrollTrigger.addEventListener("refresh", relayout);
            window.addEventListener("resize", relayout);
            relayout();

            // Section 3: pin the store and build it piece by piece under the phone roof
            const storeParts = imgCont.querySelectorAll(":scope > img:not(.store-top)");
            gsap.set(storeParts, { opacity: 0 });
            gsap.set([".section-3 .title", ".section-3 .text-cont"], { opacity: 0 });

            const s3Timeline = gsap.timeline({
                scrollTrigger: {
                    trigger: storeWrap,
                    start: "top top", // Pin flush at the top of the viewport to prevent any gaps
                    end: "+=300%",   // pin for 300vh of scroll (100% for store building, 100% for s3 wipe, 100% for s4 wipe)
                    pin: true,
                    pinSpacing: true,
                    scrub: true,
                    // Refresh before the later pins on the page, even when created after them on resize
                    refreshPriority: 1,
                    invalidateOnRefresh: true
                }
            });

            // Title and text-cont fade in from left/right at the very start (time 0)
            s3Timeline.fromTo(".section-3 .title", {
                x: -50,
                opacity: 0
            }, {
                x: 0,
                opacity: 1,
                duration: 0.6,
                ease: "power2.out"
            }, 0);

            s3Timeline.fromTo(".section-3 .text-cont", {
                x: 50,
                opacity: 0
            }, {
                x: 0,
                opacity: 1,
                duration: 0.6,
                ease: "power2.out"
            }, 0);

            // Each part rises 3% of the store's height into place as it fades in. Moving with
            // transforms leaves the CSS % positions in charge, so parts stay put on resize.
            const rise = () => imgCont.offsetHeight * 0.03;
            storeParts.forEach((part) => {
                s3Timeline.fromTo(part, {
                    y: rise,
                    opacity: 0
                }, {
                    y: 0,
                    opacity: 1,
                    duration: 0.4,
                    ease: "power2.out"
                }, "+=0.15");
            });

            // After Section 3 building sequence completes, wipe Section 3 out from bottom-to-top using clip-path to reveal Section 4 underneath
            s3Timeline.to(".section-3", {
                clipPath: "inset(0% 0% 100% 0%)",
                duration: 5.0, // relative duration matching scroll scale
                ease: "none"
            }, "+=0.3");

            // After Section 4 is fully revealed, wipe Section 4 out from bottom-to-top using clip-path to reveal Section 5 underneath
            s3Timeline.to(".section-4", {
                clipPath: "inset(0% 0% 100% 0%)",
                duration: 5.0, // relative duration matching scroll scale
                ease: "none"
            }, "+=0.3");

            return () => {
                ScrollTrigger.removeEventListener("refresh", relayout);
                window.removeEventListener("resize", relayout);
                phone.insertBefore(phoneDevice, phoneSlot);
                phone.classList.remove("is-flying");
                phoneDevice.classList.remove("is-flying", "is-docked");
                ["transform", "width", "height"].forEach((prop) => phoneDevice.style.removeProperty(prop));
            };
        });

        // Mobile: the phone stays in the hero and shrinks as it scrolls away (to scale: 0.3).
        // main.css does this with a scroll-driven animation where the browser supports one.
        mm.add("(max-width: 820px)", () => {
            if (CSS.supports("animation-timeline: scroll()")) return;
            gsap.to(phoneDevice, {
                scale: 0.3,
                ease: "none",
                scrollTrigger: {
                    trigger: ".hero-section",
                    start: "top top",
                    end: "bottom top",
                    // Smoothed, so the phone keeps moving when touch scrolling is reported in uneven steps
                    scrub: 0.5,
                    invalidateOnRefresh: true
                }
            });
        });
    } // end if (phoneDevice)

    // Split text effect for Section 2
    const section2Text = document.querySelector(".section-2 p");
    if (section2Text) {
        const words = section2Text.textContent.trim().split(/\s+/);
        section2Text.innerHTML = words.map(word => {
            if (word.includes("ShopKite")) {
                const baseWord = word.replace("?", "");
                const hasQuestionMark = word.includes("?");

                // Starts lower than the other words so the pill's border doesn't peek out of
                // the wrapper before the word is revealed
                let result = `<span style="display: inline-block; overflow: hidden; padding-bottom: 0.15em; margin-bottom: -0.15em; vertical-align: bottom;">` +
                    `<span class="word highlight" style="display: inline-block; transform: translate3d(0, 125%, 0);">${baseWord}</span>` +
                    `</span>`;

                if (hasQuestionMark) {
                    result += `<span style="display: inline-block; overflow: hidden; padding-bottom: 0.15em; margin-bottom: -0.15em; vertical-align: bottom;">` +
                        `<span class="word" style="display: inline-block; transform: translate3d(0, 110%, 0);">?</span>` +
                        `</span>`;
                }
                return result;
            }
            return `<span style="display: inline-block; overflow: hidden; padding-bottom: 0.15em; margin-bottom: -0.15em; vertical-align: bottom;">` +
                `<span class="word" style="display: inline-block; transform: translate3d(0, 110%, 0);">${word}</span>` +
                `</span>`;
        }).join(" ");

        const wordsEls = section2Text.querySelectorAll(".word");
        gsap.to(wordsEls, {
            y: 0,
            stagger: 0.4,
            ease: "power2-in",
            scrollTrigger: {
                trigger: ".section-2",
                start: "top 30%", // 70% of section 2 in view
                end: "top top",   // section 2 in full view
                scrub: 0.5
            }
        });
    }

    // Split text effect for Section 6
    const section6Text = document.querySelector(".section-6 p");
    if (section6Text) {
        const words = section6Text.textContent.trim().split(/\s+/);
        section6Text.innerHTML = words.map(word => {
            return `<span style="display: inline-block; overflow: hidden; padding-bottom: 0.15em; margin-bottom: -0.15em; vertical-align: bottom;">` +
                `<span class="word" style="display: inline-block; transform: translate3d(0, 110%, 0);">${word}</span>` +
                `</span>`;
        }).join(" ");

        const wordsEls = section6Text.querySelectorAll(".word");
        gsap.to(wordsEls, {
            y: 0,
            stagger: 0.4,
            ease: "power2.out",
            scrollTrigger: {
                trigger: ".section-6",
                start: "top 70%", // starts when section 6 is 30% in view
                end: "top 30%",   // ends when section 6 is 70% in view
                scrub: 0.5
            }
        });
    }

    // Split text effect for Testimonials Section (testimonials-title)
    const testimonialsText = document.querySelector(".testimonials-title p");
    if (testimonialsText && document.querySelector(".merchant-testimony-section")) {
        const words = testimonialsText.textContent.trim().split(/\s+/);
        testimonialsText.innerHTML = words.map(word => {
            // Apply brand-highlight highlight to "ShopKite"
            let wordHtml = word;
            if (word.includes("ShopKite")) {
                wordHtml = word.replace("ShopKite", `<span class="brand-highlight">ShopKite</span>`);
            }
            return `<span style="display: inline-block; overflow: hidden; padding-bottom: 0.15em; margin-bottom: -0.15em; vertical-align: bottom;">` +
                `<span class="word" style="display: inline-block;">${wordHtml}</span>` +
                `</span>`;
        }).join(" ");

        // Immediately hide words — ScrollTrigger registration is deferred to window.load
        gsap.set(testimonialsText.querySelectorAll(".word"), { y: "110%" });
    }

    // Split text effect for Bento Section (bento-title)
    const bentoText = document.querySelector(".bento-title h3");
    if (bentoText && document.querySelector(".bento-container")) {
        const words = bentoText.textContent.trim().split(/\s+/);
        bentoText.innerHTML = words.map(word => {
            let wordHtml = word;
            if (word.includes("ShopKite")) {
                wordHtml = word.replace("ShopKite", `<span class="brand-highlight">ShopKite</span>`);
            }
            return `<span style="display: inline-block; overflow: hidden; padding-bottom: 0.15em; margin-bottom: -0.15em; vertical-align: bottom;">` +
                `<span class="word" style="display: inline-block;">${wordHtml}</span>` +
                `</span>`;
        }).join(" ");

        gsap.set(bentoText.querySelectorAll(".word"), { y: "110%" });
    }

    // Split text effect for Trial Section (trial-title)
    const trialText = document.querySelector(".trial-title > p");
    if (trialText && document.querySelector(".trial-buttons-container")) {
        const words = trialText.textContent.trim().split(/\s+/);
        trialText.innerHTML = words.map(word => {
            let wordHtml = word;
            if (/free/i.test(word)) {
                wordHtml = word.replace(/(free)/i, `<span class="brand-highlight">$1</span>`);
            } else if (/7-day/i.test(word)) {
                wordHtml = word.replace(/(7-day)/i, `<span class="brand-highlight">$1</span>`);
            }
            return `<span style="display: inline-block; overflow: hidden; padding-bottom: 0.15em; margin-bottom: -0.15em; vertical-align: bottom;">` +
                `<span class="word" style="display: inline-block;">${wordHtml}</span>` +
                `</span>`;
        }).join(" ");

        gsap.set(trialText.querySelectorAll(".word"), { y: "110%" });
    }

    // Bubbles parallax effect for Section 2
    const bubblesContainer = document.querySelector(".section-2 .bubbles");
    if (bubblesContainer) {
        const twentyPercentBubbles = [".bubbles .guy", ".bubbles .store", ".bubbles .woman", ".bubbles .man"];
        const tenPercentBubbles = [".bubbles .lady-bubble"];

        const getTwentyPercent = () => window.innerHeight * 0.20;
        const getTenPercent = () => window.innerHeight * 0.10;

        const bubblesTimeline = gsap.timeline({
            scrollTrigger: {
                trigger: ".section-2",
                start: "top 50%", // triggers when section 2 is 50% in view
                end: "bottom top", // ends when section 2 is completely out of view
                scrub: 0.3,
                invalidateOnRefresh: true
            }
        });

        // 20% bubbles (guy, store, woman, man)
        bubblesTimeline.fromTo(twentyPercentBubbles, {
            y: getTwentyPercent
        }, {
            y: 0,
            duration: 0.5,
            ease: "none"
        }, 0);

        bubblesTimeline.to(twentyPercentBubbles, {
            y: () => -getTwentyPercent(),
            duration: 1.0,
            ease: "none"
        }, 0.5);

        // 10% bubbles (lady-bubble)
        bubblesTimeline.fromTo(tenPercentBubbles, {
            y: getTenPercent
        }, {
            y: 0,
            duration: 0.5,
            ease: "none"
        }, 0);

        bubblesTimeline.to(tenPercentBubbles, {
            y: () => -getTenPercent(),
            duration: 1.0,
            ease: "none"
        }, 0.5);
    }

    // Fade out hero buttons when Section 1 is 5% out of view, and fade them in only when Section 1 is 100% in view (scrolled flush to top)
    const heroButtons = document.querySelector(".hero-buttons-container");
    if (heroButtons) {
        let isHeroHidden = false;
        const handleScroll = () => {
            const threshold = window.innerHeight * 0.05; // 5% of viewport height
            if (window.scrollY >= threshold) {
                if (!isHeroHidden) {
                    isHeroHidden = true;
                    gsap.to(heroButtons, { opacity: 0, pointerEvents: "none", duration: 0.25, overwrite: "auto" });
                }
            } else if (window.scrollY <= 2) {
                if (isHeroHidden) {
                    isHeroHidden = false;
                    gsap.to(heroButtons, { opacity: 1, pointerEvents: "auto", duration: 0.25, overwrite: "auto" });
                }
            }
        };
        window.addEventListener("scroll", handleScroll, { passive: true });
        handleScroll(); // execute once on load to establish correct state
    }

    // Pin Section 6 until Section 7 reaches the top of the viewport
    const section6 = document.querySelector(".section-6");
    if (section6) {
        ScrollTrigger.create({
            trigger: ".section-6",
            start: "top top",
            endTrigger: ".section-7",
            end: "top top",
            pin: true,
            pinSpacing: false, // no spacer inserted — Section 7 scrolls up naturally
            invalidateOnRefresh: true
        });
    }

    // Mask reveal scroll animation for Section 7
    const meshaiMasked = document.querySelector(".meshai-masked-photo");
    if (meshaiMasked) {
        const meshaiTimeline = gsap.timeline({
            scrollTrigger: {
                trigger: ".section-7",
                start: "top top",
                end: "+=150%", // pin for 1.5 scroll viewports
                pin: true,
                pinSpacing: true,
                scrub: 0.3,
                invalidateOnRefresh: true
            }
        });

        // Set initial states explicitly via GSAP
        gsap.set(".meshai-masked-photo", {
            webkitMaskSize: "70% auto",
            maskSize: "70% auto",
            opacity: 1
        });
        gsap.set([".meshai-photo.masked", ".meshai-photo.unmasked"], {
            scale: 3
        });
        gsap.set(".meshai-photo.unmasked", {
            opacity: 0
        });

        // Scale the SVG mask up to 2000%
        meshaiTimeline.to(".meshai-masked-photo", {
            webkitMaskSize: "2000% auto",
            maskSize: "2000% auto",
            duration: 1.0,
            ease: "none"
        }, 0);

        // Scale both photos down to 100% synchronously to align pixels
        meshaiTimeline.to([".meshai-photo.masked", ".meshai-photo.unmasked"], {
            scale: 1,
            duration: 1.0,
            ease: "none"
        }, 0);

        // Fade in the unmasked photo layer at the end of scroll to seamlessly dissolve the SVG mask
        meshaiTimeline.to(".meshai-photo.unmasked", {
            opacity: 1,
            duration: 0.4,
            ease: "power1.out"
        }, 0.6); // starts at 60% progress of the scrub timeline
    }

    // Section 8 background infinite marquee with scroll acceleration (three rows in sync)
    const s8Marquee = document.querySelector(".section-8-marquee");
    if (s8Marquee) {
        const rows = s8Marquee.querySelectorAll(".marquee-row");
        const containers = [];
        let W = 2000;
        let pos = 0;

        rows.forEach(row => {
            const originalP = row.querySelector("p");
            if (originalP) {
                const textContent = originalP.textContent;
                row.innerHTML = "";

                const container = document.createElement("div");
                container.className = "marquee-inner-s8";
                container.style.display = "inline-flex";
                container.style.alignItems = "center";
                container.style.whiteSpace = "nowrap";

                // Create two sets to loop seamlessly
                for (let i = 0; i < 2; i++) {
                    const textSpan = document.createElement("span");
                    textSpan.className = "marquee-text";
                    textSpan.textContent = textContent;

                    const dividerSpan = document.createElement("span");
                    dividerSpan.className = "marquee-divider";
                    // no text — rendered as a styled circle via CSS

                    container.appendChild(textSpan);
                    container.appendChild(dividerSpan);
                }
                row.appendChild(container);
                containers.push(container);
            }
        });

        if (containers.length > 0) {
            const firstContainer = containers[0];
            const firstText = firstContainer.children[0];
            const firstDivider = firstContainer.children[1];

            const getMarqueeWidth = () => firstText.offsetWidth + firstDivider.offsetWidth;
            W = getMarqueeWidth() || 2000;

            if (document.fonts) {
                document.fonts.ready.then(() => {
                    W = getMarqueeWidth();
                });
            }

            window.addEventListener("resize", () => {
                W = getMarqueeWidth();
            });

            // Each row has its own base speed for a parallax depth effect
            const baseSpeeds = [1.5, 1.0, 0.6]; // top: fast, middle: medium, bottom: slow
            const rowStates = baseSpeeds.map(base => ({
                base,
                current: base,
                target: base,
                pos: 0
            }));

            let s8RafId = null;
            let isS8Visible = false;

            function updateS8Marquee() {
                if (!isS8Visible) return;
                rowStates.forEach((state, i) => {
                    // Decay target back to base speed
                    state.target += (state.base - state.target) * 0.04;
                    // Interpolate current towards target (inertia)
                    state.current += (state.target - state.current) * 0.1;
                    state.pos += state.current;
                    if (state.pos >= W) state.pos -= W;
                });

                // Apply translations — middle row flows right-to-left (opposite)
                if (containers[0]) gsap.set(containers[0], { x: -rowStates[0].pos });
                if (containers[1]) gsap.set(containers[1], { x: -W + rowStates[1].pos });
                if (containers[2]) gsap.set(containers[2], { x: -rowStates[2].pos });

                s8RafId = requestAnimationFrame(updateS8Marquee);
            }

            const s8SectionEl = document.querySelector(".section-8");
            if (s8SectionEl) {
                // Listen to wheel acceleration on Section 8
                s8SectionEl.addEventListener("wheel", (e) => {
                    const delta = Math.abs(e.deltaX || e.deltaY);
                    if (delta > 0) {
                        rowStates.forEach(state => {
                            const maxSpeed = state.base * 10;
                            state.target = Math.min(maxSpeed, state.target + delta * 0.03);
                        });
                    }
                }, { passive: true });

                if ('IntersectionObserver' in window) {
                    const s8Observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                if (!isS8Visible) {
                                    isS8Visible = true;
                                    cancelAnimationFrame(s8RafId);
                                    s8RafId = requestAnimationFrame(updateS8Marquee);
                                }
                            } else {
                                isS8Visible = false;
                                cancelAnimationFrame(s8RafId);
                            }
                        });
                    }, { threshold: 0.01 });
                    s8Observer.observe(s8SectionEl);
                } else {
                    isS8Visible = true;
                    updateS8Marquee();
                }
            }
        }
    }

    // Section 8 cityscape (.section-img) scale animation on scroll
    const sectionImg = document.querySelector(".section-8 .section-img");
    if (sectionImg) {
        // Set initial scale to 0.2 (which corresponds to 10% viewport width since original CSS is width: 50%)
        gsap.set(sectionImg, { scale: 0.1, transformOrigin: "center center" });

        gsap.to(sectionImg, {
            scale: 1.0, // expands to full size (50% viewport width)
            scrollTrigger: {
                trigger: ".section-8",
                start: "top bottom", // starts when Section 8 enters the viewport
                end: "top 20%",     // completes when Section 8 is 20% from the top of the viewport
                scrub: true,
                invalidateOnRefresh: true
            }
        });
    }

    // Testimonials infinite carousel with scroll acceleration & hover pause
    const testimonySection = document.querySelector(".merchant-testimony-section");
    const testimonyTrack = document.querySelector(".testimony-track");
    if (testimonySection && testimonyTrack) {
        const testimonials = Array.from(testimonyTrack.children);

        // Clone the elements to allow seamless scrolling loop
        testimonials.forEach(item => {
            const clone = item.cloneNode(true);
            testimonyTrack.appendChild(clone);
        });

        let pos = 0;
        const cardWidth = 330;
        const gap = 20;
        const originalCount = testimonials.length;
        const W = (cardWidth + gap) * originalCount;

        const baseSpeed = 1.0;
        let targetSpeed = baseSpeed;
        let currentSpeed = baseSpeed;
        let isHovered = false;
        let scrollResumed = false;

        // Hover listeners on the card section to pause auto-scrolling
        testimonySection.addEventListener("mouseenter", () => {
            isHovered = true;
            scrollResumed = false;
        });
        testimonySection.addEventListener("mouseleave", () => {
            isHovered = false;
            scrollResumed = false;
        });

        // Wheel listener to accelerate the carousel scroll (both on testimony container and header title section)
        const accelHandler = (e) => {
            const rawDelta = e.deltaY || e.deltaX;
            if (rawDelta !== 0) {
                if (rawDelta > 0) {
                    // Forward scroll (down/right): accelerate in normal direction (right-to-left)
                    if (targetSpeed < 0) targetSpeed = baseSpeed;
                    targetSpeed = Math.min(20, targetSpeed + rawDelta * 0.05);
                } else {
                    // Reverse scroll (up/left): accelerate in opposite direction (left-to-right)
                    if (targetSpeed > 0) targetSpeed = -baseSpeed;
                    targetSpeed = Math.max(-20, targetSpeed + rawDelta * 0.05); // rawDelta is negative, so adding moves it further negative
                }
                scrollResumed = true; // bypass hover pause on mousewheel scroll activity
            }
        };

        const tHeaderSection = document.querySelector(".testimonials-title");
        if (tHeaderSection) {
            tHeaderSection.addEventListener("wheel", accelHandler, { passive: true });
        }
        testimonySection.addEventListener("wheel", accelHandler, { passive: true });

        // Drag & Touch Gesture Handlers for Testimonials.
        // Pointer events cover mouse, touch and pen. Touch events are only a fallback for browsers
        // without them: handling both counts every finger movement twice.
        const usePointerEvents = "PointerEvent" in window;
        // A release flings the carousel at the speed the finger moved over this many ms
        const FLING_SAMPLE_MS = 100;
        const MAX_FLING_SPEED = 40;
        let isTestimonyDragging = false;
        let testimonyPointerId = null;
        let testimonyLastX = 0;
        let testimonyDragSamples = [];
        let testimonyDragDistance = 0;
        let testimonyRafId = null;
        let isTestimonyVisible = false;

        // The finger's speed just before release, in px per frame like the carousel speeds.
        // It drops towards zero if the finger paused before lifting.
        const getFlingSpeed = () => {
            const now = performance.now();
            const samples = testimonyDragSamples;
            const last = samples.length - 1;
            if (last < 1 || now - samples[last][0] > FLING_SAMPLE_MS) return 0;
            // Measure from the oldest move in the window, or the one before the last if moves were sparse
            let first = last - 1;
            while (first > 0 && now - samples[first - 1][0] <= FLING_SAMPLE_MS) first--;
            const [startTime, startX] = samples[first];
            // The track moves opposite to pos, so a leftward swipe is a positive speed
            const speed = (startX - samples[last][1]) / Math.max(now - startTime, 1) * (1000 / 60);
            return Math.max(-MAX_FLING_SPEED, Math.min(MAX_FLING_SPEED, speed));
        };

        const onTestimonyPointerMove = (e) => {
            if (e.pointerId === testimonyPointerId) {
                onTestimonyDragMove(e.clientX);
            }
        };

        const onTestimonyPointerEnd = (e) => {
            if (e.pointerId === testimonyPointerId) {
                // pointercancel means the browser took the gesture over (e.g. a vertical page scroll)
                onTestimonyDragEnd(e.type === "pointerup");
            }
        };

        const onTestimonyTouchMove = (e) => {
            if (e.touches.length === 1) {
                onTestimonyDragMove(e.touches[0].clientX);
            }
        };

        const onTestimonyTouchEnd = (e) => {
            onTestimonyDragEnd(e.type === "touchend");
        };

        const onTestimonyDragStart = (clientX) => {
            isTestimonyDragging = true;
            testimonyLastX = clientX;
            testimonyDragSamples = [[performance.now(), clientX]];
            testimonyDragDistance = 0;
            testimonySection.style.cursor = "grabbing";
            if (usePointerEvents) {
                window.addEventListener("pointermove", onTestimonyPointerMove);
                window.addEventListener("pointerup", onTestimonyPointerEnd);
                window.addEventListener("pointercancel", onTestimonyPointerEnd);
            } else {
                window.addEventListener("touchmove", onTestimonyTouchMove, { passive: true });
                window.addEventListener("touchend", onTestimonyTouchEnd);
                window.addEventListener("touchcancel", onTestimonyTouchEnd);
            }
        };

        const onTestimonyDragMove = (clientX) => {
            if (!isTestimonyDragging) return;
            const now = performance.now();
            pos += testimonyLastX - clientX;
            testimonyDragDistance += Math.abs(clientX - testimonyLastX);
            testimonyLastX = clientX;
            testimonyDragSamples.push([now, clientX]);
            while (testimonyDragSamples.length > 2 && now - testimonyDragSamples[0][0] > FLING_SAMPLE_MS) testimonyDragSamples.shift();
            scrollResumed = true;
        };

        const onTestimonyDragEnd = (fling) => {
            if (!isTestimonyDragging) return;
            isTestimonyDragging = false;
            testimonyPointerId = null;
            testimonySection.style.cursor = "grab";
            if (fling) {
                // Carry on at the finger's speed; updateCarousel() eases back to auto-scroll from there
                currentSpeed = targetSpeed = getFlingSpeed();
            }
            // The click listener below only swallows the click that ends this drag
            setTimeout(() => { testimonyDragDistance = 0; });
            window.removeEventListener("pointermove", onTestimonyPointerMove);
            window.removeEventListener("pointerup", onTestimonyPointerEnd);
            window.removeEventListener("pointercancel", onTestimonyPointerEnd);
            window.removeEventListener("touchmove", onTestimonyTouchMove);
            window.removeEventListener("touchend", onTestimonyTouchEnd);
            window.removeEventListener("touchcancel", onTestimonyTouchEnd);
        };

        if (usePointerEvents) {
            testimonySection.addEventListener("pointerdown", (e) => {
                // A second finger doesn't restart the drag
                if (isTestimonyDragging) return;
                testimonyPointerId = e.pointerId;
                onTestimonyDragStart(e.clientX);
            });
        } else {
            testimonySection.addEventListener("touchstart", (e) => {
                if (e.touches.length === 1) {
                    onTestimonyDragStart(e.touches[0].clientX);
                }
            }, { passive: true });
        }

        // The cards are links: stop the browser dragging them (or their images) instead of the carousel
        testimonyTrack.addEventListener("dragstart", (e) => e.preventDefault());

        // Releasing a mouse drag over a card would otherwise open its link
        testimonySection.addEventListener("click", (e) => {
            if (testimonyDragDistance > 6) {
                e.preventDefault();
                e.stopPropagation();
            }
        }, true);

        function updateCarousel() {
            if (!isTestimonyVisible) return;
            if (!isTestimonyDragging) {
                // When mousewheel activity occurs (scrollResumed === true), we auto-resume normal speed on mousewheel pause (stops)
                const limitSpeed = (isHovered && !scrollResumed) ? 0 : baseSpeed;

                // Lerp targetSpeed towards the current limit speed (auto-scroll or paused)
                targetSpeed += (limitSpeed - targetSpeed) * 0.04;

                // Damping logic for currentSpeed towards targetSpeed
                currentSpeed += (targetSpeed - currentSpeed) * 0.1;

                pos += currentSpeed;
            }

            if (pos >= W) {
                pos -= W;
            } else if (pos < 0) {
                pos += W;
            }

            gsap.set(testimonyTrack, { x: -pos });
            testimonyRafId = requestAnimationFrame(updateCarousel);
        }

        if ('IntersectionObserver' in window) {
            const testimonyObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (!isTestimonyVisible) {
                            isTestimonyVisible = true;
                            cancelAnimationFrame(testimonyRafId);
                            testimonyRafId = requestAnimationFrame(updateCarousel);
                        }
                    } else {
                        isTestimonyVisible = false;
                        cancelAnimationFrame(testimonyRafId);
                    }
                });
            }, { threshold: 0.01 });
            testimonyObserver.observe(testimonySection);
        } else {
            isTestimonyVisible = true;
            updateCarousel();
        }
    }

    // Brands infinite scroll carousel with hover pause & scroll acceleration
    const brandsSection = document.querySelector(".brands");
    const brandsTrack = document.querySelector(".brands-track");
    if (brandsSection && brandsTrack) {
        const brandItems = Array.from(brandsTrack.children);

        // Clone the elements to allow seamless scrolling loop
        brandItems.forEach(item => {
            const clone = item.cloneNode(true);
            brandsTrack.appendChild(clone);
        });

        let pos = 0;
        let W = 0;
        const gap = 80; // matches CSS gap

        const calculateWidth = () => {
            W = 0;
            brandItems.forEach(item => {
                W += item.offsetWidth + gap;
            });
        };

        calculateWidth();
        window.addEventListener("load", calculateWidth);
        window.addEventListener("resize", calculateWidth);

        const baseSpeed = 0.8;
        let targetSpeed = baseSpeed;
        let currentSpeed = baseSpeed;
        let isHovered = false;
        let scrollResumed = false;

        // Drag & Touch Gesture Handlers for Brands
        let isBrandsDragging = false;
        let brandsLastX = 0;
        let brandsRafId = null;
        let isBrandsVisible = false;

        const onBrandsPointerMove = (e) => {
            if (isBrandsDragging) {
                onBrandsDragMove(e.clientX);
            }
        };

        const onBrandsTouchMove = (e) => {
            if (isBrandsDragging && e.touches.length === 1) {
                onBrandsDragMove(e.touches[0].clientX);
            }
        };

        const onBrandsDragStart = (clientX) => {
            isBrandsDragging = true;
            brandsLastX = clientX;
            brandsSection.style.cursor = "grabbing";
            window.addEventListener("pointermove", onBrandsPointerMove);
            window.addEventListener("pointerup", onBrandsDragEnd);
            window.addEventListener("pointercancel", onBrandsDragEnd);
            window.addEventListener("touchmove", onBrandsTouchMove, { passive: true });
            window.addEventListener("touchend", onBrandsDragEnd);
        };

        const onBrandsDragMove = (clientX) => {
            if (!isBrandsDragging) return;
            const deltaX = clientX - brandsLastX;
            brandsLastX = clientX;
            pos += -deltaX;
            targetSpeed = -deltaX * 0.5;
            scrollResumed = true;
        };

        const onBrandsDragEnd = () => {
            if (!isBrandsDragging) return;
            isBrandsDragging = false;
            brandsSection.style.cursor = "grab";
            window.removeEventListener("pointermove", onBrandsPointerMove);
            window.removeEventListener("pointerup", onBrandsDragEnd);
            window.removeEventListener("pointercancel", onBrandsDragEnd);
            window.removeEventListener("touchmove", onBrandsTouchMove);
            window.removeEventListener("touchend", onBrandsDragEnd);
        };

        brandsSection.addEventListener("pointerdown", (e) => {
            onBrandsDragStart(e.clientX);
        });

        brandsSection.addEventListener("touchstart", (e) => {
            if (e.touches.length === 1) {
                onBrandsDragStart(e.touches[0].clientX);
            }
        }, { passive: true });

        brandsTrack.querySelectorAll("img").forEach(img => {
            img.addEventListener("dragstart", (e) => e.preventDefault());
        });

        // Hover listeners to pause auto-scrolling
        brandsSection.addEventListener("mouseenter", () => {
            isHovered = true;
            scrollResumed = false;
        });
        brandsSection.addEventListener("mouseleave", () => {
            isHovered = false;
            scrollResumed = false;
            isBrandsDragging = false;
            brandsSection.style.cursor = "grab";
        });

        // Wheel acceleration listener
        const brandsAccelHandler = (e) => {
            const rawDelta = e.deltaY || e.deltaX;
            if (rawDelta !== 0) {
                if (rawDelta > 0) {
                    if (targetSpeed < 0) targetSpeed = baseSpeed;
                    targetSpeed = Math.min(20, targetSpeed + rawDelta * 0.05);
                } else {
                    if (targetSpeed > 0) targetSpeed = -baseSpeed;
                    targetSpeed = Math.max(-20, targetSpeed + rawDelta * 0.05);
                }
                scrollResumed = true;
            }
        };

        brandsSection.addEventListener("wheel", brandsAccelHandler, { passive: true });

        // Setup custom cursor tracking for all brand-containers (including clones)
        const brandCursor = document.getElementById("brand-cursor");
        const allContainers = brandsTrack.querySelectorAll(".brand-container");
        if (brandCursor && allContainers.length > 0) {
            allContainers.forEach(container => {
                const sourceP = container.querySelector("p");
                if (sourceP) {
                    container.addEventListener("mousemove", (e) => {
                        brandCursor.style.left = e.clientX + "px";
                        brandCursor.style.top  = e.clientY + "px";
                    });
                    container.addEventListener("mouseenter", () => {
                        brandCursor.innerHTML = sourceP.innerHTML;
                        brandCursor.classList.add("visible");
                    });
                    container.addEventListener("mouseleave", () => {
                        brandCursor.classList.remove("visible");
                    });
                }
            });
        }

        function updateBrandsCarousel() {
            if (!isBrandsVisible) return;
            if (!isBrandsDragging) {
                const limitSpeed = (isHovered && !scrollResumed) ? 0 : baseSpeed;
                targetSpeed += (limitSpeed - targetSpeed) * 0.04;
                currentSpeed += (targetSpeed - currentSpeed) * 0.1;

                pos += currentSpeed;
            }

            if (W > 0) {
                if (pos >= W) {
                    pos -= W;
                } else if (pos < 0) {
                    pos += W;
                }
            }

            gsap.set(brandsTrack, { x: -pos });
            brandsRafId = requestAnimationFrame(updateBrandsCarousel);
        }

        if ('IntersectionObserver' in window) {
            const brandsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (!isBrandsVisible) {
                            isBrandsVisible = true;
                            cancelAnimationFrame(brandsRafId);
                            brandsRafId = requestAnimationFrame(updateBrandsCarousel);
                        }
                    } else {
                        isBrandsVisible = false;
                        cancelAnimationFrame(brandsRafId);
                    }
                });
            }, { threshold: 0.01 });
            brandsObserver.observe(brandsSection);
        } else {
            isBrandsVisible = true;
            updateBrandsCarousel();
        }
    }

    // Media logos infinite scroll carousel with mouse wheel, mouse drag & touch swipe gestures
    const mediaSection = document.querySelector(".media-brands");
    const mediaTrack = document.querySelector(".media-brands-track");
    if (mediaSection && mediaTrack) {
        const mediaItems = Array.from(mediaTrack.children);

        // Clone the elements twice to allow seamless scrolling loop across wide viewports
        for (let i = 0; i < 2; i++) {
            mediaItems.forEach(item => {
                const clone = item.cloneNode(true);
                mediaTrack.appendChild(clone);
            });
        }

        let mediaPos = 0;
        let mediaW = 0;
        const mediaGap = 80;

        const calculateMediaWidth = () => {
            mediaW = 0;
            mediaItems.forEach(item => {
                mediaW += item.offsetWidth + mediaGap;
            });
        };

        calculateMediaWidth();
        window.addEventListener("load", calculateMediaWidth);
        window.addEventListener("resize", calculateMediaWidth);

        const mediaBaseSpeed = 0.8;
        let mediaTargetSpeed = mediaBaseSpeed;
        let mediaCurrentSpeed = mediaBaseSpeed;
        let mediaIsHovered = false;
        let isDragging = false;
        let lastX = 0;

        mediaSection.addEventListener("mouseenter", () => {
            mediaIsHovered = true;
        });
        mediaSection.addEventListener("mouseleave", () => {
            mediaIsHovered = false;
            isDragging = false;
            mediaSection.style.cursor = "grab";
        });

        // 1. Mouse wheel / trackpad horizontal & vertical scroll
        mediaSection.addEventListener("wheel", (e) => {
            const rawDelta = e.deltaX !== 0 ? e.deltaX : e.deltaY;
            if (rawDelta !== 0) {
                if (rawDelta > 0) {
                    if (mediaTargetSpeed < 0) mediaTargetSpeed = mediaBaseSpeed;
                    mediaTargetSpeed = Math.min(25, mediaTargetSpeed + rawDelta * 0.08);
                } else {
                    if (mediaTargetSpeed > 0) mediaTargetSpeed = -mediaBaseSpeed;
                    mediaTargetSpeed = Math.max(-25, mediaTargetSpeed + rawDelta * 0.08);
                }
            }
        }, { passive: true });

        // 2. Mouse Drag & Touch Swipe Gesture Handlers
        let mediaRafId = null;
        let isMediaVisible = false;

        const onMediaPointerMove = (e) => {
            if (isDragging) {
                onDragMove(e.clientX);
            }
        };

        const onMediaTouchMove = (e) => {
            if (isDragging && e.touches.length === 1) {
                onDragMove(e.touches[0].clientX);
            }
        };

        const onDragStart = (clientX) => {
            isDragging = true;
            lastX = clientX;
            mediaSection.style.cursor = "grabbing";
            window.addEventListener("pointermove", onMediaPointerMove);
            window.addEventListener("pointerup", onDragEnd);
            window.addEventListener("pointercancel", onDragEnd);
            window.addEventListener("touchmove", onMediaTouchMove, { passive: true });
            window.addEventListener("touchend", onDragEnd);
        };

        const onDragMove = (clientX) => {
            if (!isDragging) return;
            const deltaX = clientX - lastX;
            lastX = clientX;
            mediaPos += -deltaX;
            mediaTargetSpeed = -deltaX * 0.5;
        };

        const onDragEnd = () => {
            if (!isDragging) return;
            isDragging = false;
            mediaSection.style.cursor = "grab";
            window.removeEventListener("pointermove", onMediaPointerMove);
            window.removeEventListener("pointerup", onDragEnd);
            window.removeEventListener("pointercancel", onDragEnd);
            window.removeEventListener("touchmove", onMediaTouchMove);
            window.removeEventListener("touchend", onDragEnd);
        };

        // Pointer Events
        mediaSection.addEventListener("pointerdown", (e) => {
            onDragStart(e.clientX);
        });

        // Touch Events Fallback
        mediaSection.addEventListener("touchstart", (e) => {
            if (e.touches.length === 1) {
                onDragStart(e.touches[0].clientX);
            }
        }, { passive: true });

        // Prevent native image dragging
        mediaTrack.querySelectorAll("img").forEach(img => {
            img.addEventListener("dragstart", (e) => e.preventDefault());
        });

        function updateMediaCarousel() {
            if (!isMediaVisible) return;
            if (!isDragging) {
                const limitSpeed = mediaIsHovered ? 0 : mediaBaseSpeed;
                mediaTargetSpeed += (limitSpeed - mediaTargetSpeed) * 0.04;
                mediaCurrentSpeed += (mediaTargetSpeed - mediaCurrentSpeed) * 0.1;
                mediaPos += mediaCurrentSpeed;
            }

            if (mediaW > 0) {
                if (mediaPos >= mediaW) {
                    mediaPos -= mediaW;
                } else if (mediaPos < 0) {
                    mediaPos += mediaW;
                }
            }

            gsap.set(mediaTrack, { x: -mediaPos });
            mediaRafId = requestAnimationFrame(updateMediaCarousel);
        }

        if ('IntersectionObserver' in window) {
            const mediaObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (!isMediaVisible) {
                            isMediaVisible = true;
                            cancelAnimationFrame(mediaRafId);
                            mediaRafId = requestAnimationFrame(updateMediaCarousel);
                        }
                    } else {
                        isMediaVisible = false;
                        cancelAnimationFrame(mediaRafId);
                    }
                });
            }, { threshold: 0.01 });
            mediaObserver.observe(mediaSection);
        } else {
            isMediaVisible = true;
            updateMediaCarousel();
        }
    }
});

// After all assets load: refresh positions then register the testimonials trigger
// (must come after Section 7 pin spacer is inserted so positions are correct)
window.addEventListener("load", () => {
    ScrollTrigger.refresh();

    const testimonialsText = document.querySelector(".testimonials-title p");
    if (testimonialsText && document.querySelector(".merchant-testimony-section")) {
        const wordsEls = testimonialsText.querySelectorAll(".word");
        gsap.set(wordsEls, { y: "110%" });

        const testimonialsTl = gsap.timeline({
            scrollTrigger: {
                trigger: ".testimonials-title",
                start: "top 70%",
                end: "top 30%",
                scrub: 0.5
            }
        });

        testimonialsTl.to(wordsEls, {
            y: "0%",
            stagger: 0.4,
            ease: "power2.out"
        });
    }

    const bentoText = document.querySelector(".bento-title h3");
    if (bentoText && document.querySelector(".bento-container")) {
        const wordsEls = bentoText.querySelectorAll(".word");
        gsap.set(wordsEls, { y: "110%" });

        const bentoTl = gsap.timeline({
            scrollTrigger: {
                trigger: ".bento-title",
                start: "top 70%",
                end: "top 30%",
                scrub: 0.5
            }
        });

        bentoTl.to(wordsEls, {
            y: "0%",
            stagger: 0.4,
            ease: "power2.out"
        });
    }

    // Bento items slide up and fade in animation with scrub control
    const bentoItems = document.querySelectorAll(".bento-container .bento-item");
    if (bentoItems.length > 0) {
        gsap.set(bentoItems, { y: 60, opacity: 0 });

        const bentoItemsTl = gsap.timeline({
            scrollTrigger: {
                trigger: ".bento-container",
                start: "top 75%",
                end: "top 20%",
                scrub: 0.3,
                invalidateOnRefresh: true
            }
        });

        bentoItemsTl.to(bentoItems, {
            y: 0,
            opacity: 1,
            stagger: 1.5,
            duration: 2,
            ease: "power2.out"
        });
    }

    const trialText = document.querySelector(".trial-title > p");
    if (trialText && document.querySelector(".trial-buttons-container")) {
        const wordsEls = trialText.querySelectorAll(".word");
        gsap.set(wordsEls, { y: "110%" });

        const trialTl = gsap.timeline({
            scrollTrigger: {
                trigger: ".trial-title",
                start: "top 50%",
                end: "top 30%",
                scrub: 0.3
            }
        });

        trialTl.to(wordsEls, {
            y: "0%",
            stagger: 0.4,
            ease: "power2.out"
        });
    }

    // ════════════════════════════════════════════════════════════
    // GSAP Entrance Animations for Inner Pages
    // ════════════════════════════════════════════════════════════
    const innerHeaders = document.querySelectorAll(
        ".generic-banner, .agent-banner, .ibr-banner, .invoice-page-header, .devices-title, .store-intro, .agent-writeup, .ibr-writeup"
    );
    if (innerHeaders.length > 0) {
        gsap.from(innerHeaders, {
            y: 35,
            opacity: 0,
            duration: 0.8,
            stagger: 0.12,
            ease: "power2.out"
        });
    }

    const innerCards = document.querySelectorAll(
        ".agent-feature-card, .agent-video-wrap, .handbook-toc-card, .privacy-card, .store-item, section.devices-plugin-section, .invoice-wizard, .invoice-preview-panel, .checkout-card"
    );
    if (innerCards.length > 0) {
        innerCards.forEach(card => {
            gsap.from(card, {
                y: 30,
                opacity: 0,
                duration: 0.7,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: card,
                    start: "top 90%",
                    toggleActions: "play none none none"
                }
            });
        });
    }
});