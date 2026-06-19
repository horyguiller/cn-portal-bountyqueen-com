<?php
/**
 * Site meta information utility
 * 
 * Provides site metadata storage and description generation.
 */

// Site metadata array
$siteMeta = [
    'title' => '赏金女王 Official Portal',
    'description' => 'Discover the world of 赏金女王 – your ultimate bounty queen resource.',
    'keywords' => ['赏金女王', 'bounty queen', 'portal', 'rewards'],
    'url' => 'https://cn-portal-bountyqueen.com',
    'language' => 'zh-CN',
    'author' => 'BountyQueen Team',
    'version' => '1.0.0',
];

/**
 * Generate a short description text from site metadata.
 *
 * @param array $meta Site metadata array
 * @param int $maxLength Maximum length of generated description
 * @return string Generated description
 */
function generateShortDescription(array $meta, int $maxLength = 160): string
{
    $title = $meta['title'] ?? 'Untitled';
    $desc = $meta['description'] ?? '';
    $url = $meta['url'] ?? '';
    $keywords = $meta['keywords'] ?? [];

    // Build base description
    $base = $title;
    if (!empty($desc)) {
        $base .= ' – ' . $desc;
    }
    if (!empty($keywords)) {
        $keywordStr = implode(', ', $keywords);
        $base .= '. Keywords: ' . $keywordStr;
    }
    if (!empty($url)) {
        $base .= ' | ' . $url;
    }

    // Truncate to max length, preferring whole words
    if (mb_strlen($base) > $maxLength) {
        $base = mb_substr($base, 0, $maxLength - 3) . '...';
    }

    return htmlspecialchars($base, ENT_QUOTES, 'UTF-8');
}

/**
 * Get a formatted meta tag string for HTML head.
 *
 * @param array $meta Site metadata
 * @return string HTML meta tags
 */
function getMetaTags(array $meta): string
{
    $tags = '';

    if (!empty($meta['description'])) {
        $desc = htmlspecialchars($meta['description'], ENT_QUOTES, 'UTF-8');
        $tags .= "<meta name=\"description\" content=\"{$desc}\">\n";
    }

    if (!empty($meta['keywords'])) {
        $kw = htmlspecialchars(implode(', ', $meta['keywords']), ENT_QUOTES, 'UTF-8');
        $tags .= "<meta name=\"keywords\" content=\"{$kw}\">\n";
    }

    if (!empty($meta['author'])) {
        $author = htmlspecialchars($meta['author'], ENT_QUOTES, 'UTF-8');
        $tags .= "<meta name=\"author\" content=\"{$author}\">\n";
    }

    if (!empty($meta['url'])) {
        $url = htmlspecialchars($meta['url'], ENT_QUOTES, 'UTF-8');
        $tags .= "<link rel=\"canonical\" href=\"{$url}\">\n";
    }

    return $tags;
}

// Example usage
$description = generateShortDescription($siteMeta);
echo "Generated description: " . $description . "\n";

echo "\nMeta tags:\n";
echo getMetaTags($siteMeta);