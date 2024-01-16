<?php

namespace Giauphan\CrawlBlogData\Commands;

use Giauphan\CrawlBlogData\Models\Post;
use Illuminate\Console\Command;
use Weidner\Goutte\GoutteFacade;

class CrawlBlogData extends Command
{
    protected $signature = 'app:crawl {url} {category}';
    protected $description = 'Crawl blog data from a given URL';

    public function handle()
    {
        $pageUrl = $this->argument('url');

        do {
            $crawler = GoutteFacade::request('GET', $pageUrl);

            // Crawl and process each post
            $crawler->filter('.latestPost.excerpt')->each(function ($node) {
                $summary = $node->filter('h2.title.front-view-title')->text();
                $image = optional($node->filter('img.attachment-lawyer-featured.size-lawyer-featured.wp-post-image')->first())->attr('src');
                $linkHref = $node->filter('.latestPost.excerpt a')->attr('href');

                $this->scrapeData($linkHref, $image, $summary);
            });

            // Get next page URL
            $nextLink = $crawler->filter('nav.pagination li a.next')->first();
            $nextPageUrl = optional($nextLink)->attr('href');

            // Break if no "Next" link found
            if (!$nextPageUrl) {
                break;
            }

            // Update the pageUrl for the next iteration
            $pageUrl = $nextPageUrl;

        } while ($pageUrl !== '');
    }

    public function scrapeData($url, $image, $summary)
    {
        $crawler = GoutteFacade::request('GET', $url);
        $title = $this->crawlData('h1.title.single-title.entry-title', $crawler);
        $content = $this->crawlData('div.post-single-content.box.mark-links.entry-content', $crawler);

        $check = Post::all();

        if ($check->isEmpty()) {
            $dataPost = [
                'title' => $title,
                'content' => $content,
                'images' => $image,
                'published_at' => now(),
                'summary' => $summary,
                'idLT' => 3,
                'SimilarityPercentage' => 0.0,
            ];
            Post::create($dataPost);
        } else {
            $check_tile = false;
            $similarityPercentage = 0.0;

            foreach ($check as $blog) {
                if ($blog->title !== $title) {
                    $blog1Words = explode(' ', $blog->content);
                    $blog2Words = explode(' ', $content);
                    $commonWords = array_intersect($blog1Words, $blog2Words);
                    $similarityPercentage += count($commonWords) / count($blog1Words);
                } else {
                    $check_tile = true;
                }
            }

            if (!$check_tile && $title != null) {
                $similarityPercentage = $similarityPercentage / $check->count();
                $dataPost = [
                    'title' => $title,
                    'content' => $content,
                    'images' => $image,
                    'published_at' => now(),
                    'summary' => $summary,
                    'idLT' => 3,
                    'SimilarityPercentage' => round($similarityPercentage, 2),
                ];
                Post::create($dataPost);
            }
        }
    }

    protected function crawlData(string $type, $crawler)
    {
        $result = $crawler->filter($type)->first();

        return $result ? $result->text() : '';
    }
}
