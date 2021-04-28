<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use Exception;
use Illuminate\Http\Request;
use App\Models\CategoryEvent;
use App\Http\Controllers\Controller;

class CategoryEventController extends Controller
{
    public function getCategory(Request $request){
        $category = CategoryEvent::get();
        return ResponseFormatter::success($category, 'Kategori Berhasil Diambil');
    }
    public function add(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required'
            ]);

            $category = CategoryEvent::create([
                'name' => $request->name,
            ]);
            return ResponseFormatter::success($category, 'Kategori Berhasil Ditambahkan');
        } catch (Exception $error) {

            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Add category Failed', 500);
        }
    }
    public function update(Request $request)
    {
        $category = CategoryEvent::findOrFail($request->input('id'));
        $category->update($request->all());
        return ResponseFormatter::success($category, 'Kategori Berhasil Diperbaharui');
    }
    public function delete(Request $request)
    {
        $category = CategoryEvent::where('id', $request->input('id'))->delete();
        return ResponseFormatter::success($category, 'Kategori Berhasil Dihapus');
    }
}
