<?php
    //Mostramos errores en caso de los haya
        if (isset($_SESSION['errores'])) {
            echo <<< TEXTO
            <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            {$_SESSION['errores']}
            </div>
            TEXTO;
            unset($_SESSION['errores']);
        }