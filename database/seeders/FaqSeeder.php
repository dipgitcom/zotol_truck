<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faqs')->insert([
            [
                'id' => 1,
                'question' => 'How can I reset my password?',
                'answer' => 'To reset your password, go to the login page and click on "Forgot Password". Follow the instructions sent to your email.',
                'created_at' => '2025-09-10 18:31:18',
                'updated_at' => '2025-09-10 18:31:18',
            ],
            [
                'id' => 2,
                'question' => 'Where can I find my order history?',
                'answer' => 'Your order history is available under your profile. Navigate to "My Orders" to see all your past purchases.',
                'created_at' => '2025-09-10 18:31:18',
                'updated_at' => '2025-09-10 18:31:18',
            ],
            [
                'id' => 3,
                'question' => 'How do I contact support?',
                'answer' => 'You can contact support via the "Contact Us" page or email us at support@example.com.',
                'created_at' => '2025-09-10 18:31:18',
                'updated_at' => '2025-09-10 18:31:18',
            ],
            [
                'id' => 4,
                'question' => 'Can I change my account email?',
                'answer' => 'Yes, go to profile settings and click "Edit Email". Enter the new email and verify it.',
                'created_at' => '2025-09-10 18:31:18',
                'updated_at' => '2025-09-10 18:31:18',
            ],
            [
                'id' => 5,
                'question' => 'What payment methods are accepted?',
                'answer' => 'We accept credit/debit cards, PayPal, and other local payment gateways.',
                'created_at' => '2025-09-10 18:31:18',
                'updated_at' => '2025-09-10 18:31:18',
            ],
            [
                'id' => 6,
                'question' => 'How do I subscribe to the newsletter?',
                'answer' => 'Scroll to the bottom of the website and enter your email in the newsletter subscription box.',
                'created_at' => '2025-09-10 18:31:18',
                'updated_at' => '2025-09-10 18:31:18',
            ],
        ]);
    }
}
