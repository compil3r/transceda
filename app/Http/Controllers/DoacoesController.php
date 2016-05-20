<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use laravel\pagseguro\Platform\Laravel5\PagSeguro;
use laravel\pagseguro\Checkout\Information\Information;
use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Credentials\Credentials;
use laravel\pagseguro\Checkout\Facade\CheckoutFacade;

class DoacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
public function info() {
    $code = '8D1FFE6FDF9A4CFF935D07A82032F345';
    $credentials = PagSeguro::credentials()->get();
    $transaction = PagSeguro::transaction()->get($code, $credentials);
    $information = $transaction->getInformation();
    print_r($information);
}



public function doar(Request $request) {

  $data = [
    'items' => [
        [
            'id' => '1',
            'description' => 'Doacao',
            'quantity' => '1',
            'amount' => '41.15',
            'weight' => '0',
            'shippingCost' => '0',
            'width' => '0',
            'height' => '0',
            'length' => '0',
        ],
    ],
    'shipping' => [
        'address' => [
            'postalCode' => '92200540',
            'street' => 'Rua Leonardo Arruda',
            'number' => '12',
            'district' => 'Jardim dos Camargos',
            'city' => $request->get('cidade'),
            'state' => $request->get('estado'),
            'country' => 'BRA',
        ],
        'type' => 2,
        'cost' => 0,
    ],
    'sender' => [
        'email' => $request->get('email'),
        'name' => $request->get('nome'),
        'documents' => [
            [
                'number' => '01234567890',
                'type' => 'CPF'
            ]
        ],
        'phone' => '11985445522',
        'bornDate' => '1988-03-21',
    ]
];
    $facade = new CheckoutFacade();
    $credentials = PagSeguro::credentials()->get();
    $checkout = $facade->createFromArray($data);
    $information = $checkout->send($credentials);

if ($information) {
    return redirect($information->getLink());
    /*print_r($information->getDate());
    print_r($information->getCode());*/
  }
    }
}
