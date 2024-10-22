<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Xử lý thanh toán và lưu vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'user_id' => 'required',
            'booking_id' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string'
        ]);
        // Lưu thông tin thanh toán vào cơ sở dữ liệu
        $payment = Payment::create([
            'user_id' => $request->user_id,
            'booking_id' => $request->booking_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status
        ]);

        return response()->json($payment, 201);
    }
}
