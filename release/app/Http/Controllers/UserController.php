<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\user;

use Illuminate\Support\Facades\Hash;
 class UserController extends Controller 
{
public function deleteuser(Request $request, $id){
    user::where('id', $id)->delete();
    return ["Success" => true];
}
public function adduser(Request $request) { 
    $optionalField = [];
    $mustHave = ['f_name', 'email', 'phone', 'order_count', ];
    $toValidate = [];
    $toStore = [];
    for($i = 0; $i < count($mustHave); $i++){
        $toValidate[$mustHave[$i]] = ['required'];
        $toStore[$mustHave[$i]] = $request->get($mustHave[$i]);
    }
    for($i = 0; $i < count($optionalField); $i++){
        $toStore[$optionalField[$i]] = $request->get($optionalField[$i]);
    }
    
    
    user::insert($toStore);
    return ["Success" => true]; 
}
public function userEdit(Request $request, $id)
{
    $updateFields = ['f_name', 'email', 'phone', 'order_count', ];
    $toUpdate = [];
    foreach($updateFields as $value){
        if($request->get($value) != null){
            $toUpdate[$value] = $request->get($value);
        }
    }
    user::where('id', $id)->update($toUpdate);
    return ["Success" => true]; 
}
public function viewuser(Request $request){
    $data =  user::select('id', 'f_name', 'email', 'phone', 'order_count')->get();
    return $data;
}
    //
}
