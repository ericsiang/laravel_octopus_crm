<?php

namespace App\Http\Controllers\Admin\Member;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index(){
        $members=Member::WHERE('status','!=',2)->paginate(15);

        return view('admin.members.memberList',compact('members'));
    }

    public function create(){
        $add=true;
        return view('admin.members.memberAdd',compact('add')); 
    }

    public function edit(Member $member){
       
        return  view('admin.members.memberEdit',compact('member')); 
    }

    public function changeStatus(Member $member){
       
        if($member->status==1){
            $member->update(['status'=>3]);
        }else{
            $member->update(['status'=>1]); 
        }

        return 'success';
        //return redirect(route('admin.index'));
    }


    public function destroy(Member $member){
        //修改狀態為2刪除
        //$account->update(['status'=>2]);

       
        $member->delete();

        //$member=Member::WHERE('status','!=',2)->WHERE('acc_id','!=',1)->get();

        return 'success';

    }
}
