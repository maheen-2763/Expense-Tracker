<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;
use App\Models\User;
use Faker\Factory as Faker;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $types = ['income', 'expense'];

        $expenseTitles = [
            'Groceries', 'Electricity Bill', 'Internet Bill', 'Rent', 'Fuel',
            'Mobile Recharge', 'Dining Out', 'Medical Shop', 'Shopping',
            'Transport', 'Water Bill', 'Gym Membership', 'Subscriptions',
            'Clothing', 'Repairs', 'Education Fee', 'Travel Ticket'
        ];

        $incomeTitles = [
            'Salary', 'Freelance Project', 'Bonus', 'Stock Profit',
            'Side Hustle', 'Business Income', 'Refund', 'Gift Money'
        ];

        $userIds = User::pluck('id')->toArray();

        for ($i = 0; $i < 120; $i++) {

            $type = $faker->randomElement($types);

            $title = $type === 'income'
                ? $faker->randomElement($incomeTitles)
                : $faker->randomElement($expenseTitles);

            Expense::create([
                 'user_id' => $faker->randomElement($userIds),
                'title' => $title,
                'amount' => $type === 'income'
                    ? $faker->numberBetween(3000, 50000)
                    : $faker->numberBetween(100, 5000),
                'type' => $type,
                'date' => $faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            ]);
        }
    }
}