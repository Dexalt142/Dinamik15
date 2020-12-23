<?php

namespace App\Http\Controllers\api;

use App\Competition;
use App\Http\Controllers\Controller;
use App\Instructor;
use App\Team;
use App\TeamMember;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    
    public function getTeam(Request $request) {

        $team = auth()->user()->team;
        if($team) {
            $team->competition;
            $team->payment;
            $team->instructor;
            $team->creation;
            $team->members;
        }
        
        return response()->json([
            'status' => 200,
            'team' => $team
        ]);
    }

    public function registerTeam(Request $request) {

        if(!auth()->user()->team) {

            $messages =[
                'required' => ':attribute tidak boleh kosong',
                'exists' => ':attribute pilihan anda tidak tersedia',
                'mimes' => 'Format yang diperbolehkan hanya JPEG dan PNG',
                'max' => ':attribute tidak boleh lebih besar dari 2MB'
            ];

            $attributes = [
                'nama_kelompok' => 'Nama kelompok',
                'asal_sekolah' => 'Asal sekolah',
                'kompetisi' => 'Kompetisi',
                'nama_pembimbing' => 'Nama pembimbing',
                'nip_pembimbing' => 'NIP pembimbing',
                'no_telp_pembimbing' => 'No. Telepon pembimbing',
            ];

            $rules = [
                'nama_kelompok' => 'required',
                'asal_sekolah' => 'required',
                'kompetisi' => 'required|exists:competitions,id',
                'nama_pembimbing' => 'string|nullable',
                'nip_pembimbing' => 'string|nullable',
                'no_telp_pembimbing' => 'string|nullable',
            ];

            $selectedComp = Competition::find($request->kompetisi);

            if($selectedComp) {
                $jumlahAnggota = $selectedComp->type == 'Kelompok' ? 3 : 1;
                for($i = 0; $i < $jumlahAnggota; $i++) {
                    $rules["anggota.$i.nama"] = 'required';
                    $rules["anggota.$i.nisn"] = 'required';
                    $rules["anggota.$i.no_telp"] = 'required';
                    $rules["anggota.$i.pas_foto"] = 'required|file|mimes:jpeg,png|max:2048';
                    $rules["anggota.$i.ktp"] = 'required|file|mimes:jpeg,png|max:2048';

                    $attributes["anggota.$i.nama"] = 'Nama anggota';
                    $attributes["anggota.$i.nisn"] = 'NISN';
                    $attributes["anggota.$i.no_telp"] = 'No. telepon';
                    $attributes["anggota.$i.pas_foto"] = 'Pas foto';
                    $attributes["anggota.$i.ktp"] = 'KTP';
                }
            }

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => 'The given data was invalid',
                    'error' => $validator->errors()
                ], 422);
            }
            
            try {
                DB::beginTransaction();

                $team = Team::create([
                    'name' => $request->nama_kelompok,
                    'asal_sekolah' => $request->asal_sekolah,
                    'lolos_final' => 0,
                    'competition_id' => $selectedComp->id,
                    'user_id' => auth()->user()->id
                ]);

                if ($team->save()) {
                    if ($request->nama_pembimbing || $request->nip_pembimbing || $request->no_telp_pembimbing) {
                        $instructor = Instructor::create([
                            'name' => $request->nama_pembimbing,
                            'nip' => $request->nip_pembimbing,
                            'no_telp' => $request->no_telp_pembimbing,
                            'team_id' => $team->id,
                        ]);

                        $instructor->save();
                    }

                    $n = $selectedComp->type == 'Kelompok' ? 3 : 1;
                    for ($i = 0; $i < $n; $i++) {
                        $pasFotoName = sha1(Carbon::now()->format('d/m/y-H:i:s') . Str::random(10) . '_' . $team->name . $i) . '.' . $request->file("anggota.$i.pas_foto")->extension();
                        $pasFotoPath = Storage::disk('pas_foto')->putFileAs('', $request->file("anggota.$i.pas_foto"), $pasFotoName);

                        $ktpName = sha1(Carbon::now()->format('d/m/y-H:i:s') . Str::random(10) . '_' . $team->name . $i) . '.' . $request->file("anggota.$i.ktp")->extension();
                        $ktpPath = Storage::disk('ktp')->putFileAs('', $request->file("anggota.$i.ktp"), $ktpName);

                        $teamMember = TeamMember::create([
                            'name' => $request->anggota[$i]['nama'],
                            'nisn' => $request->anggota[$i]['nisn'],
                            'no_telp' => $request->anggota[$i]['no_telp'],
                            'pas_foto' => $pasFotoPath,
                            'ktp' => $ktpPath,
                            'team_id' => $team->id
                        ]);

                        $teamMember->save();
                    }

                }

                DB::commit();

                return response()->json([
                    'status' => 200,
                    'message' => 'Pendaftaran tim berhasil'
                ]);
            } catch(Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 500,
                    'message' => 'Pendaftaran tim gagal'
                ], 500);
            }

            

            return response()->json([
                'status' => 500,
                'message' => 'Pendaftaran tim gagal'
            ], 500);

        }

    }

}