<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Contact;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $contacts = Contact::all();

        $pdf = Pdf::loadView('pdf.contacts', compact('contacts'));
        return $pdf->download('kontaktai.pdf');
    }
}
