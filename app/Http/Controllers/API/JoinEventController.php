<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\JoinEvent;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JoinEventController extends Controller
{
    // 'id_user','id_event','name_leader', 'name_member',
    // 'contact_leader', 'schema', 'note'

    public function join(Request $request){
        try {
            $request->validate([
                'id_user'=> 'required',
                'id_event'=>'required',
                'name_leader'=>'required',
            ]);
    
            $join = JoinEvent::create([
                'id_user'=> $request->id_user,
                'id_event'=>$request->id_event,
                'name_leader'=>$request->name_leader,
                'name_member'=>$request->name_member,
                'contact_leader'=>$request->contact_leader,
                'schema'=>$request->schema,
                'note'=>$request->note
            ]);
    
            return ResponseFormatter::success($join, 'Daftar Berhasil');
            } catch (Exception $error) {
                return ResponseFormatter::error([
                    'message'=> 'Something went wrong',
                    'error'=>$error
                ], 'Daftar Gagal', 500);
            }
    }
    public function all(Request $request){
        try {
            $limit = $request->input('limit', 6);
            $idUser = $request->input('id_user');

            $join = JoinEvent::with(['user', 'event']);
            if($idUser){
                $join->where('id_user', $idUser);
            }
    
            return ResponseFormatter::success($join->paginate($limit), 'Daftar Join Event berhasil didapatkan');
            } catch (Exception $error) {
                return ResponseFormatter::error([
                    'message'=> 'Something went wrong',
                    'error'=>$error
                ], 'Data gagal didapatkan', 500);
            }
    }
}
