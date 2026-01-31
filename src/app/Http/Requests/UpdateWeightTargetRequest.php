<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeightTargetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // authミドルウェアがあるのでここはtrueでOK
    }

    public function rules(): array
    {
        return [
            'target_weight' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^\d+(\.\d+)?$/', (string)$value)) {
                        $fail('数字で入力してください');
                        return;
                    }

                    [$int, $dec] = array_pad(explode('.', (string)$value, 2), 2, null);

                    if (strlen($int) > 4) {
                        $fail('4桁までの数字で入力してください');
                        return;
                    }

                    if ($dec !== null && strlen($dec) !== 1) {
                        $fail('小数点は1桁で入力してください');
                        return;
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'target_weight.required' => '体重を入力してください',
        ];
    }

    public function attributes(): array
    {
        return [
            'target_weight' => '目標の体重',
        ];
    }
}
