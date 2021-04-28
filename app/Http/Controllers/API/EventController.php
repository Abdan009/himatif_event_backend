<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $category = $request->input('category');
        $name = $request->input('name');
        $idUser = $request->input('id_user');
        $limit = $request->input('limit', 6);



        if ($id) {
            $event = Event::with(['user'])->find($id);
            if ($event) {
                return ResponseFormatter::success($event, 'Data event berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data event tidak ada', 404);
            }
        }

        $event = Event::with(['user']);
        if($idUser){
            $event->where('id_user', $idUser);
        }
        if ($category) {
            $event->where('category', $category);
        }
        if ($name) {
            $event->where('name', 'like', '%' . $name . '%');
        }
        return ResponseFormatter::success($event->paginate($limit), 'Data event berhasil diambil');
    }

    public function addEvent(Request $request)
    {
        try {
            $request->validate([
                'id_user' => 'required',
                'name' => 'required',
                'cost' => 'required',
                'description' => 'required',
                'category' => 'required',
                'location' => 'required',
                'benefits' => 'required',
                'requirements' => 'required',
                'organizer' => 'required',
                'contact_organizer' => 'required',
                'status' => 'required',
                'time_start' => 'required',
                'time_reglimit' => 'required',
            ]);

            $event = Event::create([
                'id_user' => $request->id_user,
                'name' => $request->name,
                'cost' => $request->cost,
                'description' => $request->description,
                'category' => $request->category,
                'location' => $request->location,
                'benefits' => $request->benefits,
                'requirements' => $request->requirements,
                'organizer' => $request->organizer,
                'contact_organizer' => $request->contact_organizer,
                'status' => $request->status,
                'time_start' => $request->time_start,
                'time_reglimit' => $request->time_reglimit,
            ]);
            return ResponseFormatter::success($event, 'Event berhasil ditambahkan');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Add Event Failed', 500);
        }
    }

    public function update(Request $request)
    {
        $data =$request->all();
        $event = Event::findOrFail($request->input('id'));
        $event->update($data);

        return ResponseFormatter::success($event, 'Event Berhasil Diperbaharui');
    }

    public function delete(Request $request)
    {
        try {
            $event = Event::where('id', $request->input('id'))->delete();

            return ResponseFormatter::success($event, 'Event Berhasil Dihapus');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Delete Event Failed', 500);
        }
    }


    public function updatePoster(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'file' => 'required|image|max:2048'
        ]);
        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'error' => $validator->errors()
                ],
                'update poster fails',
                401
            );
        }
        if ($request->file('file')) {
            $file = $request->file->store('assets/event', 'public');

            //simpan foto ke database (url)
            $event = Event::findOrFail($request->input('id'));
            $event->poster_event=$file;
            $event->update();

            return ResponseFormatter::success($event, 'File successfully uploaded');
        }
    }
}
