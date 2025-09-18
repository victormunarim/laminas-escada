<?php

declare(strict_types=1);

namespace Application\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Pedidos\Form\PesquisaForm;

class BarraPesquisaHelperGenerica extends AbstractHelper
{
    /**
     * @param array<string, mixed> $opcoes
     */
    public function __invoke(PesquisaForm $pesquisaForm): string
    {
        $view = $this->getView();

        foreach ($pesquisaForm as $element) {
            $type = $element->getAttribute('type');

            if ($type !== 'hidden' && $type !== 'submit') {
                $element->setAttribute('class', 'form-control');
            }
        }

        $pesquisaForm->prepare();

        $html = $view->form()->openTag($pesquisaForm);

        $html .= '<div class="d-flex flex-wrap gap-4 align-items-end">';

        foreach ($pesquisaForm as $element) {
            $html .= '<div>';
            $html .= '<h6 style="font-family: var(--bs-body-font-family); font-weight: bold;">'
                . $element->getLabel()
                . '</h6>'
            ;
            $html .= $view->formElement($element);
            $html .= $view->formElementErrors()->render($element, ['class' => 'help-block']);
            $html .= '</div>';
        }

        $html .= '</div>';
        $html .= $view->form()->closeTag();

        return $html;
    }
}
