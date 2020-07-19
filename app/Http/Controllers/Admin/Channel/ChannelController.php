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
        $this->validation($request,'add');
        $input=$request->only(['name','cid']);
        $count=Channel::WHERE('cid',$input['cid'])->count();
        if($count){
            return redirect(route('admin.channel.create'))->withInput($input)->with('msg','頻道代碼已存在');
        }

        $image_info_arr=explode('|',$this->upload_img($request->file('image')));
        
        if(file_exists($image_info_arr[1])){
            $input['image']='/admin/channel/'.$image_info_arr[0];
            Channel::create( $input);

            return redirect(route('admin.channel.index'));
        }

    }

    public function changeStatus(Channel $channel)
    {
       
        if($channel->status==1){
            $channel->update(['status'=>3]);
        }else{
            $channel->update(['status'=>1]); 
        }

        return 'success';
        //return redirect(route('admin.index'));
    }

    public function edit(Channel $channel)
    {
        return  view('admin.channels.channelEdit',compact('channel')); 
    }

    public  function randNum($len)
    {
        $num='';
        for($i=0;$i<$len;$i++)
        {
            $num.=rand(0,9);
        }

        return $num;
    }
    

    public function update(Request $request,Channel $channel)
    {
       // dd($request->file());
        $this->validation($request);
        $input=$request->only(['name','cid']);

        $count=Channel::WHERE('cid',$input['cid'])->WHERE('id','!=',$channel->id)->count();
        if($count){
            return redirect(route('admin.channel.edit',['channel'=>$channel->id]))->withInput($input)->with('msg','頻道代碼已存在');
        }

        if ($request->hasFile('image'))
        {   
            //刪除舊圖片
           $old_image_path=public_path('storage'.  $channel->image);  
           if(file_exists($old_image_path)){
                unlink($old_image_path);
           }
         
            $image_info_arr=explode('|',$this->upload_img($request->file('image')));
            
            
            if(file_exists($image_info_arr[1])){
                
                $input['image']='/admin/channel/'.$image_info_arr[0];
                $channel->update( $input);
                return redirect(route('admin.channel.index'));
            }else{
                return redirect(route('admin.channel.edit',['channel'=>$channel->id]))->with('msg','上傳失敗');
            }
        }else{
            $channel->update( $input);
            return redirect(route('admin.channel.index'));
        }
    }
     
    public function destroy(Channel $channel){
         //刪除舊圖片
         $old_image_path=public_path('storage'.  $channel->image);  
         if(file_exists($old_image_path)){
              unlink($old_image_path);
         }

        $channel->delete();
        return redirect(route('admin.channel.index'));
    }

    public function upload_img($image_file)
    {
            // 修改指定圖片的大小
            $img = Image::make($image_file)->resize(300, 300);

            //圖片儲存路徑
            $image_name=time().$this->randNum(3).'.jpg';
            $real_public_path=public_path('storage/admin/channel/'.$image_name);  


            // 將處理後的圖片重新儲存到其他路徑
            $img->save($real_public_path);

            return$image_name .'|'. $real_public_path;
    }


    public function validation($request,$type=''){
        if($type=='add'){
            $image_rule='required|image|mimes:jpeg';
        }else{
            $image_rule='sometimes|required|image|mimes:jpeg';
        }
        
        $rule=[
            'name'=>'required',
            'cid'=>'required',
            'image'=>$image_rule
        ];

        //dd($rule);
        
        $this->validate($request, $rule,[
            'image.required'=>'請上傳圖片',
            'required'=>'請填寫欄位',
            'image.mimes'=>'上傳圖片格式為JPG',
        ]);
        
    }

}
