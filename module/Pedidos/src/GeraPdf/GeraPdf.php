<?php

declare(strict_types=1);

namespace Pedidos\GeraPdf;

use Knp\Snappy\Pdf;
use Laminas\View\Helper\AbstractHelper;

class GeraPdf extends AbstractHelper
{
    public function __invoke($pedido, $cliente)
    {
        ob_start();
        $pedidoObj = $pedido;
        $cliente = $cliente[0];
        include __DIR__ . "/pedidoPDF.html";
        $html = ob_get_clean();

        $snappy = new Pdf('/usr/bin/wkhtmltopdf');
        $snappy->setOption('enable-local-file-access', true);

        $options = [
            'margin-top'    => '0mm',
            'margin-right'  => '0mm',
            'margin-bottom' => '0mm',
            'margin-left'   => '0mm',
        ];

        try {
            $output = $snappy->getOutputFromHtml($html, $options);
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="teste.pdf"');
            echo $output;
            exit;
        } catch (\Exception $e) {
            echo "❌ Erro ao gerar PDF: " . $e->getMessage();
        }
    }
}
