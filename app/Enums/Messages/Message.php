<?php

namespace App\Enums\Messages;

abstract class Message
{
    const OK = 'Ok';
    const CREATED = 'Successfully created';
    const UPDATED = 'Successfully updated';
    const FAILED_UPDATE = 'Failed to update';
    const DELETED = 'Successfully deleted';
    const FAILED_DELETE = 'Failed to delete';
}
