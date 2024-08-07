<?php

namespace App\Models\Interfaces;

interface Sortable
{
    public function sort(array $sorting = []);
}
