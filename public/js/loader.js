/**
 * ShopKite Page Loader
 * Runs immediately — NOT deferred, NOT inside DOMContentLoaded.
 * Tracks real image load events from the earliest possible moment.
 */
(function () {
    var fill = document.querySelector(".loader-bar-fill");
    var pctEl = document.querySelector(".loader-percentage");
    var loader = document.getElementById("page-loader");

    if (!fill || !pctEl || !loader) return;

    var current = 0;   // displayed %
    var target = 0;    // target % to animate toward
    var raf;

    // Smoothly animate displayed % toward target using rAF
    function animate() {
        if (current < target) {
            current += (target - current) * 0.08;
            if (target - current < 0.5) current = target;
            var display = Math.floor(current);
            fill.style.width = display + "%";
            pctEl.textContent = display + "%";
        }
        raf = requestAnimationFrame(animate);
    }
    raf = requestAnimationFrame(animate);

    function setTarget(pct) {
        target = Math.min(100, Math.max(target, pct));
    }

    function dismissLoader() {
        cancelAnimationFrame(raf);
        fill.style.width = "100%";
        pctEl.textContent = "100%";
        loader.style.transition = "opacity 0.5s ease";
        loader.style.opacity = "0";
        setTimeout(function () {
            loader.style.display = "none";
            document.documentElement.classList.remove("loading");
        }, 520);
    }

    // --- Track images ---
    var tracked = new WeakSet();
    var total = 0;
    var loaded = 0;

    function onImageEvent() {
        loaded++;
        setTarget((loaded / Math.max(total, 1)) * 90);
    }

    function trackImage(img) {
        if (tracked.has(img)) return;
        tracked.add(img);
        total++;

        if (img.complete) {
            setTimeout(onImageEvent, 0);
        } else {
            img.addEventListener("load", onImageEvent, { once: true });
            img.addEventListener("error", onImageEvent, { once: true });
        }
    }

    document.querySelectorAll("img").forEach(trackImage);

    var observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (m) {
            m.addedNodes.forEach(function (node) {
                if (node.nodeType !== 1) return;
                if (node.tagName === "IMG") trackImage(node);
                node.querySelectorAll && node.querySelectorAll("img").forEach(trackImage);
            });
        });
    });
    observer.observe(document.documentElement, { childList: true, subtree: true });

    window.addEventListener("load", function () {
        observer.disconnect();
        setTarget(100);
        setTimeout(dismissLoader, 600);
    }, { once: true });
})();
