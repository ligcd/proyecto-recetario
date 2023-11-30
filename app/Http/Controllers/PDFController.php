<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredientes;
use App\Models\Recetas;
use PDF;

class PDFController extends Controller
{
    public function descargarRecetaPDF(Recetas $receta)
    {
    
        $ingredientes = $receta->ingredientes;
        $procedimientos = $receta->procedimientos;

        $pdf = new \TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 16);

        $pdf->SetTextColor(0, 0, 0);

        //títulos
        $this->escribirTitulo($pdf, 'Receta: ' . $receta->titulo);
        $this->escribirTitulo($pdf, 'Tipo de Comida: ' . $receta->tipoComida);
        $this->escribirTitulo($pdf, 'Descripción:');

        $pdf->SetFont('helvetica', '', 12);

    
        $pdf->MultiCell(0, 10, $receta->descripcion);
        $pdf->SetFont('helvetica', 'B', 16); 
        
        $this->escribirTitulo($pdf, 'Ingredientes:');

        //contenidooo
        foreach ($ingredientes as $ingrediente) {
            $pdf->SetFont('helvetica', '', 12);
            $this->escribirContenido($pdf, '- ' . $ingrediente->nombre . ': ' . $ingrediente->cantidad . ' ' . $ingrediente->unidadMedida);
        }

        //tituloo
        $this->escribirTitulo($pdf, 'Procedimientos:');

       
        $pdf->SetFont('helvetica', '', 12);

        //procedimientos
        foreach ($procedimientos as $procedimiento) {
            $pdf->MultiCell(0, 10, '- ' . $procedimiento->procedimiento);
        }

        //guarda el PDF 
        $pdfPath = storage_path('app/public/receta_' . $receta->id . '.pdf');
        $pdf->Output($pdfPath, 'F');

        return response()->download($pdfPath);
    }

    private function escribirTitulo($pdf, $texto)
    {
        $pdf->Ln(); 
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, $texto);
        $pdf->Ln(); 
    }

    private function escribirContenido($pdf, $texto)
    {
        $pdf->Cell(0, 10, $texto);
        $pdf->Ln(); 
    }
}

