### Preview

<img src="assets/preview.png">

### Class HtmlParser

```php
<?php
class HtmlParser {
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
```

### Пример использования

```php
$url = "https://siberfx.com"; // send the url to count the tags
$htmlParser = new HtmlParser($url);
$htmlParser->parse();
$variable = $htmlParser->displayTagCounts(); // return arrays of data
?>
```

В этом примере мы создали класс `HtmlParser`, который принимает URL в качестве аргумента конструктора. Класс содержит
приватные свойства `$url` для хранения URL, `$html` для хранения HTML-кода страницы и `$tagCounts` для хранения
подсчитанных тегов.

Метод `parse()` выполняет основную работу по парсингу HTML-страницы и подсчету тегов, а метод `displayTagCounts()`
выводит результаты подсчета.

В основной части кода создается экземпляр класса `HtmlParser` и вызываются методы `parse()` и `displayTagCounts()`.

Обратите внимание, что данный пример также не учитывает все возможные особенности и сложные случаи, которые могут
возникнуть при парсинге HTML. Он служит исключительно для демонстрации принципов организации кода с использованием ООП.

После того, как вы реализуете и протестируете код, укажите, сколько времени вам понадобилось для его выполнения.
