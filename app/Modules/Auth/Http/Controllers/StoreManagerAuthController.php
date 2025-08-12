<?php
// StoreManagerAuthController.php
namespace App\Modules\Auth\Http\Controllers;
use App\Modules\Auth\Application\Services\AuthService;
class StoreManagerAuthController extends BaseAuthController
{
    public function __construct(AuthService $authService)
    {
        parent::__construct($authService, 'STORE_MANAGER');
    }
}
