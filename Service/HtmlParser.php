<?php

class HtmlParser
{
    public string $url;
    private string|false $html;
    private array $tagCounts;

    public function __construct(
        $url,
        array $tagCounts = [],
    ) {
        $this->url = $url;
        $this->html = file_get_contents($url);
    }

    public function parse(): void
    {
        $pattern = '/<([a-z]+)(?: .*)?>/i';
        preg_match_all($pattern, $this->html, $matches);

        foreach ($matches[1] as $tag) {
            if (isset($this->tagCounts[$tag])) {
                $this->tagCounts[$tag]++;
            } else {
                $this->tagCounts[$tag] = 1;
            }
        }
    }

    public function showTagsWithCount(): array
    {
        $results = [];

        foreach ($this->tagCounts as $tag => $count) {
            $results[] = [
                'tag' => $tag,
                'count' => $count
            ];
        }

        return $results;

    }
}

