<?php
function sanitizeURL($url) {
    // List of URLs that should not trigger redirection
    $allowedURLs = array(
        'http://localhost/Login-signup/login.php',
        'http://localhost/Login-signup/home.php'
    );

    // Check if the requested URL is in the list of allowed URLs
    if (in_array($url, $allowedURLs)) {
        return $url;
    } else {
        // Implement your URL validation/sanitization logic here
        return filter_var($url, FILTER_SANITIZE_URL);
    }
}