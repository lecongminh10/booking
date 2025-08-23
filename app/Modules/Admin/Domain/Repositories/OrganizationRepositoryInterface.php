<?php

namespace App\Modules\Admin\Domain\Repositories;

use App\Modules\Admin\Domain\Entities\OrganizationEntity;

interface OrganizationRepositoryInterface
{
    public function create(OrganizationEntity $organizationEntity): OrganizationEntity;
    public function all(): array;
}
