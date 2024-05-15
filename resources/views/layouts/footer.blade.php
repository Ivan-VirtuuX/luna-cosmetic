<footer style="position: fixed; bottom: 0;">
    <div class="footer-top">
        <div
            class="{{isset($container)  ? 'welcome-container' : 'container'}} d-flex justify-content-between align-items-center footer-content">
            <span class="logo">LUNA</span>
            <ul class="footer-links d-flex">
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
        </div>
    </div>
    <div class="{{isset($container)  ? 'welcome-container' : 'container'}}">
        <div class="footer-bottom d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center column-gap-1">
                <span>LUNA</span>
                <img src="/svg/copyright-icon.svg" alt="copyright">
                <span>2024 Все права защищены</span>
            </div>
        </div>
    </div>
</footer>
