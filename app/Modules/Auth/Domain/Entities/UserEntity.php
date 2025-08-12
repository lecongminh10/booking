<?php

namespace App\Modules\Auth\Domain\Entities;

class UserEntity
{
    public function __construct(
        public ?int    $user_id,
        public string  $email,
        public string  $password_hash,
        public ?string $phone,
        public string  $user_type, // SUPER_ADMIN, CLUB_ADMIN, STORE_MANAGER, STAFF, CUSTOMER, SUPPLIER
        public string  $status,    // ACTIVE, INACTIVE, PENDING, LOCKED
        public ?\DateTime $last_login,
        public ?string $password_reset_token,
        public ?\DateTime $password_reset_expiry,
        public \DateTime $created_at,
        public \DateTime $updated_at
    ) {}
}
