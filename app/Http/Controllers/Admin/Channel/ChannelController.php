<?php

namespace App\Http\Controllers\admin\channel;

use App\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;  //圖片上傳

class ChannelController extends Controller
{
    public function index()
    {
        $channels=Channel::WHERE('status','!=',2)->paginate(15);

        return view('admin.channels.channelList',compact('channels'));
    }

    public function create()
    {
        $add=true;
        return view('admin.channels.channelAdd',compact('add')); 
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image'))
        {
          
            dd($request->file('image'));
            //圖片儲存路徑
            $real_public_path=public_path('storage/'.$product->img);    
        }
    }


    public function upload_img($image_file){

    }

}
