document.addEventListener("DOMContentLoaded", function () {
    const radios = document.querySelectorAll('input[type="radio"]');

    radios.forEach((radio) => {
        radio.addEventListener("change", function () {
            updatePrice();

            updateCartButton();

            const cart = JSON.parse(localStorage.getItem("cart")) || [];

            const productInCart = cart.some(
                (item) => item.amount === getSelectedAmount().amount
            );

            const addToCartButton = document.getElementById("addToCartButton");

            if (productInCart) {
                addToCartButton.textContent = "Удалить из корзины";
            } else {
                addToCartButton.textContent = "Добавить в корзину";
            }
        });
    });

    updatePrice();

    const productId =
        document.getElementById("addToCartButton").dataset.productid;

    checkProductInCart(+productId);
});

function checkProductInCart(productId) {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const productInCart = cart.some((item) => item.id === productId);

    const addToCartButton = document.getElementById("addToCartButton");

    if (productInCart) addToCartButton.textContent = "Удалить из корзины";
    else addToCartButton.textContent = "Добавить в корзину";
}

function toggleCartItem(button, id, title, desc, imageUrl, amount_info) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    const productIndex = cart.findIndex(
        (item) => item.id === id && item.amount === amount_info.amount
    );

    if (productIndex > -1) {
        cart.splice(productIndex, 1);

        button.textContent = "Добавить в корзину";

        if (window.Auth) {
            fetch(
                `/cart/remove-product?product_id=${id}&amount=${amount_info.amount}`,
                {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                }
            )
                .then((response) => response.json())
                .then((data) => console.log(data.message));
        }
    } else {
        cart.push({
            id,
            title,
            desc,
            amount: amount_info.amount,
            price: amount_info.price,
            quantity: 1,
            imageUrl,
            isSelected: false,
        });

        button.textContent = "Удалить из корзины";

        if (window.Auth) {
            fetch(`/cart/add-product?product_id=${id}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    id,
                    title,
                    desc,
                    amount: amount_info.amount,
                    price: amount_info.price,
                    quantity: 1,
                }),
            }).then((response) => response.json());
        }
    }

    localStorage.setItem("cart", JSON.stringify(cart));
}

function updateCartButton(productInCart) {
    const button = document.getElementById("addToCartButton");

    if (productInCart) button.textContent = "Удалить из корзины";
    else button.textContent = "Добавить в корзину";
}

const getSelectedAmount = () => {
    const selectedAmount = document.querySelector(
        'input[name="amount"]:checked'
    );

    console.log(+selectedAmount.dataset.price);

    return {
        amount: selectedAmount.dataset.amount,
        price: +selectedAmount.dataset.price,
    };
};

const updatePrice = () => {
    const form = document.querySelector(".product-info-form");
    const selectedRadio = form.querySelector('input[type="radio"]:checked');

    document.getElementById("price").textContent = selectedRadio
        ? selectedRadio.getAttribute("data-price")
        : "0";
};

const populateCartItems = () => {
    document.getElementById("cart_items").value = localStorage.getItem("cart");
};
