document.addEventListener("DOMContentLoaded", function () {
    document
        .querySelectorAll(".product-remove-from-cart-button")
        .forEach((button) => {
            button.addEventListener("click", function () {
                const cart = JSON.parse(localStorage.getItem("cart")) || [];

                const productId = this.dataset.id;
                const amount = this.dataset.amount;

                const newCart = cart.filter(
                    (item) => item.id !== +productId || item.amount !== amount
                );

                localStorage.setItem("cart", JSON.stringify(newCart));

                updateTotalPrice(newCart);

                document
                    .querySelector(
                        `.cart-products-list-item-container[data-id="${productId}"][data-amount="${amount}"]`
                    )
                    .remove();

                const cartContainer = document.querySelector(
                    ".cart-products-list"
                );

                if (newCart.length === 0)
                    cartContainer.innerHTML = emptyCartText;

                if (window.Auth) {
                    fetch(
                        `/cart/remove-product?product_id=${productId}&amount=${amount}`,
                        {
                            method: "DELETE",
                            headers: {
                                "Content-Type": "application/json",
                                Accept: "application/json",
                                "X-CSRF-TOKEN": document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute("content"),
                            },
                        }
                    )
                        .then((response) => response.json())
                        .catch((error) => console.error("Error:", error));
                }
            });
        });
});
