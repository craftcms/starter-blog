<?php

/**
 * Asset Rev plugin config
 *
 * Make sure you have the ports in `webpack.config.js` synchronized with
 * the ones DDEV has open in `.ddev/config.yml`!
 * 
 * We are setting URLs and paths with aliases, defined in `general.php`.
 *
 * @see https://github.com/clubstudioltd/craft-asset-rev
 */

return [
    'strategies' => [
        'manifest' => \club\assetrev\utilities\strategies\ManifestFileStrategy::class,
        'noManifest' => function() {
            return '';
        }
    ],
    'assetUrlPrefix' => '@web',
    'manifestPath' => '@webroot/assets/dist/manifest.json',
    'pipeline' => 'manifest|noManifest',
];
