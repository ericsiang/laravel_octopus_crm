<?php

namespace App\Http\Controllers\Admin\Member;

use App\Area;
use App\City;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{


    public function index()
    {
        $members=Member::WHERE('status','!=',2)->paginate(15);

        return view('admin.members.memberList',compact('members'));
    }

    public function create()
    {
        $add=true;
        $citys=$this->city_list();
       
        return view('admin.members.memberAdd',compact('add','citys')); 
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $this->validateion($request);
        $input=$request->except(['_token']);

        Member::create($input);

        $members=Member::WHERE('status','!=',2)->paginate(15);
        return view('admin.members.memberList',compact('members'));
    }


    public function edit(Member $member)
    {
        $citys=$this->city_list();
        $areas=$this->area_list();
        return  view('admin.members.memberEdit',compact('member','citys','areas')); 
    }


    public function update(Request $request ,Member $member)
    {
        //dd($request->all());
        $this->validateion($request,'update');
       
        $input=$request->except(['_token','_method']);
        if($input['password']){
            $input['password']=bcrypt($input['password']);
        }

        $member->update($input);

        return  redirect(route('admin.member.edit',['member'=>$member->mem_id])); 
    }

    public function changeStatus(Member $member)
    {
       
        if($member->status==1){
            $member->update(['status'=>3]);
        }else{
            $member->update(['status'=>1]); 
        }

        return 'success';
        //return redirect(route('admin.index'));
    }


    public function destroy(Member $member)
    {
        //修改狀態為2刪除
        //$account->update(['status'=>2]);

       
        $member->delete();

        //$member=Member::WHERE('status','!=',2)->WHERE('acc_id','!=',1)->get();

        return 'success';

    }


    public function validateion($request,$type='')
    {   
        $rule=[
            'email'=>'required|email|unique:members,email',
            'name'=>'required',
            'password'=>'required',
            'phone'=>'required|size:10',
            'sex'=>'required',
            'city_id'=>'required|numeric',
            'area_id'=>'required|numeric',
            'address'=>'required',
        ];

        $message=[
            'email.required'=>'email為必填欄位',
            'email.email'=>'需為email格式',
            'email.unique'=>'email已存在',
            'name.required'=>'姓名為必填欄位',
            'password.required'=>'密碼為必填欄位',
            'phone.required'=>'電話為必填欄位',
            'phone.size'=>'電話為10碼',
            'phone.numeric'=>'電話只能為數字',
            'sex.required'=>'性別為必填欄位',
            'city_id.required'=>'縣市為必填欄位',
            'city_id.numeric'=>'只能為數字',
            'area_id.required'=>'區域為必填欄位',
            'area_id.numeric'=>'只能為數字',
            'address.required'=>'地址為必填欄位'
        ];

        if($type=='update'){
            unset($rule['email']);

            if(!$request->password){
                unset($rule['password']);
            }
        }

       
       
        return $this->validate($request,$rule,$message);
    }


    
    public function city_list()
    {
        return City::WHERE('city_id','>',0)->get();
    }

    public function area_list()
    {
        return Area::WHERE('area_id','>',0)->get();
    }

    public function changeCity(Request $request,City $city)
    {
        $city_id=$city->city_id;
        $areas=Area::WHERE('city_id',$city_id)->get();

        $html='';
        foreach($areas as $area){
            $html.='<option value="'.$area->area_id.'">'.$area->area.'</option>';
        }

        return $html;
    }

}
