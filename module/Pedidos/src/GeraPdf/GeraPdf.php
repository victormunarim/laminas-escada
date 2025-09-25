<?php

declare(strict_types=1);

namespace Pedidos\GeraPdf;

use Knp\Snappy\Pdf;
use Laminas\View\Helper\AbstractHelper;

class GeraPdf extends AbstractHelper
{
    public function __invoke($pedido)
    {
        $pedidoObj = $pedido;

        ob_start();
        include __DIR__ . "/pedidoPDF.html";
        $html = ob_get_clean();

        $bodyPath = __DIR__ . '/body_tmp.html';
        file_put_contents($bodyPath, $html);
        $bodyUrl = 'file://' . realpath($bodyPath);

        $tmpDir = __DIR__ . '/tmp_snappy';
        if (! is_dir($tmpDir)) {
            mkdir($tmpDir, 0777, true);
        }
        putenv("TMPDIR=" . $tmpDir);

        $snappy = new Pdf('/usr/local/bin/wkhtmltopdf');
        $snappy->setTemporaryFolder($tmpDir);

        $headerUrl = 'file://' . realpath(__DIR__ . '/header.html');
        $footerUrl = 'file://' . realpath(__DIR__ . '/footer.html');

        $options = [
            'margin-top' => '38mm',
            'margin-right' => '0mm',
            'margin-bottom' => '10mm',
            'margin-left' => '0mm',
            'page-size' => 'A4',
            'header-html' => $headerUrl,
            'footer-html' => $footerUrl,
            'print-media-type' => true,
            'enable-local-file-access' => true,
            'no-stop-slow-scripts' => true,
            'load-error-handling' => 'ignore',
            'disable-smart-shrinking' => true,
            'dpi' => 300,
            'no-background' => false
        ];

        try {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="pedido.pdf"');
            echo $snappy->getOutput($bodyUrl, $options);
            exit;
        } catch (\Exception $e) {
            echo "Erro ao gerar PDF: " . $e->getMessage();
        }
    }
}
