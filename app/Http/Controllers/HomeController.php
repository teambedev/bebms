<?php

namespace App\Http\Controllers;

use App\Client;
use App\Company;
use App\Module;
use App\Product;
use App\Remark;
use Milon\Barcode\DNS2D;
use PDF;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     *
     */
    public function pdf(Request $request)
    {
        $data = array();
        //$value = sprintf( '%08d', 1234567 );
        //dd($request->invoice_number);
        $data['company'] = Company::find(1);
        $data['client'] = Client::find($request->client);
        $data['remark'] = Remark::find($request->remark);
        $data['invoice_date'] = $request->invoice_date;
        $data['items'] = array();
        $data['invoice_number'] = $request->invoice_number;
        $data['total_price'] = 0;
        foreach ($request->product as $key => $product){
            if(in_array($product, Product::pluck('code')->toArray())){
                $items['product'] = Product::where('code', $product)->first();
                $items['module'] = Module::find($request->module[$key]);
                $items['amount'] = $request->amount[$key];
                $items['price_per_unit'] = $request->price[$key];
                $items['price'] = $items['amount']*$items['price_per_unit'];

                $data['total_price'] += $items['price'];
                $data['items'][] = $items;
            }
        }

        $code = "HRVHUB30\r
HRK\r
000000000012355\r
ZELJKO SENEKOVIC\r
IVANECKA ULICA 125\r
42000 VARAZDIN\r
2DBK d.d.\r
ALKARSKI PROLAZ 13B\r
21230 SINJ\r
HR1210010051863000160\r
HR01\r
7269-68949637676-00019\r
COST\r
Troskovi za 1. mjesec\r";

        $data['barcode'] = DNS2D::getBarcodePNG($code, "PDF417");

        $pdf = PDF::loadView('pdf.invoice', array('data' => $data));
        return $pdf->download('invoice.pdf');
    }
}
