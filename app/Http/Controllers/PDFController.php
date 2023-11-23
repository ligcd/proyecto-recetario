<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recetas;
use PDF;

class PDFController extends Controller
{
    public function descargarRecetaPDF(Recetas $receta)
    {
        // Código para generar el PDF con TCPDF
        $pdf = new \TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(40, 10, 'Receta: ' . $receta->titulo);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Descripción: ' . $receta->descripcion);
        $pdf->Ln(); // Salto de línea
        $pdf->Cell(40, 10, 'Tipo de Comida: ' . $receta->tipoComida);
        $pdf->Ln(); 
        $imgPath = storage_path('app/public/img_recetas' . $receta->archivo_ubicacion);

        // Agregar la imagen al PDF
        $pdf->Image($imgPath);

    
        // Guarda el PDF en la carpeta storage/app/public/pdf
        $pdfPath = storage_path('app/public/pdf-recetas/receta_' . $receta->id . '.pdf');
        $pdf->Output($pdfPath, 'F');


        return response()->download($pdfPath);
    }
}
