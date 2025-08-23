<?php

namespace App\Modules\Admin\Infra\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationModel extends Model
{
    use HasFactory;

    protected $table = 'organizations';
    protected $primaryKey = 'organization_id';
    public $timestamps = true;

    protected $fillable = [
        'organization_name',
        'description',
        'address',
        'phone',
        'tax_code',
        'logo_url',
        'status',
    ];
}
