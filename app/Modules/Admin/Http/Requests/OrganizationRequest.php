<?php

namespace App\Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // cho phép tất cả, bạn có thể check quyền tại đây
    }

    public function rules(): array
    {
        return [
            'organization_name' => 'required|string|max:255',
            'description'       => 'nullable|string',
            'address'           => 'nullable|string',
            'phone'             => 'nullable|string|max:20',
            'tax_code'          => 'nullable|string|max:50',
            'logo_url'          => 'nullable|string|max:500',
            'status'            => 'in:ACTIVE,INACTIVE',
        ];
    }
}
