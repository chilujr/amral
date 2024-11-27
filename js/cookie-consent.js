// Function to check if the cookie consent cookie exists
function checkCookieConsent() {
    return document.cookie.indexOf('cookie_consent_accepted=true') !== -1;
}

// Show the cookie consent pop-up if the cookie is not set
if (!checkCookieConsent()) {
    document.getElementById('cookie-consent-popup').style.display = 'block';
}

// Accept button functionality
document.getElementById('accept-cookies').addEventListener('click', function() {
    // Set a cookie to remember the user's consent
    document.cookie = "cookie_consent_accepted=true; path=/; max-age=" + (60 * 60 * 24 * 365); // 1 year
    document.getElementById('cookie-consent-popup').style.display = 'none';
});

// Decline button functionality (you can customize this based on your needs)
document.getElementById('decline-cookies').addEventListener('click', function() {
    document.getElementById('cookie-consent-popup').style.display = 'none';
});