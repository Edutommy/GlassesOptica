<?php

namespace controllers;

use models\RecetaModel as RecetaModel;

require_once("../models/RecetaModel.php");
require_once("tcpdf_include.php");

class ExportarPDF
{
    public $id;

    public function __construct()
    {
        $this->id = $_GET['id'];
    }
    public function generarPDF()
    {
        $model = new RecetaModel();
        $arr = $model->recetasXId($this->id);
        $receta = $arr[0];

        /*LLAMAR A LA LIBRERIA*/
        // create new PDF document
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Glasses Optica');
        $pdf->SetTitle('Reporte de Receta ' . $receta['id']);
        $pdf->SetSubject('Reporte de Glasses Optica');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Glasses Optica', 'Reporte Receta ' . $receta['nombre_cliente'], array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        // Set some content to print
        $html = '
        <h1 style="color:#6495ed">Reporte de Receta ID ' . $receta['id'] . '</h1>
        <table border="1" style="color:#6495ed">
            <tr>
                <th>Cliente</th>
                <td>' . $receta['nombre_cliente'] . '</td>
            </tr>
            <tr>
                <th>RUT</th>
                <td>' . $receta['rut_cliente'] . '</td>
            </tr>
            <tr>
                <th>Teléfono</th>
                <td>' . $receta["telefono_cliente"] . '</td>
            </tr>
        </table>
        <h5 style="color:#6495ed">Tipo Lente: ' . $receta["tipo_lente"] . '</h5>
        <table border="1" style="color:#6495ed">
            <tr>
                <th>Armazón</th>
                <th>Material Cristal</th>
                <th>Tipo Cristal</th>
            </tr>
            <tr>
                <td>' . $receta["armazon"] . '</td>
                <td>' . $receta["material_cristal"] . '</td>
                <td>' . $receta["tipo_cristal"] . '</td>
            </tr>
        </table>
        <h5 style="color:#6495ed">Base: ' . $receta["base"] . '</h5>
        <table border="1" style="color:#6495ed">
            <tr>
                <th>Cilindro Ojo Derecho</th>
                <th>Cilindro Ojo Izquierdo</th>
            </tr>
            <tr>
                <td>' . $receta["cilindro_od"] . '</td>
                <td>' . $receta["cilindro_oi"] . '</td>
            </tr>
        </table>
        <h6 style="color:#6495ed">Distancia Pupilar: ' . $receta["distancia_pupilar"] . '</h6>
        <table border="1" style="color:#6495ed">
            <tr>
                <th></th>
                <th>Eje</th>
                <th>Esfera</th>
            </tr>
            <tr>
                <td>Ojo Izquierdo</td>
                <td>' . $receta["eje_oi"] . '</td>
                <td>' . $receta["esfera_oi"] . '</td>
            </tr>
            <tr>
                <td>Ojo Derecho</td>
                <td>' . $receta["eje_od"] . '</td>
                <td>' . $receta["esfera_od"] . '</td>
            </tr>
        </table>
        <h6 style="color:#6495ed">Observación: ' . $receta["observacion"] . '</h6>
        <table border="1" style="color:#6495ed">
            <tr>
                <th>Fecha Entrega</th>
                <th>Fecha Retiro</th>
            </tr>
            <tr>
                <td>' . $receta["fecha_entrega"] . '</td>
                <td>' . $receta["fecha_retiro"] . '</td>
            </tr>
        </table>
        <h5></h5>
        <table border="1" style="color:#00008b">
            <tr>
                <th>Vendedor</th>
                <th>Precio</th>
            </tr>
            <tr>
                <td>' . $receta["nombre_vendedor"] . '</td>
                <td>$' . $receta["precio"] . '</td>
            </tr>
        </table>
        
        ';

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('reporte.pdf', 'I');
        /*FIN DE LA LIBRERIA*/
    }
}
$obj = new ExportarPDF();
$obj->generarPDF();
