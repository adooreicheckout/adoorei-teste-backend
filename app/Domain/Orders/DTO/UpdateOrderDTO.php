<?php

namespace App\Domain\Orders\DTO;

use App\Domain\Orders\Validators\OrderValidator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateOrderDTO
{

    public $amount;
    public $status;

    public function __construct($amount, $status)
    {
        $this->amount = $amount;
        $this->status = $status;
    }

    /**
     * Valida os dados do DTO usando o OrderValidator.
     *
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate()
    {
        $data = [
            'amount' => $this->amount,
            'status' => $this->status,
        ];

        $validator = OrderValidator::validateCreate($data);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'data'      => $validator->errors()
            ], 400));
        }

        return $data;
    }
}
