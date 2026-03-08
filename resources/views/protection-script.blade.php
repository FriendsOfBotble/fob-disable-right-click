<script>
(function() {
    'use strict';

    @if ($disableRightClick)
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'F12'
            || (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J'))
            || (e.ctrlKey && e.key === 'u')
            || (e.metaKey && e.altKey && (e.key === 'i' || e.key === 'j' || e.key === 'u'))
        ) {
            e.preventDefault();
        }
    });
    @endif

    @if ($disableTextSelection)
    document.addEventListener('DOMContentLoaded', function() {
        document.body.style.userSelect = 'none';
        document.body.style.webkitUserSelect = 'none';
    });

    document.addEventListener('selectstart', function(e) {
        e.preventDefault();
    });
    @endif

    @if ($disableCopy)
    document.addEventListener('copy', function(e) {
        e.preventDefault();
    });

    document.addEventListener('cut', function(e) {
        e.preventDefault();
    });

    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && (e.key === 'c' || e.key === 'x')) {
            e.preventDefault();
        }
    });
    @endif

    @if ($disableImageDrag)
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('img').forEach(function(img) {
            img.setAttribute('draggable', 'false');
        });

        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.tagName === 'IMG') {
                        node.setAttribute('draggable', 'false');
                    }
                    if (node.querySelectorAll) {
                        node.querySelectorAll('img').forEach(function(img) {
                            img.setAttribute('draggable', 'false');
                        });
                    }
                });
            });
        });

        observer.observe(document.body, { childList: true, subtree: true });
    });

    document.addEventListener('dragstart', function(e) {
        if (e.target.tagName === 'IMG') {
            e.preventDefault();
        }
    });
    @endif

    @if ($disableDevTools)
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
        || (navigator.maxTouchPoints > 1 && /Macintosh/i.test(navigator.userAgent));

    if (!isMobile) {
        var threshold = 160;
        var devtoolsOpen = false;

        setInterval(function() {
            var widthDiff = window.outerWidth - window.innerWidth;
            var heightDiff = window.outerHeight - window.innerHeight;

            if (widthDiff > threshold || heightDiff > threshold) {
                if (!devtoolsOpen) {
                    devtoolsOpen = true;
                    window.location.reload();
                }
            } else {
                devtoolsOpen = false;
            }
        }, 500);
    }
    @endif
})();
</script>
