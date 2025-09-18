<?php

declare(strict_types=1);

namespace Application\View\Helper;

use Laminas\Form\Form;
use Laminas\View\Helper\AbstractHelper;

class FormAddHelperGenerico extends AbstractHelper
{
    public function __invoke(
        Form $form,
        string $title,
        string $route
    ): string {
        $view = $this->getView();

        $form->setAttribute('action', $view->url($route, ['action' => 'add']));

        foreach ($form as $element) {
            $type = $element->getAttribute('type');

            if ($type !== 'hidden' && $type !== 'submit') {
                $element->setAttribute('class', 'form-control');
            }

            if ($type === 'submit') {
                $element->setAttribute('class', 'btn btn-primary');
            }
        }

        $form->prepare();

        $html = '<h1>' . $view->escapeHtml($title) . '</h1>';
        $html .= $view->form()->openTag($form);

        foreach ($form as $element) {
            $type = $element->getAttribute('type');

            if ($type === 'hidden') {
                $html .= $view->formElement($element);
                continue;
            }

            if ($type === 'submit') {
                $html .= '<div class="mt-3">';
                $html .= $view->formSubmit($element);
                $html .= '</div>';
                continue;
            }

            $html .= '<div class="form-group row mb-3">';
            $html .= '<div class="col-sm-6 col-md-4">';
            $html .= '<h6 style="font-family: var(--bs-body-font-family); font-weight: bold;">'
                . $element->getLabel()
                . '</h6>'
            ;
            $html .= $view->formElement($element);
            $html .= $view->formElementErrors()->render($element, ['class' => 'help-block']);
            $html .= '</div></div>';
        }

        $html .= $view->form()->closeTag();

        return $html;
    }
}
