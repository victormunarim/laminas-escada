<?php

declare(strict_types=1);

namespace Pedidos\GeraPdf;

use Knp\Snappy\Pdf;
use Laminas\View\Helper\AbstractHelper;

class GeraPdf extends AbstractHelper
{
    public function __invoke($pedido, $cliente)
    {
        $pedidoObj = $pedido;
        $cliente   = $cliente[0];

        // Renderiza o HTML principal em arquivo temporário
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

        $headerHtml = "
<!DOCTYPE html>
<html>
<head>
  <meta charset='UTF-8'>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      font-size: 12px;
      background-color: #fff;
    }

    .logo {
      position: absolute;
      top: 0;
      left: 0;
      height: 200px;
      z-index: 10;
    }

    .caixa-borda {
      position: absolute;
      top: 35px;
      left: 20px;
      right: 20px;
      border-top: 2px solid #000;
      border-left: 2px solid #000;
      border-right: 2px solid #000;
      height: 180px;
      z-index: 1;
    }

    .topo {
      width: 100%;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      padding: 40px 30px 0px 150px;
      box-sizing: border-box;
      position: relative;
      z-index: 2;
    }

    .info {
      text-align: right;
      font-size: 26px;
      line-height: 1.4;
    }
  </style>
</head>
<body>
  <img src='file://" . __DIR__ . "/logo.png' class='logo'>

  <div class='caixa-borda'></div>

  <div class='topo'>
    <div class='info'>
      <div><strong>Pedido Nº:</strong> {$pedidoObj->getNumeroPedido()}</div>
      <div>Escadas Munarim LTDA<br>CNPJ 00.000.000/0000-00</div>
    </div>
  </div>
</body>
</html>
";
        $headerPath = __DIR__ . '/header_tmp.html';
        file_put_contents($headerPath, $headerHtml);
        $headerUrl = 'file://' . realpath($headerPath);

        // Footer
        $footerHtml = "
<!DOCTYPE html>
<html>
<head>
  <meta charset='UTF-8'>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      font-size: 14px;
      color: #fff;
      background-color: #2A4361;
      text-align: center;
    }
    .footer {
      padding: 8px 0;
    }
  </style>
</head>
<body>
  <div class='footer'>
    RUA TREZE DE JUNHO, 893 - FLOR DE NÁPOLIS · CEP 88.106-470 · SÃO JOSÉ - SANTA CATARINA
  </div>
</body>
</html>
";
        $footerPath = __DIR__ . '/footer_tmp.html';
        file_put_contents($footerPath, $footerHtml);
        $footerUrl = 'file://' . realpath($footerPath);

        $options = [
            'margin-top' => '30mm',
            'margin-right' => '0mm',
            'margin-bottom' => '7mm',
            'margin-left' => '0mm',
            'header-html' => $headerUrl,
            'footer-html' => $footerUrl,
            'print-media-type' => true,
            'enable-local-file-access' => true,
            'no-stop-slow-scripts' => true,
            'load-error-handling' => 'ignore'
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
