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

    // Go-to-store button hover animation
    const goToStore = document.querySelector(".go-to-store");
    const goToStoreText = document.querySelector(".go-to-store .text");
    const arrowImg = document.querySelector(".go-to-store .arrow img");

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
            if (!navDropdown.contains(e.target) && e.target !== menuBtn) {
                navDropdown.classList.remove("open");
                menuBtn.classList.remove("open");
                menuBtn.setAttribute("aria-expanded", false);
                navDropdown.setAttribute("aria-hidden", true);
            }
        });

        // ── Custom "Menu" cursor pill ─────────────────────────────────────────
        const menuCursor = document.getElementById("menu-cursor");
        if (menuCursor) {
            // Move pill to follow the mouse precisely (fixed positioning = clientX/Y)
            menuBtn.addEventListener("mousemove", (e) => {
                menuCursor.style.left = e.clientX + "px";
                menuCursor.style.top  = e.clientY + "px";
            });

            // Show on enter, hide on leave
            menuBtn.addEventListener("mouseenter", () => {
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

            function updateMarquee() {
                if (!isWheeling) {
                    pos += 0.5; // scroll speed (slowed down)
                    if (pos >= W) {
                        pos -= W;
                    }
                    gsap.set(container, { x: -pos });
                }
                requestAnimationFrame(updateMarquee);
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

            updateMarquee();
        }
    }

    gsap.registerPlugin(ScrollTrigger);

    const isMobile = window.matchMedia("(max-width: 820px)").matches;
    const phone = document.querySelector(".phone");
    let phonePinWrap = phone.parentElement;

    if (!isMobile) {
        if (!phonePinWrap.classList.contains("phone-pin-wrap")) {
            phonePinWrap = document.createElement("div");
            phonePinWrap.className = "phone-pin-wrap";
            phone.parentElement.insertBefore(phonePinWrap, phone);
            phonePinWrap.appendChild(phone);
        }

        phonePinWrap.style.width = "100%";
        phonePinWrap.style.position = "relative";
        phonePinWrap.style.zIndex = "2";
        phone.style.position = "relative";
        phone.style.zIndex = "2";

        // Pin the phone wrapper so it stays fixed on screen through Section 3 & 4, then unpins when out of view
        ScrollTrigger.create({
            trigger: ".hero-section",
            start: "top top",
            endTrigger: ".section3-4-wrap",
            end: "bottom top",
            pin: phonePinWrap,
            pinSpacing: false,
            anticipatePin: 1
        });

        // Phone image transform animation timeline with scroll scrub
        const phoneImg = document.querySelector(".phone img");
        const transformVals = {
            pers: 900,
            rotX: 75,
            skewX: 0,
            scaleY: 1,
            rotY: 0
        };

        function getTop10PercentOffset() {
            const phoneRect = phone.getBoundingClientRect();
            const height = phoneRect.height || 800;

            // Get the absolute top relative to the document to handle page loads when already scrolled down
            const absoluteTop = phoneRect.top + window.scrollY;

            // Compensate for the top moving down when scaled down to 0.70 around the center
            const scaleCorrection = (1 - 0.70) * height / 2;

            // Align to 10% from the top of the viewport
            const targetY = (window.innerHeight * 0.10) - absoluteTop - scaleCorrection;
            return targetY;
        }

        const phoneImgTl = gsap.timeline({
            scrollTrigger: {
                trigger: ".hero-section",
                start: "top top",
                endTrigger: ".section-3",
                end: "top top",
                scrub: 1,
                invalidateOnRefresh: true
            }
        });

        phoneImgTl.to(transformVals, {
            pers: 7000,
            rotX: 60,
            skewX: 40,
            scaleY: 0.94,
            rotY: -35,
            ease: "none",
            onUpdate: () => {
                phone.style.perspective = `${transformVals.pers}px`;
                phoneImg.style.transform = `rotateX(${transformVals.rotX}deg) skewX(${transformVals.skewX}deg) scaleY(${transformVals.scaleY}) rotateY(${transformVals.rotY}deg)`;
            }
        });

        phoneImgTl.to(phone, {
            y: getTop10PercentOffset(),
            xPercent: -15,
            scale: 0.7,
            ease: "none"
        }, "<");

        phoneImgTl.fromTo(phoneImg, {
            width: 400
        }, {
            width: 380,
            ease: "none"
        }, "<");

        // Section 3 sequence animation on pinning (triggers when 98% in view)
        const s3Images = document.querySelectorAll(".section-3 .img-cont img");
        const imgCont = document.querySelector(".section-3 .img-cont");

        // Initially hide all elements for the animation sequence
        gsap.set(s3Images, { opacity: 0 });
        gsap.set([".section-3 .title", ".section-3 .text-cont"], { opacity: 0 });

        const s3Timeline = gsap.timeline({
            scrollTrigger: {
                trigger: ".section3-4-wrap",
                start: "top top", // Pin flush at the top of the viewport to prevent any gaps
                end: "+=300%",   // pin for 300vh of scroll (100% for store building, 100% for s3 wipe, 100% for s4 wipe)
                pin: true,
                pinSpacing: true,
                scrub: true,
                invalidateOnRefresh: true
            }
        });

        // Phone fades out from 1 to 0 over the first 0.5s of the timeline (at time 0)
        s3Timeline.to(phone, {
            opacity: 0,
            duration: 0.5,
            ease: "power1.inOut"
        }, 0);

        // Manage display state dynamically to save GPU rendering cycles when out of view
        s3Timeline.set([phone, phoneImg], { display: "flex" }, 0);
        s3Timeline.set([phone, phoneImg], { display: "none" }, 0.5);

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

        const imgContHeight = imgCont.offsetHeight || 870;
        const threePercent = imgContHeight * 0.03;

        s3Images.forEach((img) => {
            const style = window.getComputedStyle(img);

            // Check if element is bottom positioned
            const isBottom = img.className.includes("floor") ||
                img.className.includes("counter") ||
                img.className.includes("customer");

            const isStoreTop = img.className.includes("store-top");
            // store-top fades in over 0.3s starting concurrently at 0, so it appears before phone is completely gone
            const duration = isStoreTop ? 0.3 : 0.4;
            const ease = isStoreTop ? "power1.out" : "power2.out";
            const position = isStoreTop ? 0 : "+=0.15";

            if (isBottom) {
                const originalBottom = style.bottom;
                const baseVal = parseFloat(originalBottom) || 0;
                const startBottom = baseVal - threePercent;

                s3Timeline.fromTo(img, {
                    bottom: `${startBottom}px`,
                    opacity: 0
                }, {
                    bottom: originalBottom,
                    opacity: 1,
                    duration: duration,
                    ease: ease
                }, position);
            } else {
                const originalTop = style.top;
                const baseVal = parseFloat(originalTop) || 0;
                const startTop = baseVal + threePercent;

                s3Timeline.fromTo(img, {
                    top: `${startTop}px`,
                    opacity: 0
                }, {
                    top: originalTop,
                    opacity: 1,
                    duration: duration,
                    ease: ease
                }, position);
            }
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

    } else {
        gsap.set(".phone", { clearProps: "all" });
        gsap.set(".phone img", { clearProps: "transform,transformOrigin" });
        gsap.set([".section-3", ".section-4"], { clearProps: "all" });
        gsap.set(".section-3 .img-cont img", { clearProps: "all" });
        gsap.set([".section-3 .title", ".section-3 .text-cont"], { clearProps: "all" });

        // Mobile scroll trigger to scale down phone.png by 70% (to scale: 0.3)
        const mobilePhoneImg = document.querySelector(".phone img");
        if (mobilePhoneImg) {
            gsap.to(mobilePhoneImg, {
                scale: 0.3,
                ease: "none",
                scrollTrigger: {
                    trigger: ".hero-section",
                    start: "top top",
                    end: "bottom top",
                    scrub: true,
                    invalidateOnRefresh: true
                }
            });
        }
    }

    // Split text effect for Section 2
    const section2Text = document.querySelector(".section-2 p");
    if (section2Text) {
        const words = section2Text.textContent.trim().split(/\s+/);
        section2Text.innerHTML = words.map(word => {
            if (word.includes("ShopKite")) {
                const baseWord = word.replace("?", "");
                const hasQuestionMark = word.includes("?");

                let result = `<span style="display: inline-block; overflow: hidden; padding-bottom: 0.15em; margin-bottom: -0.15em; vertical-align: bottom;">` +
                    `<span class="word highlight" style="display: inline-block; transform: translate3d(0, 110%, 0);">${baseWord}</span>` +
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
    // DOM setup happens at DOMContentLoaded so words start hidden immediately
    const testimonialsText = document.querySelector(".testimonials-title p");
    if (testimonialsText) {
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
    const bentoText = document.querySelector(".bento-title p");
    if (bentoText) {
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
    const trialText = document.querySelector(".trial-title p");
    if (trialText) {
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
                scrub: 1,
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
        const handleScroll = () => {
            const threshold = window.innerHeight * 0.05; // 5% of viewport height
            if (window.scrollY >= threshold) {
                gsap.to(heroButtons, { opacity: 0, pointerEvents: "none", duration: 0.3, overwrite: "auto" });
            } else if (window.scrollY <= 2) {
                gsap.to(heroButtons, { opacity: 1, pointerEvents: "auto", duration: 0.3, overwrite: "auto" });
            }
        };
        window.addEventListener("scroll", handleScroll);
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
                scrub: 1, // scrub delay of 1s for a smoother response
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

            // Listen to window wheel events for acceleration (proportional to each row's base speed)
            window.addEventListener("wheel", (e) => {
                const delta = Math.abs(e.deltaX || e.deltaY);
                if (delta > 0) {
                    rowStates.forEach(state => {
                        const maxSpeed = state.base * 10;
                        state.target = Math.min(maxSpeed, state.target + delta * 0.03);
                    });
                }
            }, { passive: true });

            function updateS8Marquee() {
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

                requestAnimationFrame(updateS8Marquee);
            }

            updateS8Marquee();
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

        function updateCarousel() {
            // When mousewheel activity occurs (scrollResumed === true), we auto-resume normal speed on mousewheel pause (stops)
            const limitSpeed = (isHovered && !scrollResumed) ? 0 : baseSpeed;

            // Lerp targetSpeed towards the current limit speed (auto-scroll or paused)
            targetSpeed += (limitSpeed - targetSpeed) * 0.04;

            // Damping logic for currentSpeed towards targetSpeed
            currentSpeed += (targetSpeed - currentSpeed) * 0.1;

            pos += currentSpeed;
            if (pos >= W) {
                pos -= W;
            } else if (pos < 0) {
                pos += W;
            }

            gsap.set(testimonyTrack, { x: -pos });
            requestAnimationFrame(updateCarousel);
        }

        updateCarousel();
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

        // Hover listeners to pause auto-scrolling
        brandsSection.addEventListener("mouseenter", () => {
            isHovered = true;
            scrollResumed = false;
        });
        brandsSection.addEventListener("mouseleave", () => {
            isHovered = false;
            scrollResumed = false;
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
            const limitSpeed = (isHovered && !scrollResumed) ? 0 : baseSpeed;
            targetSpeed += (limitSpeed - targetSpeed) * 0.04;
            currentSpeed += (targetSpeed - currentSpeed) * 0.1;

            pos += currentSpeed;
            if (W > 0) {
                if (pos >= W) {
                    pos -= W;
                } else if (pos < 0) {
                    pos += W;
                }
            }

            gsap.set(brandsTrack, { x: -pos });
            requestAnimationFrame(updateBrandsCarousel);
        }

        updateBrandsCarousel();
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
        const onDragStart = (clientX) => {
            isDragging = true;
            lastX = clientX;
            mediaSection.style.cursor = "grabbing";
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
        };

        // Pointer Events
        mediaSection.addEventListener("pointerdown", (e) => {
            onDragStart(e.clientX);
        });

        window.addEventListener("pointermove", (e) => {
            if (isDragging) {
                onDragMove(e.clientX);
            }
        });

        window.addEventListener("pointerup", onDragEnd);
        window.addEventListener("pointercancel", onDragEnd);

        // Touch Events Fallback
        mediaSection.addEventListener("touchstart", (e) => {
            if (e.touches.length === 1) {
                onDragStart(e.touches[0].clientX);
            }
        }, { passive: true });

        window.addEventListener("touchmove", (e) => {
            if (isDragging && e.touches.length === 1) {
                onDragMove(e.touches[0].clientX);
            }
        }, { passive: true });

        window.addEventListener("touchend", onDragEnd);

        // Prevent native image dragging
        mediaTrack.querySelectorAll("img").forEach(img => {
            img.addEventListener("dragstart", (e) => e.preventDefault());
        });

        function updateMediaCarousel() {
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
            requestAnimationFrame(updateMediaCarousel);
        }

        updateMediaCarousel();
    }
});

// After all assets load: refresh positions then register the testimonials trigger
// (must come after Section 7 pin spacer is inserted so positions are correct)
window.addEventListener("load", () => {
    ScrollTrigger.refresh();

    const testimonialsText = document.querySelector(".testimonials-title p");
    if (testimonialsText) {
        const wordsEls = testimonialsText.querySelectorAll(".word");
        // Ensure still hidden after refresh
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

    const bentoText = document.querySelector(".bento-title p");
    if (bentoText) {
        const wordsEls = bentoText.querySelectorAll(".word");
        // Ensure still hidden after refresh
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
        // Set initial state for bento items
        gsap.set(bentoItems, { y: 60, opacity: 0 });

        const bentoItemsTl = gsap.timeline({
            scrollTrigger: {
                trigger: ".bento-container",
                start: "top 75%",
                end: "top 20%",
                scrub: 1,
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

    const trialText = document.querySelector(".trial-title p");
    if (trialText) {
        const wordsEls = trialText.querySelectorAll(".word");
        // Ensure still hidden after refresh
        gsap.set(wordsEls, { y: "110%" });

        const trialTl = gsap.timeline({
            scrollTrigger: {
                trigger: ".trial-title",
                start: "top 50%",
                end: "top 30%",
                scrub: 1
            }
        });

        trialTl.to(wordsEls, {
            y: "0%",
            stagger: 0.4,
            ease: "power2.out"
        });
    }
});
