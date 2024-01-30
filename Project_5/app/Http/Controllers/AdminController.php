<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminLogin(){

        return view("auth.admin.login");
    }

    public function adminRegister(){

        return view("auth.admin.register");
    }





    public function admindashboard(){

        return view("admin.dashboard");
    }



    public function logout(){
        if(Auth::guard('talha')->user()->role_id == 2){
        Auth::logout();
                return redirect(route("auth.admin.login"));
            }
            elseif(Auth::guard('web')->user()->role_id == 1){
        Auth::logout();
                return redirect(route("auth.user.login"));
            }
            else{
                echo "Permission Denied";
            }
    }

    public function login(Request $request){
        $rules=[

            "email"=>"required|email",
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


        $credentials=[

            "email"=>$email,
            "password"=>$password
        ];

        if(Auth::guard('talha')->attempt($credentials)){

            // dd( $request->session()->regenerate());

            $request->session()->regenerate();


            // return redirect(route("user.dashboard"));

            if(Auth::guard('talha')->user()->role_id == 2){

                dd(Auth::check());

                // dd(route("admin.dashboard"));
                return redirect(route("admin.dashboard"));



            }
            elseif(Auth::guard('web')->user()->role_id == 1){

                return redirect(route("user.dashboard"));

            }
            else{

                echo "Permission Denied";
            }

        }

        else{
            echo "Please register your Account";


            return redirect(route("auth.admin.register"));
            }

    }



    public function store(Request $request)
{

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


    $insert=Admin::create($data);

    if($insert){

        $credentials=[

            "email"=>$email,
            "password"=>$password
        ];

        if(Auth::guard('talha')->attempt($credentials)){

            $request->session()->regenerate();

            // return redirect(route("user.dashboard"));

            if(Auth::guard('talha')->user()->role_id == 2){

                return redirect(route("admin.dashboard"));

            }
            elseif(Auth::guard('web')->user()->role_id == 1){

                return redirect(route("user.dashboard"));

            }
            else{

                echo "Permission Denied";
            }

        }



}

else{

    echo "error";
}
}




}