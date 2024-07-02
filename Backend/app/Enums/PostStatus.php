<?php

namespace App\Enums;

enum PostStatus: string
{
    case DRAFT = "Draft";
    case PUBLISH = "Publish";
    case REVISION = "REVISION";
}
