<?php
// SuperAdminAuthController.php
namespace App\Modules\Auth\Http\Controllers;
use App\Modules\Auth\Application\Services\AuthService;
class SuperAdminAuthController extends BaseAuthController
{
    public function __construct(AuthService $authService)
    {
        parent::__construct($authService, 'SUPER_ADMIN');
    }
}
