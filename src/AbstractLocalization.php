<?php declare(strict_types=1);

namespace Composite\Localization;

use Psr\Log\LoggerInterface;

abstract class AbstractLocalization
{
    private const PLURAL_CATEGORY = '_plural';
    private const COMMON_PLACEHOLDERS = [
        "__EOL__" => "\n",
    ];
    private static array $categories = [];

    public function __construct(
        public readonly Language $language,
        private readonly string $sourcePath,
        private readonly ?LoggerInterface $logger = null,
    ) {}

    protected function get(string $category, string $text, array $placeholders = []): string
    {
        if (!$text) return '';

        $this->loadCategory($category);
        if (isset(self::$categories[$category][$text][$this->language->value])) {
            $text = (string)self::$categories[$category][$text][$this->language->value];
        } else {
            $this->logger?->warning("Lexeme '$text' not found, category '$category', language '{$this->language->value}'");
        }
        return $this->replacePlaceholders($text, $placeholders);
    }

    protected function getPluralWord(string $word, int $number): string
    {
        $this->loadCategory(self::PLURAL_CATEGORY);
        $plural = self::$categories[self::PLURAL_CATEGORY][$word][$this->language->value] ?? null;
        if (!$plural instanceof PluralInterface) {
            return "[[$word]]";
        }
        return $plural->getForm($number);
    }

    private function loadCategory(string $category): void
    {
        if (isset(self::$categories[$category])) {
            return;
        }
        $filePath = $this->sourcePath . DIRECTORY_SEPARATOR . $category . '.php';
        if (file_exists($filePath)) {
            $content = (array)(require_once $filePath);
        } else {
            $this->logger?->warning("Category file '$filePath' not found");
            $content = [];
        }
        self::$categories[$category] = $content;
    }

    private function replacePlaceholders(string $text, array $placeholders): string
    {
        /** @var array<string, string> $placeholders */
        $placeholders = array_merge($placeholders, self::COMMON_PLACEHOLDERS);
        $text = str_replace(
            array_map(
                fn (string $key): string => '{{' . $key . '}}',
                array_keys($placeholders)
            ),
            array_values($placeholders),
            $text
        );
        preg_match_all('/\[\[(\w+):(\w+)]]/mu', $text, $matches, PREG_SET_ORDER);
        if (!$matches) {
            return $text;
        }
        $replaces = [];
        foreach ($matches as $match) {
            $number = isset($placeholders[$match[2]]) ? (int)$placeholders[$match[2]] : 0;
            $replaces[$match[0]] = $this->getPluralWord($match[1], $number);
        }
        return str_replace(
            array_keys($replaces),
            array_values($replaces),
            $text
        );
    }
}