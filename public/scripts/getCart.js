const emptyCartText = `<p class="empty-cart-text">В корзине нет ни одного товара</p>`;

document.addEventListener("DOMContentLoaded", function () {
    const cartTotalBtn = document.querySelector(".cart-total-btn");

    updateCheckoutButton(cartTotalBtn);

    window.addEventListener("storage", updateCheckoutButton);

    if (window.Auth) fetchCartFromServer();
    else updateCartUI();
});

function fetchCartFromServer() {
    fetch("/cart/get", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((response) => response.json())
        .then((data) => {
            const cartContainer = document.querySelector(".cart-products-list");

            if (data.length === 0 && cartContainer)
                cartContainer.innerHTML = emptyCartText;

            window.localStorage.setItem(
                "cart",
                JSON.stringify(
                    data.map((item) => ({ ...item, isSelected: false }))
                )
            );
        })
        .catch((error) => console.error("Error loading the cart:", error));
}

function updateCartUI() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    const cartContainer = document.querySelector(".cart-products-list");

    if (!cart.length) cartContainer.innerHTML = emptyCartText;

    if (cartContainer) {
        let html = "";

        cart.forEach((item) => {
            html += `
            <div class="cart-products-list-item-container position-relative" data-id="${item.id}" data-amount="${item.amount}">
                <a href="/products/${item.id}" class="text-decoration-none cart-products-list-item">
                    <div class="product-bg d-flex">
                        <div class="product-image-container">
                            <img src="/img/products/${item.imageUrl}" alt="product img">
                        </div>
                        <div class="product-text-block d-flex flex-column justify-content-between">
                            <div>
                                <p class="product-title">${item.title}</p>
                                <p class="product-desc">${item.desc}</p>
                            </div>
                            <div>
                                <p class="product-price d-flex align-items-center">${item.price}
                                    <img class="product-price-rouble" src="/svg/rouble.svg" alt="rouble icon">
                                </p>
                                <p class="product-amount">${item.amount}</p>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="product-top-actions d-flex">
                    <button
                        class="product-remove-from-cart-button d-flex align-items-center justify-content-center"
                        data-id="${item.id}"
                        data-amount="${item.amount}"
                    >
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.6666 2.66667H10.3333L9.66658 2H6.33325L5.66659 2.66667H3.33325V4H12.6666M3.99992 12.6667C3.99992 13.0203 4.14039 13.3594 4.39044 13.6095C4.64049 13.8595 4.97963 14 5.33325 14H10.6666C11.0202 14 11.3593 13.8595 11.6094 13.6095C11.8594 13.3594 11.9999 13.0203 11.9999 12.6667V4.66667H3.99992V12.6667Z"
                                fill="#AEAEAE"/>
                        </svg>
                    </button>
                    <input
                        type="checkbox"
                        class="product-add-to-cart-checkbox"
                        data-id="${item.id}"
                        data-amount="${item.amount}"
                    >
                </div>
                <div class="quantity-controls d-flex align-items-center">
                    <button
                        class="product-decrease-quantity-btn d-flex align-items-center justify-content-center"
                        data-id="${item.id}"
                        data-amount="${item.amount}"
                    >
                        <span>-</span>
                    </button>
                    <span
                        class="product-quantity"
                        data-id="${item.id}"
                        data-amount="${item.amount}"
                    >${item.quantity}</span>
                    <button
                        class="product-increase-quantity-btn d-flex align-items-center justify-content-center"
                        data-id="${item.id}"
                        data-amount="${item.amount}"
                    >
                        <span>+</span>
                    </button>
                </div>
            </div>
        `;
        });

        cartContainer.innerHTML = html;
    }
}

function updateCheckoutButton(cartTotalBtn) {
    if (cartTotalBtn) {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];

        const isSelected = cart.some((item) => item.isSelected);

        cartTotalBtn.disabled = !isSelected;
    }
}
