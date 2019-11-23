<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [ 'laravel', 'php', 'javascript', 'html', 'css', 'seo', 'pdo', 'performance'];
        foreach ($tags as  $tag) {
            \App\Tag::create([
                'name' => $tag
            ]);
        }
    }
}
