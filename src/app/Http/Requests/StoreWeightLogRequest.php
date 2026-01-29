<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeightLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'weight' => [
                'required',
                function ($attribute, $value, $fail) {
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
                },
            ],
            'calories' => ['required', 'integer'],
            'exercise_duration' => ['required', 'regex:/^\d{1,2}:\d{2}$/'],
            'exercise_content' => ['nullable', 'string', 'max:120'],
        ];
    }

    public function messages(): array
    {
        return [
            // 日付
            'date.required' => '日付を入力してください',
            'date.date'     => '正しい日付を入力してください',

            // 体重
            'weight.required' => '体重を入力してください',

            // カロリー
            'calories.required' => '摂取カロリーを入力してください',
            'calories.integer'  => '数字で入力してください',

            // 運動時間（B案）
            'exercise_duration.required' => '運動時間を入力してください',
            'exercise_duration.regex' => '運動時間を入力してください（例：01:30）',

            // 運動内容
            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }

    public function attributes(): array
    {
        return [
            'date' => '日付',
            'weight' => '体重',
            'calories' => '摂取カロリー',
            'exercise_duration' => '運動時間',
            'exercise_content' => '運動内容',
        ];
    }
}
