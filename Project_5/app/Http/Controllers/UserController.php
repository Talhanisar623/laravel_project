<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function __construct(){


        // $this->middleware("isUser");
    }
    public function userdashboard(){

        return view("user.dashboard");
    }


    public function userLogin(){

        return view("auth.user.login");
    }

    public function userRegister(){

        return view("auth.user.register");
    }


    public function logout(){

        if(Auth::guard('web')->user()->role_id == 1){
        Auth::logout();
                return redirect(route("auth.user.login"));

            }
            elseif(Auth::guard('admins')->user()->role_id == 2){
        Auth::logout();
                return redirect(route("admin.dashboard"));
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

        if(Auth::guard('web')->attempt($credentials)){


    // dd( $request->session()->regenerate());


            $request->session()->regenerate();

            // return redirect(route("user.dashboard"));

            if(Auth::guard('web')->user()->role_id == 1){

                dd(Auth::check());


                return redirect(route("user.dashboard"));

            }
            elseif(Auth::guard('admins')->user()->role_id == 2){

                return redirect(route("admin.dashboard"));

            }
            else{

                echo "Permission Denied";
            }

        }

        else{


echo "Please register your Account";


return redirect(route("auth.user.register"));
}

}



/**
* Show the form for creating a new resource.
*
*/
public function create()
{
//
}

/**
* Store a newly created resource in storage.
*
* @param \Illuminate\Http\Request $request
* @return \Illuminate\Http\Response
*/
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


$insert=User::create($data);

if($insert){

$credentials=[

"email"=>$email,
"password"=>$password
];

if(Auth::guard('web')->attempt($credentials)){



$request->session()->regenerate();

// return redirect(route("user.dashboard"));

if(Auth::guard('web')->user()->role_id == 1){

return redirect(route("user.dashboard"));

}
elseif(Auth::guard('admins')->user()->role_id == 2){

return redirect(route("admin.dashboard"));

}
else{

echo "Permission Denied";
}

}





}


// if($insert){

// return redirect(route("admin.dashboard"))->with("success","Data is inserted");
// }

// else{
// return redirect(route("admin.dashboard"))->with("error","There is an error in insertion");

// }







}

/**
* Display the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
//
}

/**
* Show the form for editing the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
//
}

/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param int $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
//
}

/**
* Remove the specified resource from storage.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
//
}
}