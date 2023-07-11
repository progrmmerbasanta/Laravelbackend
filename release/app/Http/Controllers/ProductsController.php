<?php
/**
 *  
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\products;
use Illuminate\Support\Facades\Hash;

class ProductsController extends Controller 
{
    public function deleteproducts_details(Request $request, $id){
        products::where('id', $id)->delete();
        return ["Success" => true];
    }

    public function uploadFunction(Request $request)
    {
        $imageName = time().'.'.$request->img->extension();  
        $request->img->move(public_path('img'), $imageName);
        return "http://".request()->getHttpHost()."/img/$imageName";
    }

    public function addproducts_details(Request $request) 
    { 
        $optionalField = [];
        $mustHave = ['name', 'price', 'description', 'stars', 'img', 'location', 'typeId', ];
        $toValidate = [];
        $toStore = [];
        for($i = 0; $i < count($mustHave); $i++){
            $toValidate[$mustHave[$i]] = ['required'];
            $toStore[$mustHave[$i]] = $request->get($mustHave[$i]);
        }
        for($i = 0; $i < count($optionalField); $i++){
            $toStore[$optionalField[$i]] = $request->get($optionalField[$i]);
        }
        
        $toStore['img'] = $this->uploadFunction($request);
        $toStore['stars'] = Hash::make($toStore['stars']);

        
        products::insert($toStore);
        return ["Success" => true]; 
    }

    public function products_detailsEdit(Request $request, $id)
    {
        $updateFields = ['name', 'description', 'stars', 'price', 'img', 'location', 'typeId', ];
        $toUpdate = [];
        foreach($updateFields as $value){
            if($request->get($value) != null){
                $toUpdate[$value] = $request->get($value);
            }
        }
        products::where('id', $id)->update($toUpdate);
        return ["Success" => true]; 
    }

    public function viewproduct_details(Request $request)
    {
        $data =  products::select('id', 'name', 'price', 'description', 'stars', 'img', 'location', 'typeId')->get();
        return $data;
    }
    //
}
