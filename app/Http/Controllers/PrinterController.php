<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PrinterController extends Controller
{
    public function getPrinters(){
        $response = Http::get('http://127.0.0.1:8000/api/printers');

        $printers = explode('|', $response['response']);
        return view('printers.index', ['printers' => $printers]);
    }

    public function showPrint(){
        return view('printers.print_raw');
    }


    public function setPrinter(Request $request){
        $printer = $request->printer;

        $response = Http::post("http://127.0.0.1:8000/api/set-printer/$printer");
        // Session::put('selected_printer', $request->printer);
        // Check if the request was successful
        if ($response->successful()) {
            return redirect()->back()->with('success', "Printer set successfully");
          } else {
            // If not successful, return an error response
            return response()->json(['message' => 'Failed to set printer'], $response->status());
        }
    }

    public function printRaw(Request $request)
    {
        // Validate the request data
        $request->validate([
            'raw_data' => 'required|string',
        ]);

        // Get the raw data from the request
        $rawData = $request->input('raw_data');

        $response = Http::get('http://127.0.0.1:8000/api/print-raw', [
            'raw_data' => $rawData,
        ]);
        if ($response->successful()) {
            return redirect()->back()->with('success', "Printing successfully");
          } else {
            // If not successful, return an error response
            return response()->json(['message' => 'Failed to set printer'], $response->status());
        }
    }
}
