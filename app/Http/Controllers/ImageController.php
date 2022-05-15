<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Photo;

class ImageController extends Controller
{
    public function uploadAttachment(Request $request)
    {
        $type = ("App\\Models\\" . Str::studly($request->input('model')))::find($request->input('id'));

        $data = base64_decode(explode(',', $request->input('file'))[1]);

        $extension = explode('/', explode(':', substr($request->input('file'), 0, strpos($request->input('file'), ';')))[1])[1];

        if($extension ==='vnd.openxmlformats-officedocument.spreadsheetml.sheet')
        {
            $extension = 'xlsx';
        } else if ($extension === 'vnd.openxmlformats-officedocument.wordprocessingml.document')
        {
            $extension = 'docx';
        }

        $filename = Str::slug(Auth::user()->name). '_' .Auth::id() . '_' . Carbon::now()->timestamp .'.'.$extension;

        file_put_contents(public_path('/images/attachments/' . $filename), $data);

        $image = \App\Models\Image::create(
            [
                'name' => $filename,
                'created_by' => Auth::id()
            ]
        );

        $type->images()->save($image);
    }
}
