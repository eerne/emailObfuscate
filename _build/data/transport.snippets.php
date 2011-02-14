<?php
/**
 * Add snippets to build
 * 
 * @package emailobfuscate
 * @subpackage build
 */
$snippets = array();

$snippets[0] = $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
    'id' => 0,
    'name' => 'emailObfuscate',
    'description' => 'emailObfuscate output modifier for MODx',
    'snippet' => getSnippetContent($sources['source_core'] . '/elements/snippets/snippet.emailobfuscate.php'),
), '', true, true);
$properties = include $sources['build'] . 'properties/properties.emailobfuscate.php';
$snippets[0]->setProperties($properties);
unset($properties);

return $snippets;
