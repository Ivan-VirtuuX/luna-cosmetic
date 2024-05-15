<header class="d-flex align-items-center">
    <div class="{{isset($container) ? 'welcome-container' : 'container'}}">
        <div class="header-inner d-flex align-items-center justify-content-between">
            <a href="/" class="logo">
                <span>LUNA</span>
            </a>
            <ul class="header-links d-flex">
                <li>
                    <a href="{{route('product.index')}}">Продукция</a>
                </li>
                <li>
                    <a href="{{route('about')}}">О нас</a>
                </li>
                <li>
                    <a href="/#contacts">Контакты</a>
                </li>
            </ul>
            <nav class="d-flex align-items-center">

                <div class="d-flex align-items-center column-gap-4">
                    <a href="{{auth()->check() ? route('profile') : route('login')}}">
                        <img src="/svg/user-icon.svg" alt="user icon">
                    </a>
                    <a href="{{route('cart')}}">
                        <img src="/svg/cart-icon.svg" alt="cart icon">
                    </a>
                </div>
            </nav>
            <div class="burger-menu" id="burgerMenu">
                <div class="burger-bar"></div>
                <div class="burger-bar"></div>
                <div class="burger-bar"></div>
            </div>
        </div>
    </div>
    <div class="mobile-menu" id="mobileMenu">
        <ul class="mobile-links">
            <li>
                <a href="{{route('product.index')}}">Продукция</a>
            </li>
            <li>
                <a href="{{route('about')}}">О нас</a>
            </li>
            <li>
                <a href="/#contacts">Контакты</a>
            </li>
            <li>
                <a href="{{auth()->check() ? route('profile') : route('login')}}">
                    Профиль
                </a>
            </li>
            <li>
                <a href="{{route('cart')}}">
                    Корзина
                </a>
            </li>
        </ul>
    </div>
</header>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const burgerMenu = document.getElementById("burgerMenu");
        const mobileMenu = document.getElementById("mobileMenu");

        burgerMenu.addEventListener("click", function () {
            mobileMenu.classList.toggle("active");
        });
    });
</script>

