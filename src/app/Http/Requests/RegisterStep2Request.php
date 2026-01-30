<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $weightRule = function ($attribute, $value, $fail) {
            if (!preg_match('/^\d+(\.\d+)?$/', (string)$value)) {
                $fail('数字で入力してください');
                return;
            }

            // 整数部と小数部に分割
            [$int, $dec] = array_pad(explode('.', (string)$value, 2), 2, null);

            // 整数部4桁以上
            if (strlen($int) > 4) {
                $fail('4桁までの数字で入力してください');
                return;
            }

            // 小数は1桁まで
            if ($dec !== null && strlen($dec) !== 1) {
                $fail('小数点は1桁で入力してください');
                return;
            }
        };

        return [
            'current_weight' => ['required', $weightRule],
            'target_weight'  => ['required', $weightRule],
        ];
    }

    public function messages(): array
    {
        return [
            'current_weight.required' => '体重を入力してください',
            'target_weight.required'  => '体重を入力してください',
        ];
    }

    public function attributes(): array
    {
        return [
            'current_weight' => '現在の体重',
            'target_weight'  => '目標の体重',
        ];
    }
}
