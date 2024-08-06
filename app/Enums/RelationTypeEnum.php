<?php
namespace App\Enums;

enum RelationTypeEnum
{
    case ONE_TO_MANY;
    case ONE_TO_ONE;
    case MANY_TO_MANY;
}
