<?php

namespace App\Modules\Admin\Application\Services;

use App\Modules\Admin\Domain\Entities\OrganizationEntity;
use App\Modules\Admin\Infra\Eloquent\OrganizationRepository;

class OrganizationService
{
    public function __construct(protected OrganizationRepository $organizationRepository) {}

    public function getAll()
    {
        return $this->organizationRepository->all();
    }

    public function getById(int $id): ?OrganizationEntity
    {
        $model = $this->organizationRepository->getById($id);
        return $model ? $this->organizationRepository->all()[$id] ?? null : null;
    }

    public function create(array $data): OrganizationEntity
    {
        $entity = new OrganizationEntity(...$data);
        return $this->organizationRepository->create($entity);
    }

    public function update(int $id, array $data)
    {
        return $this->organizationRepository->saveOrUpdateItem($data, $id);
    }

    public function delete(int $id)
    {
        return $this->organizationRepository->delete($id);
    }
}
