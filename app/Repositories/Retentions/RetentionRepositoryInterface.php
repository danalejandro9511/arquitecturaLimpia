<?php

namespace App\Repositories\Retentions;

use App\Domains\Entities\Retentions\Retention;

interface RetentionRepositoryInterface
{
    public function save(Retention $retention);
    public function findById($id);
    public function delete($id);
    public function getAll(): array;
}