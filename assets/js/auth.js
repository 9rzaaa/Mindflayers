/**
 * Authentication State Management
 * Handles login state using localStorage
 */

const AUTH_KEY = 'mindflayer_auth_user';

/**
 * Check if user is currently logged in
 * @returns {boolean} True if user is logged in
 */
function isLoggedIn() {
    return localStorage.getItem(AUTH_KEY) === 'true';
}

/**
 * Set user as logged in
 * @param {string} email - User email (optional, for future use)
 */
function setLoggedIn(email = null) {
    localStorage.setItem(AUTH_KEY, 'true');
    if (email) {
        localStorage.setItem('mindflayer_auth_email', email);
    }
}

/**
 * Log out the current user
 */
function logout() {
    localStorage.removeItem(AUTH_KEY);
    localStorage.removeItem('mindflayer_auth_email');
}

/**
 * Get logged in user email
 * @returns {string|null} User email or null if not logged in
 */
function getLoggedInUser() {
    return localStorage.getItem('mindflayer_auth_email');
}
