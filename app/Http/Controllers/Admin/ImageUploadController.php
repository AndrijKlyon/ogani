<?php

namespace App\Http\Controllers\Admin;

use App\EModels\Category;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends AdminController
{
    public function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('img/temp'),$imageName);
        return response()->json(['success'=>$imageName]);
    }

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        $path=public_path('/img/temp/'.$filename);
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function fileDelete(Request $request) {
        $item = $request->input('item');
        $item_id = $request->input('id');
        $modelName = 'App\EModels\\' . $item;
        $model = $modelName::where('id', $item_id)->first();
        if($item == 'category') $path = 'img/categories/'.$model['img'];
        if($item == 'product' || $item == 'productimage') $path = 'img/products/'.$this->getParentCategory(Category::all(), $model->category)['alias'].'/'.$model['img'];

        // Delete image
        if($path && Storage::disk('local_public')->exists(public_path($path))) {
            $image = Storage::disk('local_public')->delete(public_path($path));
        }
        // Delete image name from DB
        if($item == 'productimage') {
            $model->delete();
        } else {
            $model['img'] = 'no-image.png';
            $model->save();
        }
        return redirect()->back();
    }
}
