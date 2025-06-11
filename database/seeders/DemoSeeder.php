<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Tag;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Carbon;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $categories = [
            [
                'slug' => 'news',
                'name' => 'News',
                'name_id' => 'Berita',
                'icon' => 'heroicon-o-newspaper',
                'description_id' => 'Berita terbaru',
                'description' => 'Latest news',
            ],
            [
                'slug' => 'tech',
                'name' => 'Tech',
                'name_id' => 'Teknologi',
                'icon' => 'heroicon-o-cpu-chip',
                'description_id' => 'Teknologi dan inovasi',
                'description' => 'Technology and innovation',
            ],
        ];
        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Tags
        $tags = [
            [
                'slug' => 'laravel',
                'name' => 'Laravel',
                'description' => 'Laravel related news',
            ],
            [
                'slug' => 'filament',
                'name' => 'Filament',
                'description' => 'Filament news',
            ],
        ];
        foreach ($tags as $tag) {
            Tag::create($tag);
        }

        // News
        $newsList = [];
        for ($i = 1; $i <= 10; $i++) {
            $news = News::create([
                'title' => "Sample News $i",
                'slug' => "sample-news-$i",
                'content' => "<h2>Sample News $i</h2><p>This is the <strong>HTML content</strong> for news article number $i. <a href='https://example.com/news/$i'>Read more</a></p>",
                'image' => "https://picsum.photos/800/600?random=$i",
                'author' => 'Admin',
                'category_id' => ($i % 2) + 1, // alternate between 1 and 2
                'published_at' => \Illuminate\Support\Carbon::now()->subDays(10 - $i),
                'status' => 'active',
            ]);
            $news->tags()->attach([1, 2]);
            $newsList[] = $news;
        }
    }
}
