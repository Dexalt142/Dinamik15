<?php

namespace App\Http\Controllers\api;

use App\Creation;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreationController extends Controller
{
    
    public function submitBerkas(Request $request) {

        $user = auth('api')->user();
        $team = $user->team;

        if($team) {
            $competition = $team->competition;

            if($competition->awal_berkas && $competition->batas_berkas) {
                if($competition->awal_berkas->lessThan(Carbon::now()) && $competition->batas_berkas->greaterThan(Carbon::now())) {
                    $messages = [
                        'required' => ':attribute tidak boleh kosong'
                    ];

                    $attributes = [
                        'berkas' => 'Berkas'
                    ];

                    $validator = Validator::make($request->all(), [
                        'berkas' => 'required'
                    ], $messages, $attributes);

                    if ($validator->fails()) {
                        return response()->json([
                            'status' => 422,
                            'message' => 'The given data was invalid',
                            'error' => $validator->errors()
                        ], 422);
                    }

                    $creation = null;

                    if ($team->creation) {
                        $creation = $team->creation;
                        $creation->berkas = $request->berkas;
                    } else {
                        $creation = Creation::create([
                            'berkas' => $request->berkas,
                            'karya' => null,
                            'team_id' => $team->id
                        ]);
                    }

                    if($creation && $creation->save()) {
                        return response()->json([
                            'status' => 200,
                            'message' => 'Submit berkas berhasil'
                        ]);
                    }

                }
            }
        }
        
        return response()->json([
            'status' => 400,
            'message' => 'Submit berkas gagal'
        ], 400);

    }

    public function submitKarya(Request $request) {

        $user = auth('api')->user();
        $team = $user->team;

        if ($team) {
            $competition = $team->competition;

            if ($competition->awal_karya->lessThan(Carbon::now()) && $competition->batas_karya->greaterThan(Carbon::now())) {
                $messages = [
                    'required' => ':attribute tidak boleh kosong'
                ];

                $attributes = [
                    'karya' => 'Karya'
                ];

                $validator = Validator::make($request->all(), [
                    'karya' => 'required'
                ], $messages, $attributes);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => 422,
                        'message' => 'The given data was invalid',
                        'error' => $validator->errors()
                    ], 422);
                }

                $creation = null;

                if ($team->creation) {
                    $creation = $team->creation;
                    $creation->karya = $request->karya;
                } else {
                    $creation = Creation::create([
                        'berkas' => null,
                        'karya' => $request->karya,
                        'team_id' => $team->id
                    ]);
                }

                if ($creation && $creation->save()) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'Submit karya berhasil'
                    ]);
                }
            }
        }

        return response()->json([
            'status' => 400,
            'message' => 'Submit karya gagal'
        ], 400);

    }

}
