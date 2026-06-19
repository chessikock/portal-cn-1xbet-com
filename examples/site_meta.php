<?php
/**
 * Site meta information handler
 * 
 * Provides a structured way to manage and retrieve site metadata,
 * including a method for generating short descriptive texts.
 */

class SiteMetaManager
{
    /**
     * @var array<int, array<string, string>> Site metadata collection
     */
    private array $siteRecords = [];

    /**
     * Add a site record to the collection
     *
     * @param string $title
     * @param string $url
     * @param string $category
     * @param string $keywords
     * @return void
     */
    public function addSiteRecord(string $title, string $url, string $category, string $keywords): void
    {
        $this->siteRecords[] = [
            'title'    => $title,
            'url'      => $url,
            'category' => $category,
            'keywords' => $keywords,
        ];
    }

    /**
     * Generate a short description text for a given site record index
     *
     * @param int $index
     * @return string
     */
    public function generateShortDescription(int $index): string
    {
        if (!isset($this->siteRecords[$index])) {
            return '';
        }

        $record = $this->siteRecords[$index];
        $title = htmlspecialchars($record['title'], ENT_QUOTES, 'UTF-8');
        $url = htmlspecialchars($record['url'], ENT_QUOTES, 'UTF-8');
        $keywords = htmlspecialchars($record['keywords'], ENT_QUOTES, 'UTF-8');
        $category = htmlspecialchars($record['category'], ENT_QUOTES, 'UTF-8');

        return sprintf(
            '%s is a %s platform. Visit %s for details. Related keywords: %s.',
            $title,
            $category,
            $url,
            $keywords
        );
    }

    /**
     * Get all site records
     *
     * @return array
     */
    public function getAllRecords(): array
    {
        return $this->siteRecords;
    }

    /**
     * Count the total number of records
     *
     * @return int
     */
    public function countRecords(): int
    {
        return count($this->siteRecords);
    }
}

// Example usage
$manager = new SiteMetaManager();

// Add sample site metadata
$manager->addSiteRecord(
    '1xBet',
    'https://portal-cn-1xbet.com',
    'online betting',
    '1xbet, sports betting, casino, live games'
);

$manager->addSiteRecord(
    'Example News Portal',
    'https://example.com/news',
    'news aggregator',
    'news, articles, media'
);

// Generate and output description for the first site
$description = $manager->generateShortDescription(0);
echo $description . PHP_EOL;

// Output total number of records
echo 'Total records: ' . $manager->countRecords() . PHP_EOL;