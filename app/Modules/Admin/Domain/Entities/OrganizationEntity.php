<?php

namespace App\Modules\Admin\Domain\Entities;

class OrganizationEntity
{
    public function __construct(
        public ?int $organization_id = null,
        public string $organization_name = '',
        public ?string $description = null,
        public ?string $address = null,
        public ?string $phone = null,
        public ?string $tax_code = null,
        public ?string $logo_url = null,
        public string $status = 'ACTIVE',
        public ?string $created_at = null,
        public ?string $updated_at = null
    ) {}
}
