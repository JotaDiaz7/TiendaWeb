<div id="estadoWrap" class="d-flex mb30">
    <div>
        <?php if ($dates['estado'] != "Cancelada") { ?>
            <a target="_blank" href="/factura-devolucion/<?= $devolucion ?>" id="factura" class="d-flex align-center">
                <svg width="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g stroke-width="0" />
                    <g stroke-linecap="round" stroke-linejoin="round" />
                    <g>
                        <path d="M21 6V3.50519C21 2.92196 20.3109 2.61251 19.875 2.99999C19.2334 3.57029 18.2666 3.57029 17.625 2.99999C16.9834 2.42969 16.0166 2.42969 15.375 2.99999C14.7334 3.57029 13.7666 3.57029 13.125 2.99999C12.4834 2.42969 11.5166 2.42969 10.875 2.99999C10.2334 3.57029 9.26659 3.57029 8.625 2.99999C7.98341 2.42969 7.01659 2.42969 6.375 2.99999C5.73341 3.57029 4.76659 3.57029 4.125 2.99999C3.68909 2.61251 3 2.92196 3 3.50519V14M21 10V20.495C21 21.0782 20.3109 21.3876 19.875 21.0002C19.2334 20.4299 18.2666 20.4299 17.625 21.0002C16.9834 21.5705 16.0166 21.5705 15.375 21.0002C14.7334 20.4299 13.7666 20.4299 13.125 21.0002C12.4834 21.5705 11.5166 21.5705 10.875 21.0002C10.2334 20.4299 9.26659 20.4299 8.625 21.0002C7.98341 21.5705 7.01659 21.5705 6.375 21.0002C5.73341 20.4299 4.76659 20.4299 4.125 21.0002C3.68909 21.3876 3 21.0782 3 20.495V18" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M7.5 15.5H11.5M16.5 15.5H14.5" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M16.5 12H12.5M7.5 12H9.5" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M7.5 8.5H16.5" stroke="#222222" stroke-width="1.5" stroke-linecap="round" />
                    </g>
                </svg>
                Generar factura
            </a>
        <?php } ?>
    </div>
    <div class="d-flex space-end">
        <span class="estado <?= $dates['estado'] ?>"></span>
        <?php if ($rol != 0 && $dates['estado'] != "Cancelada" && $dates['estado'] != "Completada") { ?>
            <div class="estados">
                <ul>
                    <li>
                        <?= $dates['estado'] ?>
                    </li>
                    <li>
                        <a href="/controllers/devoluciones/estado_devolucion_controller.php?devolucion=<?= $devolucion ?>&estado=Pendiente">Pendiente</a>
                    </li>
                    <li>
                        <a href="/controllers/devoluciones/estado_devolucion_controller.php?devolucion=<?= $devolucion ?>&estado=Recogida">Recogida</a>
                    </li>
                    <li>
                        <a href="/controllers/devoluciones/estado_devolucion_controller.php?devolucion=<?= $devolucion ?>&estado=Revisión">Revisión</a>
                    </li>
                    <li>
                        <a href="/controllers/devoluciones/estado_devolucion_controller.php?devolucion=<?= $devolucion ?>&estado=Completada">Completada</a>
                    </li>
                </ul>
            </div>
            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path d="M19 9L12 15L10.25 13.5M5 9L7.33333 11" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </g>
            </svg>
        <?php } else { ?>
            <div class="d-flex space-end estadoPedido">
                <?= $dates['estado'] ?>
            </div>
        <?php } ?>
    </div>
</div>