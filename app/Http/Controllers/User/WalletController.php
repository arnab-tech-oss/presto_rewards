<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class WalletController extends Controller
{
    public function show()
    {

        $id = auth('sanctum')->user()->id;
        $data = Wallet::where('customer_id', $id)->first();
        return response()->json(responseData($data,"wallet balance show"));
    }

    public function transaction()
    {
        $id = auth('sanctum')->user()->id;
        $data = Wallet::where('customer_id', $id)->first();
        $walletid = $data->id;
        $tansaction = WalletTransaction::where('wallet_id', $walletid)->orderBy('created_at', 'desc')->get();
        return response()->json(responseData($tansaction));
    }

    // public function add(Request $request)
    // {
    //     $data = $request->all();
    //     $save = Wallet::create($data);

    //     if($save){
    //         return response()->json(responseData(null,"data added successfully"));
    //     }

    // }

    public function debit(Request $request)
    {
        $id = auth('sanctum')->user()->id;
        $validatedata = Validator::make($request->all(), [
            'paymenttype' => 'required',
            'amount' => 'required',
        ]);

        if ($validatedata->fails()) {
            $message = $validatedata->errors();
            return response()->json(responseData(null, $message, false));
        } else {
            $data = Wallet::where('customer_id', $id)->first();
            if ($request->paymenttype == 'cr') {
                $data->balance = $data->balance + $request->amount;
                $data->lifetime_credit = $data->lifetime_credit + $request->amount;
                $data->update($data->toarray());
            } elseif ($request->paymenttype == 'dr') {
                $data->balance = $data->balance - $request->amount;
                $data->lifetime_debit = $data->lifetime_debit + $request->amount;
                $data->update($data->toarray());
            }

            if ($data->update()) {
                $currentDate = date('Ymd');
                $randomNumber = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
                $ref_no = substr($currentDate, 0, 5) . $request->amount . $randomNumber;
                $trans = WalletTransaction::create([
                    'wallet_id' => $data->id,
                    'transactiontype' => $request->paymenttype,
                    'amount' => $request->amount,
                    'description' => $request->paymenttype == 'dr' ? 'This is a debit' : 'This is a credit',
                    'date' => Carbon::now(),
                    'refference_no' => $ref_no,
                    'source' => "tobank",
                ]);
            }
        }
        if ($trans) {
            $amt = Wallet::where('customer_id', $id)->first();
            return response()->json(responseData($amt, "transaction successfull"));
        } else {
            return response()->json(responseData(null, "something went wrong", false));
        }
    }
}
