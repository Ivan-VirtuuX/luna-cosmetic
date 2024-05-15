let cart = JSON.parse(localStorage.getItem("cart")) || [];

document.addEventListener("DOMContentLoaded", function () {
    const cartTotalBtn = document.querySelector(".cart-total-btn");

    document
        .querySelectorAll(".product-add-to-cart-checkbox")
        .forEach((checkbox) => {
            const productId = +checkbox.dataset.id;
            const product = cart.find((item) => item.id === productId);

            if (product) checkbox.checked = product.isSelected;

            checkbox.addEventListener("change", function () {
                const productIndex = cart.findIndex(
                    (item) =>
                        item.id === productId &&
                        item.amount === this.dataset.amount
                );

                if (productIndex !== -1) {
                    cart[productIndex].isSelected = this.checked;

                    localStorage.setItem("cart", JSON.stringify(cart));

                    cart = JSON.parse(localStorage.getItem("cart"));

                    updateTotalPrice();

                    updateCheckoutButton(cartTotalBtn);
                }
            });
        });

    document
        .querySelectorAll(".product-quantity")
        .forEach((productQuantity) => {
            const productId = +productQuantity.dataset.id;
            const amount = productQuantity.dataset.amount;

            const product = cart.find(
                (item) => item.id === productId && item.amount === amount
            );

            if (product) productQuantity.textContent = product.quantity;
        });

    document
        .querySelectorAll(
            ".product-increase-quantity-btn, .product-decrease-quantity-btn"
        )
        .forEach((button) => {
            button.addEventListener("click", function () {
                const productId = +this.dataset.id;
                const amount = this.dataset.amount;

                const isIncrease = this.classList.contains(
                    "product-increase-quantity-btn"
                );

                const productIndex = cart.findIndex(
                    (item) => item.id === productId && item.amount === amount
                );

                if (productIndex !== -1) {
                    let quantity = cart[productIndex].quantity;

                    if (isIncrease) {
                        quantity++;
                    } else if (quantity > 1) {
                        quantity--;
                    }

                    cart[productIndex].quantity = quantity;

                    localStorage.setItem("cart", JSON.stringify(cart));

                    cart = JSON.parse(localStorage.getItem("cart"));

                    document.querySelector(
                        `.product-quantity[data-amount="${amount}"]`
                    ).textContent = quantity;

                    updateTotalPrice();
                }
            });
        });

    updateTotalPrice();
});

function updateTotalPrice(newCart = cart) {
    let totalPrice = 0;
    let totalQuantity = 0;

    newCart.forEach((item) => {
        if (item.isSelected) {
            totalPrice += item.quantity * item.price;
            totalQuantity += item.quantity;
        }
    });

    document.querySelector(".cart-total-price").textContent = totalPrice;
    document.querySelector(".cart-total-amount").textContent = totalQuantity;

    const products = JSON.parse(localStorage.getItem("cart")) || [];

    const selectedProducts = products.filter((item) => item.isSelected);

    document
        .getElementById("checkoutForm")
        .addEventListener("submit", function (event) {
            event.preventDefault();

            const form = event.target;
            const productsInput = form.querySelector('input[name="products"]');
            productsInput.value = JSON.stringify(selectedProducts);

            form.submit();
        });
}
