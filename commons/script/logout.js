function doLogout() {
    fetch("/pages/logout/logout.php")
        .then(response => response.json())
        .then(() => window.location.replace("/home"))
        .catch(() => window.location.replace("/home"));
}