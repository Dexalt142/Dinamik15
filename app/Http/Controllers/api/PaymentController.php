<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function getPaymentInfo() {

        $payment = auth()->user()->team ? auth()->user()->team->payment : null;

        return response()->json([
            'status' => 200,
            'message' => 'Fetch success',
            'payment' => $payment
        ]);

    }

    public function uploadPayment(Request $request) {

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'file' => ':attribute harus berbentuk file',
            'mimes' => 'Format yang diperbolehkan hanya JPEG dan PNG',
            'max' => ':attribute tidak boleh lebih besar dari 2MB'
        ];

        $attributes = [
            'nama_pengirim' => 'Nama pengirim',
            'bukti_pembayaran' => 'Bukti pembayaran'
        ];

        $validator = Validator::make($request->all(), [
            'nama_pengirim' => 'required',
            'bukti_pembayaran' => 'required|file|mimes:jpeg,png|max:2048'
        ], $messages, $attributes);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'The given data was invalid',
                'error' => $validator->errors()
            ], 422);
        }

        if(!auth()->user()->team->payment) {
            $team = auth()->user()->team;
            $filename = sha1(Carbon::now()->format('d/m/y-H:i:s').Str::random(10).'_'.$team->name).'.'.$request->file('bukti_pembayaran')->extension();
            $path = Storage::disk('pembayaran')->putFileAs('', $request->file('bukti_pembayaran'), $filename);

            $payment = Payment::make([
                'file_name' => $path,
                'nama_pengirim' => $request->input('nama_pengirim'),
                'status_upload_bukti' => '1',
                'status_verifikasi' => '0',
                'team_id' => $team->id
            ]);

            $payment->save();

        } else {
            $team = auth()->user()->team;
            $payment = $team->payment;
            if($payment->status_verifikasi == '1') {
                $filename = sha1(Carbon::now()->format('d/m/y-H:i:s').Str::random(10).'_'.$team->name).'.'.$request->file('bukti_pembayaran')->extension();
                $path = Storage::disk('pembayaran')->putFileAs('', $request->file('bukti_pembayaran'), $filename);
    
                $payment->nama_pengirim = $request->input('nama_pengirim');
                $payment->file_name = $path;
                $payment->status_verifikasi = '0';
    
                $payment->save();
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Upload bukti pembayaran gagal',
                ], 400);
            }
        }
        
        return response()->json([
            'status' => 200,
            'message' => 'Upload bukti pembayaran berhasil',
        ]);

    }
}
