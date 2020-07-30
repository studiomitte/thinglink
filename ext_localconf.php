<?php

$rendererRegistry = \TYPO3\CMS\Core\Resource\Rendering\RendererRegistry::getInstance();
$rendererRegistry->registerRendererClass(\StudioMitte\Thinglink\Rendering\ThingLinkRenderer::class);

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fal']['onlineMediaHelpers']['thinglink'] = \StudioMitte\Thinglink\Helpers\ThinglinkHelper::class;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['FileInfo']['fileExtensionToMimeType']['thinglink'] = 'image/thinglink';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'] .= ',thinglink';