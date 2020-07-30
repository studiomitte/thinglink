<?php

namespace StudioMitte\Thinglink\Helpers;

use StudioMitte\Thinglink\Utility\MetaTagUtility;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\AbstractOEmbedHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ThinglinkHelper extends AbstractOEmbedHelper
{
    protected function getOEmbedUrl($mediaId, $format = 'json')
    {
        return 'https://www.thinglink.com/api/oembed?format=' . $format . '&url=' . urlencode(sprintf('https://www.thinglink.com/scene/' . $mediaId));
    }

    public function transformUrlToFile($url, Folder $targetFolder)
    {
        $regex = '/https?:\/\/www.thinglink.com\/scene\/([0-9]*)/';
        preg_match($regex, $url, $match);
        $id = $match[1];
        if ($id) {
            return $this->transformMediaIdToFile($id, $targetFolder, $this->extension);
        }
        return null;
    }

    public function getPublicUrl(File $file, $relativeToCurrentScript = false)
    {
        $id = $this->getOnlineMediaId($file);
        return sprintf('https://www.thinglink.com/scene/%s', $id);
    }


    public function getPreviewImage(File $file)
    {
        $id = $this->getOnlineMediaId($file);
        $temporaryFileName = $this->getTempFolderPath() . 'thinglink_' . md5($id) . '.jpg';

        if (!file_exists($temporaryFileName)) {
            $url = sprintf('https://www.thinglink.com/scene/%s', $id);

            $tags = MetaTagUtility::getTagsFromUrl($url);

            $previewImageUrl = $tags['og:image'] ?? false;

            if ($previewImageUrl) {
                $previewImage = GeneralUtility::getUrl($previewImageUrl);
                file_put_contents($temporaryFileName, $previewImage);
                GeneralUtility::fixPermissions($temporaryFileName);
            }
        }

        return $temporaryFileName;
    }

    /**
     * @inheritDoc
     */
    public function getMetaData(File $file)
    {
        $metadata = parent::getMetaData($file);

        if (!$metadata['title']) {
            $id = $this->getOnlineMediaId($file);
            $url = sprintf('https://www.thinglink.com/scene/%s', $id);
            $tags = MetaTagUtility::getTagsFromUrl($url);
            $metadata['title'] = $tags['og:title'];
        }

        return $metadata;
    }
}
