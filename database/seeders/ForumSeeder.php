<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ForumPost;
use App\Models\ForumReply;
use App\Models\User;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        ForumPost::factory(30)->create()->each(function ($post) use ($users) {
            ForumReply::factory(random_int(3, 10))->create([
                'forum_post_id' => $post->id,
                'user_id' => $users->random()->id
            ]);
        });
    }
}
