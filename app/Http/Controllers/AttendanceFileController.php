<?php

namespace App\Http\Controllers;

use App\Models\AttendanceDetails;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AttendanceFileController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attendance_id' => 'required|integer',
            'file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'category' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'Bad Request', 'messages' => $validator->errors()], 400);
        }

        $file = $request->file('file');
        if($request->file('file')) {
            $File = new File();
            if($file->getClientOriginalExtension() == 'pdf'){
                $fileInfo = $this->pdf($file, $request->attendance_id);
            }else{
                $fileInfo = $this->image($file, $request->attendance_id);
            }
            $File->title = $file->getClientOriginalName();
            $File->type = $file->getMimeType();
            $File->info = json_encode($fileInfo);
            $File->save();
            $File->attendance()->syncWithPivotValues($request->attendance_id, ['category' => rand(1, 2)]);
            return response()->json($File);
        }else{
            return response()->json(['error' => 'Bad Request', 'messages' => 'Invalid file'], 400);
        }
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  file  $file
     * @param  int  $attendance_id
     * @return array
     */
    private function image($file, $attendance_id)
    {
        $dimension = getimagesize($file);
        $fileName = date('Y-m-d_H-i-s').'.'.$file->getClientOriginalExtension();
        $path = 'attendance/'.$attendance_id;

        $folder = 'storage/attendance/'.$attendance_id.'/sizes/';
        $folderDB = 'attendance/'.$attendance_id.'/size/';
        if(!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }
        $img = Image::make($file->getRealPath());
        $img->resize(1024, 768, function ($constraint) {
            $constraint->aspectRatio();
        })->save($folder.'large-'.$fileName);

        $img = Image::make($file->getRealPath());
        $img->resize(800, 534, function ($constraint) {
            $constraint->aspectRatio();
        })->save($folder.'medium-'.$fileName);

        $img = Image::make($file->getRealPath());
        $img->resize(500, 333, function ($constraint) {
            $constraint->aspectRatio();
        })->save($folder.'thumbnail-'.$fileName);

        $filePath = $file->storeAs($path, $fileName, 'public');
        $fileInfo = [
            'alt' => $file->getClientOriginalName(),
            'path' => $filePath,
            'width' => $dimension[0],
            'height' => $dimension[0],
            'large' => [
                'path' => $folderDB.'large-'.$fileName,
                'width' => 1024,
                'height' => 768
            ],
            'medium' => [
                'path' => $folderDB.'medium-'.$fileName,
                'width' => 800,
                'height' => 534
            ],
            'thumbnail' => [
                'path' => $folderDB.'thumbnail-'.$fileName,
                'width' => 500,
                'height' => 333
            ],
        ];

        return $fileInfo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  file  $file
     * @param  int  $attendance_id
     * @return array
     */
    private function pdf($file, $attendance_id)
    {
        $fileName = date('Y-m-d_H-i-s').'.'.$file->getClientOriginalExtension();
        $filePath = $file->storeAs('attendance/'.$attendance_id.'/', $fileName, 'public');
        $fileInfo = [
            'path' => $filePath,
            'size' => $file->getSize(),
        ];

        return $fileInfo;
    }
}
