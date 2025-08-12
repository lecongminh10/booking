<?php

namespace App\Modules\Auth\Infra\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasFactory, Notifiable ,HasApiTokens;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    /**
     * Hằng số cho user_type
     */
    public const USER_TYPE_SUPER_ADMIN   = 'SUPER_ADMIN';
    public const USER_TYPE_CLUB_ADMIN    = 'CLUB_ADMIN';
    public const USER_TYPE_STORE_MANAGER = 'STORE_MANAGER';
    public const USER_TYPE_STAFF         = 'STAFF';
    public const USER_TYPE_CUSTOMER      = 'CUSTOMER';
    public const USER_TYPE_SUPPLIER      = 'SUPPLIER';

    /**
     * Danh sách tất cả user_type
     */
    public const USER_TYPES = [
        self::USER_TYPE_SUPER_ADMIN,
        self::USER_TYPE_CLUB_ADMIN,
        self::USER_TYPE_STORE_MANAGER,
        self::USER_TYPE_STAFF,
        self::USER_TYPE_CUSTOMER,
        self::USER_TYPE_SUPPLIER,
    ];

    /**
     * Hằng số cho status
     */
    public const STATUS_ACTIVE   = 'ACTIVE';
    public const STATUS_INACTIVE = 'INACTIVE';
    public const STATUS_PENDING  = 'PENDING';
    public const STATUS_LOCKED   = 'LOCKED';

    /**
     * Danh sách tất cả status
     */
    public const STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_PENDING,
        self::STATUS_LOCKED,
    ];

    protected $fillable = [
        'email',
        'password_hash',
        'phone',
        'user_type',
        'status',
        'last_login',
        'password_reset_token',
        'password_reset_expiry',
    ];

    protected $hidden = [
        'password_hash',
        'password_reset_token',
    ];

    protected $casts = [
        'last_login'            => 'datetime',
        'password_reset_expiry' => 'datetime',
        'created_at'            => 'datetime',
        'updated_at'            => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
