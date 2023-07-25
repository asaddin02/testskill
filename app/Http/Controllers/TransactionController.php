<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function gettransaction()
    {
        $transactions = Transaction::paginate(5);
        return view('transaction', compact('transactions'));
    }

    public function searchtransaction(Request $request)
    {
        $search = $request->input('transaction_search');
        $transactions = Transaction::when($search, function ($query, $search) {
            return $query->where('reference_no', '%' . $search . '%')->orWhere('price', '%' . $search . '%')->orWhere('payment_amount', '%' . $search . '%');
        })->paginate(5);
        return view('transaction', compact('transactions'));
    }

    public function fetchReference()
    {
        $api_url = 'https://pay.saebo.id/test-dau/api/v1/transactions';
        $api_key = 'DATAUTAMA';
        $data = [
            'quantity' => 1,
            'price' => 1,
            'payment_amount' => 1,
        ];
        $client = new Client();
        $response = $client->post($api_url, [
            'headers' => [
                'X-API-KEY' => $api_key,
                'Content-Type' => 'application/json'
            ], "json" => $data
        ]);

        $response_body = $response->getBody()->getContents();
        $response_data = json_decode($response_body, true);
        $reference_no = $response_data['data']['reference_no'];
        return $reference_no;
    }

    public function apiTransaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
            'product_id' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $quantity = $request->input('quantity');
        $product_id = $request->input('product_id');
        $reference_no = $this->fetchReference();

        $queryProduct = Product::where('id',$product_id)->first();
        $price = $queryProduct->price;
        $payment_amount = $quantity * $price;

        $transactions = Transaction::create([
            'references_no' => $reference_no,
            'price' => $price,
            'quantity' => $quantity,
            'payment_amount' => $payment_amount,
            'product_id' => $product_id,
        ]);
        return response()->json([
            'code' => "20000",
            'message' => "OK",
            'data' => $transactions
        ]);
    }
}
