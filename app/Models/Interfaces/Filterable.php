<?php

namespace App\Models\Interfaces;

interface Filterable
{
    public function filter(array $filters = []);
}
