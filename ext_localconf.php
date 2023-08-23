<?php

$rendererRegistry = TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(TYPO3\CMS\Core\Resource\Rendering\RendererRegistry::class);
$rendererRegistry->registerRendererClass(\StudioMitte\Thinglink\Rendering\ThingLinkRenderer::class);

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fal']['onlineMediaHelpers']['thinglink'] = \StudioMitte\Thinglink\OnlineMedia\Helpers\ThinglinkHelper::class;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['FileInfo']['fileExtensionToMimeType']['thinglink'] = 'image/thinglink';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'] .= ',thinglink';
