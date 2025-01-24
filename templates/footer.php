<footer class="d-flex">
    <section class="d-flex space-between">
        <div id="socialNetworkWrap" class="d-flex space-between align-center">
            <h3><a href="#" target="_blank">INSTAGRAM</a></h3>
            <h3><a href="#" target="_blank">FACEBOOK</a></h3>
            <h3><a href="#">TIK TOK</a></h3>
            <h3><a href="#" target="_blank">WHATSAPP</a></h3>
        </div>
        <div class="menuMainWrap d-flex align-center space-between">
            <div id="menuFooterWrap" class="d-flex space-between">
                <ul>
                    <li><a href="/contacto">Contacto</a></li>
                    <li><a href="">Política de privacidad</a></li>
                    <li><a href="">Aviso legal y Cookies</a></li>
                    <li><a href="">Envíos y devoluciones</a></li>
                </ul>
                <ul>
                    <li><a href="#">La madriguera</a></li>
                    <li><a href="#">Calzado respetuoso</a></li>
                    <li><a href="#">Marcas</a></li>
                    <li><a href="#">Nuestro compromiso</a></li>
                </ul>
                <ul>
                    <?php footer_categorias($con) ?>
                </ul>
            </div>
            <div>
                <img id="logoFooter" src="/media/logo.PNG" alt="La madriguera logo" title="La madriguera logo, productos respetuosos">
            </div>
        </div>
        <div>
            <p id="copyFooter">&copy; <span id="copyYear">2025</span> La madriguera. Todos los derechos reservados.</p>
        </div>
    </section>
</footer>