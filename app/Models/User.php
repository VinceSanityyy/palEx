<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'identity',
        'photo',
    ];

    // protected $guarded  = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'image_link',
        'profile_image_link',
        // 'customer_profile_image_link',
        // 'vendor_profile_image_link'
    ];

    public function getImageLinkAttribute()
    {
        if (!empty($this->identity)) {

            // explode by /
            $explode_path = explode('/', $this->identity);
            // removed first value in array wich is the public of the path
            unset($explode_path[0]);
            // return back to his format
            $implode_path = implode('/', $explode_path);
            $photo = url('storage/' . $implode_path);
        } else {
            // $photo = $this->is_bundle == 1 ? "/img/bundle.png" : "/img/no-product-image.png";
            // $photo =  url('/img/user.png');
            $photo =  "";
        }

        return $photo;
    }

    public function getProfileImageLinkAttribute()
    {
        if (!empty($this->photo)) {

            // explode by /
            $explode_path = explode('/', $this->photo);
            // removed first value in array wich is the public of the path
            unset($explode_path[0]);
            // return back to his format
            $implode_path = implode('/', $explode_path);
            $photo = url('storage/' . $implode_path);
        } else {
            // $photo = $this->is_bundle == 1 ? "/img/bundle.png" : "/img/no-product-image.png";

            if ($this->role == '1') {
                $photo =  url('/img/shop.png');
                // $photo =  "https://icon-library.com/images/vendor-icon-png/vendor-icon-png-11.jpg";
            } else {
                $photo =  url('/img/user.png');
            }
            // $photo =  "";
        }

        return $photo;
    }

    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vendor()
    {
        return $this->hasMany(VendorAddress::class, 'vendor_id');
    }
}
