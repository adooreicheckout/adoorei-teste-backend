<?php

namespace App\Contracts\Services;
interface Sale extends BaseService
{

    public function destroy(int $id): bool;
}
