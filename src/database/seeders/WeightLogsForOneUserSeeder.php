<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Hash;

class WeightLogsForOneUserSeeder extends Seeder
{
    public function run(): void
    {
        // 既存の1人目ユーザーを使う（いなければ作る）
        $user = User::first() ?? User::create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        // そのユーザーにweight_logsを35件作る
        WeightLog::factory()
            ->count(35)
            ->create([
                'user_id' => $user->id,
            ]);
    }
}
