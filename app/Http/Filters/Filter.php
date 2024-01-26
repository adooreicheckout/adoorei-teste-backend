<?php

namespace App\Http\Filters;
use DeepCopy\Exception\PropertyException;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Filter
{
    // ?paid[eq]=1&type[eq]=[C,p]&value[gt]=5000
    protected array $allowedOperatorsFields = [];
    protected array $translateOperatorsFields = [
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
        'eq' => '=',
        'ne' => '!=',
        'in' => 'in',
        'lk' => 'like'
    ];

    public function __construct(array $allowedOperatorsFields = [])
    {
        $this->allowedOperatorsFields = $allowedOperatorsFields;
    }


    public function filter(Request $request): array
    {
        $where = [];
        $whereIn = [];

        if (empty($this->allowedOperatorsFields)) {
            throw new PropertyException("Property allowedOperatorsfields is empty");
        }

        foreach ($this->allowedOperatorsFields as $param => $operators) {
            $queryOperator = $request->query($param);

            if ($queryOperator && is_array($queryOperator)) {
                foreach ($queryOperator as $operator => $value) {
                    if (!in_array($operator, $operators)) {
                        throw new Exception("{$param} does not have {$operator} operator");
                    }

                    if (str_contains($value, '[')) {
                        $whereIn[] = [
                            $param,
                            explode(',', str_replace(['[', ']'], ['', ''], $value)),
                            $value
                        ];
                    } else {
                        $where[] = [
                            $param,
                            $this->translateOperatorsFields[$operator],
                            $operator === 'lk' ? "%{$value}%" : $value
                        ];
                    }
                }
            }
        }

        if (empty($where) && empty($whereIn)) {
            return [];
        }

        return [
            'where' => $where,
            'whereIn' => $whereIn
        ];
    }

    public function build(Builder &$builder, Request $request) {
        $filters = $this->filter($request);

        if (!empty($filters['where'])) {
            $builder->where($filters['where']);
        }

        if (!empty($queryFilter['whereIn'])) {
            foreach ($queryFilter['whereIn'] as $value) {
                $builder->whereIn($value[0], $value[1]);
            }
        }
    }
}
