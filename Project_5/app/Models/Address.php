<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $primaryKey = "address_id";

    protected $fillable = [
        'profile',
        'address',
        'phone_no',
        'customer_id',
        'address_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function addresscontact(){

        return $this->belongsTo(Customer::class,"address_id","customer_id")->withDefault([



            'name'=>"Minahil",
            'email'=>"none@gmail.com",
            'password'=>"none",
            'ptoken'=>"none"



        ]);
    }
}