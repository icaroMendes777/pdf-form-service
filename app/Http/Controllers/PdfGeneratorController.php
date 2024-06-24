<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF
as TCPDFFacade;
use Illuminate\Support\Facades\Storage;

class PdfGeneratorController extends Controller
{


    public function generate(Request $request)
    {

        $pdf = new \TCPDF();

        $pdf->SetTitle('Fillable Form');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Title
        $pdf->Cell(0, 10, 'Fillable Form', 0, 1, 'C');


        $fields = $request['fields'];

        foreach ($fields as $field) {
            $pdf->Cell(0, 10, $field . ": ", 0, 1);
            $pdf->TextField($field, 50, 10, array('multiline' => false));
            $pdf->Ln(20);
        }

        $pdfContent = $pdf->Output('', 'S');

        Storage::put('file.jpg', $pdfContent);

        $url = Storage::url('file.jpg');

        return ([
            'url' => $url
        ]);
    }
}
