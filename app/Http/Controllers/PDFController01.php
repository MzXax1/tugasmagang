<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use PDF;

class PDFController01 extends Controller
{
    public function generatePDF($id)
    {
        $product = Product::findOrFail($id);

        $data = [
            'title' => 'Data Product',
            'date' => date('m/d/Y'),
            'product' => $product,
        ];

        $pdf = PDF::loadView('prodPDF', $data);
        $pdf ->set_option('isRemoteEnabled', true);

        return $pdf->stream('ProductShow.pdf');
    }
}
