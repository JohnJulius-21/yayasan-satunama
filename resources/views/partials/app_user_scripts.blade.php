<script>
    // Enhanced Mobile Sidebar Toggle
    class MobileSidebar {
        constructor() {
            this.sidebar = document.getElementById('sidebar');
            this.sidebarToggle = document.getElementById('sidebarToggle');
            this.sidebarClose = document.getElementById('sidebarClose');
            this.sidebarOverlay = document.getElementById('sidebarOverlay');
            this.body = document.body;

            this.init();
        }

        init() {
            // Toggle button event
            this.sidebarToggle?.addEventListener('click', () => {
                this.toggleSidebar();
            });

            // Close button event
            this.sidebarClose?.addEventListener('click', () => {
                this.closeSidebar();
            });

            // Overlay click event
            this.sidebarOverlay?.addEventListener('click', () => {
                this.closeSidebar();
            });

            // Keyboard event (ESC key)
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.isSidebarOpen()) {
                    this.closeSidebar();
                }
            });

            // Handle window resize
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    this.closeSidebar();
                }
            });

            // Touch gestures for mobile
            this.initTouchGestures();
        }

        toggleSidebar() {
            if (this.isSidebarOpen()) {
                this.closeSidebar();
            } else {
                this.openSidebar();
            }
        }

        openSidebar() {
            this.sidebar.classList.remove('sidebar-hidden');
            this.sidebar.classList.add('sidebar-visible');
            this.sidebarOverlay.classList.remove('overlay-hidden');
            this.sidebarOverlay.classList.add('overlay-visible');
            this.body.classList.add('no-scroll');

            // Focus trap for accessibility
            this.trapFocus();
        }

        closeSidebar() {
            this.sidebar.classList.add('sidebar-hidden');
            this.sidebar.classList.remove('sidebar-visible');
            this.sidebarOverlay.classList.add('overlay-hidden');
            this.sidebarOverlay.classList.remove('overlay-visible');
            this.body.classList.remove('no-scroll');

            // Remove focus trap
            this.removeFocusTrap();
        }

        isSidebarOpen() {
            return this.sidebar.classList.contains('sidebar-visible');
        }

        initTouchGestures() {
            let startX = 0;
            let currentX = 0;
            let isDragging = false;

            // Touch start
            document.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;

                // If touching near left edge and sidebar is closed
                if (startX < 20 && !this.isSidebarOpen()) {
                    isDragging = true;
                }

                // If sidebar is open and touching it
                if (this.isSidebarOpen() && startX > 256) {
                    isDragging = true;
                }
            }, {
                passive: true
            });

            // Touch move
            document.addEventListener('touchmove', (e) => {
                if (!isDragging) return;

                currentX = e.touches[0].clientX;
                const deltaX = currentX - startX;

                // Open gesture (swipe right from left edge)
                if (!this.isSidebarOpen() && deltaX > 50) {
                    this.openSidebar();
                    isDragging = false;
                }

                // Close gesture (swipe left when sidebar is open)
                if (this.isSidebarOpen() && deltaX < -50) {
                    this.closeSidebar();
                    isDragging = false;
                }
            }, {
                passive: true
            });

            // Touch end
            document.addEventListener('touchend', () => {
                isDragging = false;
            }, {
                passive: true
            });
        }

        trapFocus() {
            const focusableElements = this.sidebar.querySelectorAll(
                'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
            );
            const firstFocusableElement = focusableElements[0];
            const lastFocusableElement = focusableElements[focusableElements.length - 1];

            // Focus first element
            firstFocusableElement?.focus();

            // Trap tab key
            this.sidebar.addEventListener('keydown', (e) => {
                if (e.key === 'Tab') {
                    if (e.shiftKey) {
                        if (document.activeElement === firstFocusableElement) {
                            lastFocusableElement?.focus();
                            e.preventDefault();
                        }
                    } else {
                        if (document.activeElement === lastFocusableElement) {
                            firstFocusableElement?.focus();
                            e.preventDefault();
                        }
                    }
                }
            });
        }

        removeFocusTrap() {
            // Remove event listeners if needed
            // Return focus to toggle button
            this.sidebarToggle?.focus();
        }
    }

    // Initialize on page load
    let mobileSidebar;

    document.addEventListener('DOMContentLoaded', function() {
        mobileSidebar = new MobileSidebar();
    });
</script>
