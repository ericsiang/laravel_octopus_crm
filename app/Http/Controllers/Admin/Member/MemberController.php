<?php

namespace App\Http\Controllers\Admin\Member;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index(){
        $members=Member::all();

        return view('admin.members.memberList',compact('members'));
    }
}
