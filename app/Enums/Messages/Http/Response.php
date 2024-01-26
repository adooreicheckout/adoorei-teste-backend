<?php

namespace App\Enums\Messages\Http;

enum Response: string
{
    case OK = 'Ok';
    case CREATED = 'Successfully created';
    case UPDATED = 'Successfully updated';
    case FAILED_UPDATE = 'Failed to update';
    case DELETED = 'Successfully deleted';
    case FAILED_DELETE = 'Failed to delete';
}
