    document.addEventListener('DOMContentLoaded', () => {
        // Smooth scrolling for navbar links
        document.querySelectorAll('.smooth-scroll').forEach(link => {
            link.addEventListener('click', function (e) {
                // Prevent default navigation
                e.preventDefault();

                // Extract the target section from the href attribute
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    const navbarHeight = document.querySelector('.navbar').offsetHeight;
                    const offsetPosition = targetElement.offsetTop - navbarHeight;

                    // Smooth scroll to the target section
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth',
                    });

                    // Update the URL hash without causing a jump
                    history.pushState(null, null, targetId);
                }
            });
        });

        // Smooth scrolling for "Back to Top" button
        const backToTopButton = document.querySelector('.back-to-top');
        if (backToTopButton) {
            backToTopButton.addEventListener('click', function (e) {
                e.preventDefault();

                // Smooth scroll back to the top of the page
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth',
                });

                // Update the URL hash to root
                history.pushState(null, null, '#');
            });
        }

        // Handle scrolling for links with hash on page load
        const hash = window.location.hash; // Get the hash from the URL
        if (hash) {
            const targetElement = document.querySelector(hash);
            if (targetElement) {
                const navbarHeight = document.querySelector('.navbar').offsetHeight;
                const offsetPosition = targetElement.offsetTop - navbarHeight;

                // Scroll to the target section with offset
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth',
                });
            }
        }
    });
