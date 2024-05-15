document.addEventListener("DOMContentLoaded", function () {
    document
        .querySelector(".logout-link")
        .addEventListener("click", function (e) {
            e.preventDefault();

            document.getElementById("logout-form").submit();

            window.localStorage.setItem("cart", JSON.stringify([]));
        });
});
