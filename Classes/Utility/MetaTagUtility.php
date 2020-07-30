<?php

declare(strict_types=1);

namespace StudioMitte\Thinglink\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class MetaTagUtility
{
    public static function getTagsFromUrl(string $url)
    {
        $content = GeneralUtility::getUrl($url);
        if (!$content) {
            return [];
        }
        return self::getTags($content);
    }


    protected static function getTags(string $content): array
    {
        $pattern = '
  ~<\s*meta\s

  # using lookahead to capture type to $1
    (?=[^>]*?
    \b(?:name|property|http-equiv)\s*=\s*
    (?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
    ([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
  )

  # capture content to $2
  [^>]*?\bcontent\s*=\s*
    (?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
    ([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
  [^>]*>

  ~ix';

        if (preg_match_all($pattern, $content, $out))
            return array_combine($out[1], $out[2]);
        return [];
    }
}
