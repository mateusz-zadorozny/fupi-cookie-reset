function deleteCookiesAndReload() {
    var cookies = ['fp_current_session', 'fp_cookie', 'fp_last_url', 'fupi_id'];

    function deleteCookie(name) {
        document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }

    cookies.forEach(function (cookie) {
        deleteCookie(cookie);
    });

    window.location.reload();
}

// Add event listener to elements with the 'fupi-reset' class
document.addEventListener('DOMContentLoaded', function () {
    var resetElements = document.querySelectorAll('.fupi-reset');
    resetElements.forEach(function (element) {
        element.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior
            deleteCookiesAndReload();
        });
    });
});