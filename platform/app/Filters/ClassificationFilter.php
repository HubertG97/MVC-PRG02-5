<?php

// ClassificationFilter.php

namespace App\Filters;

class ClassificationFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('classification_id', $value);
    }
}
