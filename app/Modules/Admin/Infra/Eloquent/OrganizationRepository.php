<?php

namespace App\Modules\Admin\Infra\Eloquent;

use App\Modules\Admin\Domain\Entities\OrganizationEntity;
use App\Modules\Admin\Domain\Repositories\BaseRepository;
use App\Modules\Admin\Domain\Repositories\OrganizationRepositoryInterface;
use App\Modules\Admin\Infra\Eloquent\OrganizationModel;

class OrganizationRepository extends BaseRepository implements OrganizationRepositoryInterface
{
    public function __construct(OrganizationModel $model)
    {
        parent::__construct($model);
    }

    public function create(OrganizationEntity $organizationEntity): OrganizationEntity
    {
        $model = $this->model->create([
            'organization_name' => $organizationEntity->organization_name,
            'description'       => $organizationEntity->description,
            'address'           => $organizationEntity->address,
            'phone'             => $organizationEntity->phone,
            'tax_code'          => $organizationEntity->tax_code,
            'logo_url'          => $organizationEntity->logo_url,
            'status'            => $organizationEntity->status,
        ]);

        return $this->toEntity($model);
    }

    public function all(): array
    {
        return $this->model->all()
            ->map(fn(OrganizationModel $model) => $this->toEntity($model))
            ->toArray();
    }

    private function toEntity(OrganizationModel $model): OrganizationEntity
    {
        return new OrganizationEntity(
            $model->organization_id,
            $model->organization_name,
            $model->description,
            $model->address,
            $model->phone,
            $model->tax_code,
            $model->logo_url,
            $model->status,
            $model->created_at,
            $model->updated_at
        );
    }
}
