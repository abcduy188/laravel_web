<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slides;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Redirect;

class SlidesController extends Controller
{
    //
    public function index()
    {
        $slide = Slides::orderBy('id','DESC')->get();
        return view('admin.slides.index')->with('slides', $slide);
    }
    public function add_slide()
    {
        return view('admin.slides.add_slide');
    }
    public function save_slide(Request $request)
    {
        $data = $request -> all();
        $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath(), [
            'folder' => 'Slides',
        ])->getSecurePath();
        $slide = new Slides();
        $slide->slide_name = $data['slide_name'];
        $slide->slide_desc = $data['slide_desc'];
        $slide->slide_image = $uploadedFileUrl;
        $slide->status = $data['status'];
        $slide->save();
        return redirect('/admin/all-banner')->with('message','Thêm banner thành công');
    }
    public function edit_banner($id)
    {
        $slide = Slides::find($id);
        return view('admin.slides.edit_banner')->with('slide',$slide);
    }
    public function update_banner(Request $request,$id)
    {
        $data = $request -> all();
        $img = $request->file('file');
        $slide = Slides::find($id);
        if ($img) {
            $uploadedFileUrl = Cloudinary::upload($img->getRealPath(), [
                'folder' => 'Slides',
            ])->getSecurePath();
            $slide->slide_image = $uploadedFileUrl;
        }
        $slide->slide_name = $data['slide_name'];
        $slide->slide_desc = $data['slide_desc'];
        $slide->save();
        return redirect('/admin/all-banner')->with('message','chỉnh sửa banner thành công');
    }
    public function active_banner($id)
    {
        Slides::find($id)->update(['status' => 1]);
        session()->put('message', 'Đã hiển thị sản phẩm');
        return Redirect::to('/admin/all-banner');
    }
    public function unactive_banner($id)
    {
        Slides::find($id)->update(['status' => 0]);
        session()->put('message', 'Đã ẩn sản phẩm');
        return Redirect::to('/admin/all-banner');
    }

}
