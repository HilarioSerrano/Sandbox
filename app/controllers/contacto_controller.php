<?php

/**
 * Controller para el envio de un formulario de contacto básico
 */
class ContactoController extends AppController
{
    protected function before_filter()
    {
        // Si es AJAX enviar solo el view
        if (Input::isAjax()) {
            View::template(null);
        }
    }

    public function contacto()
    {
        if (Input::hasPost('contacto')) {
            $aDatos = Input::post('contacto');
            $respuesta = (new Contacto)->sendEmail($aDatos);

            if ($respuesta) {
                Flash::valid('Mensaje enviado correctamente');
                return;
            }

            Flash::error('Mensaje NO enviado. Vuelva a probarlo más tarde');
        }
    }
}
