<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class customerController extends Controller
{
    public function customerdashboard(){

        $allCustomerData=Customer::
        select("customer_id","name","email","address_id","created_at","updated_at")
        ->paginate(10);

        // $allcustomerData=customer::with("contact")->paginate(10);

        return view("customer.dashboard",compact("allCustomerData"));
    }



    public function customerdashboard_submit(Request $request){





        $rules=[

            "name"=>"required",
            "email"=>"required|email|unique:admins",
            // "email"=>"required|email|unique:admins,$request->input('updateadmin_id'),admin_id",

            "password"=>"required",



        ];

        $customMessage=[

        ];



        $request->validate($rules,$customMessage);





        $name=$request->input("name");
        $email=$request->input("email");
        $password=$request->input("password");
        // $address_id=$request->input("address_id");




        $data=[

            "name"=>$name,
            "email"=>$email,
            "password"=>Hash::make($password),
            "ptoken"=>base64_encode($password),
            "address_id"=>null,
        ];


        $insert=Customer::create($data);



        if($insert){

            return redirect(route("customer.dashboard"))->with("success","Data is inserted");
        }

        else{
            return redirect(route("customer.dashboard"))->with("error","There is an error in insertion");

        }
    }


    public function customerdashboard_update($id){

        $data=Customer::with("contact")->where("customer_id",$id)->first();



        return view("customer.update",compact("data"));
    }


    public function customerdashboard_update_form(Request $req){
        $rules=[


            "address"=>"required",
            "profile"=>"required",
            "phone_no"=>"required",
            "name"=>"required",
            "email"=>"required|email|unique:admins,email,{$req->input("updatecustomer_id")},admin_id",
            "password"=>"required",
        ];

        $customMessage=[


        ];


        $req->validate($rules,$customMessage);


        $id=$req->input("updatecustomer_id");
        $name=$req->input("name");
        $email=$req->input("email");
        $password=$req->input("password");
        $address=$req->input("address");
        $phone_no=$req->input("phone_no");
        // $address_id=$req->input("address_id");


        $file_name=File_upload($req,"profile","Uploads");

        $dataAddress=[

            "profile"=>$file_name,
            "address"=>$address,
            "phone_no"=>$phone_no,
            "customer_id"=>$id,


        ];

        $address=Address::updateOrCreate([

            "address_id"=>$id

        ],$dataAddress);


        $data=[

            "name"=>$name,
            "email"=>$email,
            "password"=>Hash::make($password),
            "ptoken"=>base64_encode($password),
            "address_id"=>$address->address_id
            // "address_id"=>null,

        ];


        $update=Customer::where("customer_id",$id)->update($data);
        if($update){

            return redirect(route("customer.dashboard"))->with("success","Data is Updated");
        }

        else{

            return redirect(route("customer.dashboard"))->with("error","There is an error in Updation");

        }


    }



    public function customerdashboard_delete($id){

        $data=Customer::with("contact")->where("customer_id",$id)->first();



        return view("customer.delete",compact("data"));
    }


    public function customerdashboard_delete_form(Request $request){




        $id=$request->input("updatecustomer_id");


        $delete=Customer::where("customer_id",$id)->delete();



        if($delete){

            return redirect(route("customer.dashboard"))->with("success","Data is deleted");
        }

        else{
            return redirect(route("customer.dashboard"))->with("error","There is an error in Deletion");

        }




    }
}
