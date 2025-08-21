<?php

namespace App\Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Auth\Infra\Eloquent\UserModel;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone'    => 'nullable|string|max:15',
        ];
         if ($this->isFromGenericAuth()) {
            $rules['user_type'] = 'required|in:' . implode(',', UserModel::USER_TYPES);
        } else {
            // Các controller con kế thừa BaseAuthController sẽ tự set user_type
            $rules['user_type'] = 'sometimes|in:' . implode(',', UserModel::USER_TYPES);
        }

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'Email là bắt buộc',
            'email.unique'      => 'Email đã tồn tại',
            'password.min'      => 'Mật khẩu ít nhất 6 ký tự',
            'password.confirmed'=> 'Xác nhận mật khẩu không khớp',
            'user_type.required'=> 'Loại user là bắt buộc',
            'user_type.in'      => 'Loại user không hợp lệ'
        ];
    }

    private function isFromGenericAuth(): bool
    {
        return $this->route()?->getController() instanceof \App\Modules\Auth\Http\Controllers\AuthController;
    }
}
