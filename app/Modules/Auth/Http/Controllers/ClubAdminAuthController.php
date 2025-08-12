<?php
// ClubAdminAuthController.php
namespace App\Modules\Auth\Http\Controllers;
use App\Modules\Auth\Application\Services\AuthService;
class ClubAdminAuthController extends BaseAuthController
{
    public function __construct(AuthService $authService)
    {
        parent::__construct($authService, 'CLUB_ADMIN');
    }
}
