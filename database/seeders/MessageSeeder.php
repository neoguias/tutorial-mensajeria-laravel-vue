<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\Message;
use App\Models\User;

class MessageSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::all();
        foreach ($users as $user) {
        
            Message::factory()->count(10)->create(['user_id' => $user->id, 'from' => $user->id])->each(function ($message) {

                if ($message->to !== $message->from) {
                    // Crete the recipient messag
                    Message::factory()->count(1)->create([
                        'user_id' => $message->user_id,
                        'from' => $message->to,
                        'to' => $message->from,
                        'subject' => $message->subject,
                        'content' => $message->content,
                        'created_at' => $message->created_at,
                    ]);
                }
            });

            Message::factory()->count(3)->create(['user_id' => $user->id, 'from' => $user->id, 'deleted_at' => Carbon::now()])->each(function ($message) {

                    // Crete the recipient message
                    Message::factory()->count(1)->create([
                        'user_id' => $message->user_id,
                        'from' => $message->to,
                        'to' => $message->from,
                        'subject' => $message->subject,
                        'content' => $message->content,
                        'created_at' => $message->created_at,
                        'deleted_at' => Carbon::now()
                    ]);
            });
        }
    }
}
