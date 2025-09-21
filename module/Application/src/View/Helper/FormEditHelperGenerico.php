<?php

declare(strict_types=1);

namespace Application\View\Helper;

use Laminas\Form\Form;
use Laminas\View\Helper\AbstractHelper;

abstract class FormEditHelperGenerico extends AbstractHelper
{
    public function __invoke(Form $form, string $title, string $route, ?int $id = null): string
    {
        $this->prepareForm($form, $route, $id);

        $html  = '<h1>' . $this->getView()->escapeHtml($title) . '</h1>';
        $html .= $this->getView()->form()->openTag($form);

        foreach ($form as $element) {
            $type = $element->getAttribute('type');

            if ($type === 'hidden') {
                $html .= $this->getView()->formElement($element);
                continue;
            }

            if ($type === 'submit') {
                $element->setAttribute('class', 'btn btn-primary');
                $element->setAttribute('value', 'Salvar');
                $html .= '<div class="mt-3">';
                $html .= $this->getView()->formSubmit($element);
                $html .= '</div>';
                continue;
            }

            $element->setAttribute('class', 'form-control');

            $html .= '<div class="form-group row mb-3">';
            $html .= '<div class="col-sm-6 col-md-4">';
            $html .= $this->getView()->formLabel($element);
            $html .= $this->getView()->formElement($element);
            $html .= $this->getView()->formElementErrors()
                ->render($element, ['class' => 'help-block text-danger']);
            $html .= '</div></div>';
        }

        $html .= $this->getView()->form()->closeTag();

        return $html;
    }

    abstract protected function prepareForm(Form $form, string $route, ?int $id): void;
}
