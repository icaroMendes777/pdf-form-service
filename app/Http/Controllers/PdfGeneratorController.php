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
        // Set document information
        // $pdf->SetCreator(PDF_CREATOR);
        // $pdf->SetAuthor('Your Name');
        // $pdf->SetTitle('Fillable Form');
        // $pdf->SetSubject('Fillable PDF Form');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Title
        $pdf->Cell(0, 10, 'Fillable Form', 0, 1, 'C');

        // Name field

        $fields = $request['fields'];

        foreach ($fields as $field) {
            $pdf->Cell(0, 10, $field . ": ", 0, 1);
            $pdf->TextField($field, 50, 10, array('multiline' => false));
            $pdf->Ln(20);
        }


        //Storage::put('file.jpg', $contents);

        // Output the PDF to a string
        $pdfContent = $pdf->Output('', 'S');


        Storage::put('file.jpg', $pdfContent);

        $url = Storage::url('file.jpg');

        return ([
            'url' => $url
        ]);



        // $filePath = 'fillable_form.pdf';

        // // Upload to S3
        // Storage::disk('s3')->put($filePath, $pdfContent);

        // // Generate a presigned URL for the uploaded PDF
        // $s3 = Storage::disk('s3');
        // $url = $s3->url($filePath);

        // // Return the URL or initiate a download response
        // return response()->json(['url' => $url]);

        // // Output the PDF as a file
        // $pdf->Output(public_path('fillable_form.pdf'), 'F');

        // return response()->download(public_path('fillable_form.pdf'));
    }
}
