<?php

use App\Models\Post;
use App\User;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class PostSeeder extends Seeder
{

    public function run(Faker $faker)
    {   
        $tag_ids = Tag::pluck('id')->toArray();
        $user_ids = User::pluck('id')->toArray();
        $category_ids = Category::pluck('id')->toArray();
        
        for ($i = 0; $i < 10; $i++) {
            $new_post = new Post();
            $new_post->title = $faker->text(20);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->content = $faker->paragraphs(2, true);
            $new_post->image = $faker->imageUrl(250, 250);
            $new_post->user_id = Arr::random($user_ids);
            $new_post->category_id = Arr::random($category_ids);
            $new_post->save();

            $post_tags = [];

            foreach ($tag_ids as $tag_id) {
                if ($faker->boolean()) $post_tags[] = $tag_id;
            }

            $new_post->tags()->attach($post_tags);
        }
    }
}