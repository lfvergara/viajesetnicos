<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0cb47ca110ea44491a19afe15455199a
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Leadin\\AssetsManager' => __DIR__ . '/../..' . '/src/class-assetsmanager.php',
        'Leadin\\Leadin' => __DIR__ . '/../..' . '/src/class-leadin.php',
        'Leadin\\LeadinFilters' => __DIR__ . '/../..' . '/src/class-leadinfilters.php',
        'Leadin\\PageHooks' => __DIR__ . '/../..' . '/src/class-pagehooks.php',
        'Leadin\\admin\\AdminConstants' => __DIR__ . '/../..' . '/src/admin/class-adminconstants.php',
        'Leadin\\admin\\AdminFilters' => __DIR__ . '/../..' . '/src/admin/class-adminfilters.php',
        'Leadin\\admin\\Connection' => __DIR__ . '/../..' . '/src/admin/class-connection.php',
        'Leadin\\admin\\DeactivationForm' => __DIR__ . '/../..' . '/src/admin/class-deactivationform.php',
        'Leadin\\admin\\Gutenberg' => __DIR__ . '/../..' . '/src/admin/class-gutenberg.php',
        'Leadin\\admin\\IframeRoutes' => __DIR__ . '/../..' . '/src/admin/class-iframeroutes.php',
        'Leadin\\admin\\Impact' => __DIR__ . '/../..' . '/src/admin/class-impact.php',
        'Leadin\\admin\\LeadinAdmin' => __DIR__ . '/../..' . '/src/admin/class-leadinadmin.php',
        'Leadin\\admin\\Links' => __DIR__ . '/../..' . '/src/admin/class-links.php',
        'Leadin\\admin\\MenuConstants' => __DIR__ . '/../..' . '/src/admin/class-menuconstants.php',
        'Leadin\\admin\\NoticeManager' => __DIR__ . '/../..' . '/src/admin/class-noticemanager.php',
        'Leadin\\admin\\PluginActionsManager' => __DIR__ . '/../..' . '/src/admin/class-pluginactionsmanager.php',
        'Leadin\\admin\\Routing' => __DIR__ . '/../..' . '/src/admin/class-routing.php',
        'Leadin\\admin\\api\\ApiGenerator' => __DIR__ . '/../..' . '/src/admin/api/class-apigenerator.php',
        'Leadin\\admin\\api\\ApiMiddlewares' => __DIR__ . '/../..' . '/src/admin/api/class-apimiddlewares.php',
        'Leadin\\admin\\api\\DisconnectApi' => __DIR__ . '/../..' . '/src/admin/api/class-disconnectapi.php',
        'Leadin\\admin\\api\\RegistrationApi' => __DIR__ . '/../..' . '/src/admin/api/class-registrationapi.php',
        'Leadin\\admin\\utils\\DeviceId' => __DIR__ . '/../..' . '/src/admin/utils/class-deviceid.php',
        'Leadin\\auth\\OAuth' => __DIR__ . '/../..' . '/src/auth/class-oauth.php',
        'Leadin\\auth\\OAuthCrypto' => __DIR__ . '/../..' . '/src/auth/class-oauthcrypto.php',
        'Leadin\\options\\AccountOptions' => __DIR__ . '/../..' . '/src/options/class-accountoptions.php',
        'Leadin\\options\\HubspotOptions' => __DIR__ . '/../..' . '/src/options/class-hubspotoptions.php',
        'Leadin\\options\\LeadinOptions' => __DIR__ . '/../..' . '/src/options/class-leadinoptions.php',
        'Leadin\\rest\\HubSpotApiClient' => __DIR__ . '/../..' . '/src/rest/class-hubspotapiclient.php',
        'Leadin\\rest\\LeadinRestApi' => __DIR__ . '/../..' . '/src/rest/class-leadinrestapi.php',
        'Leadin\\utils\\QueryParameters' => __DIR__ . '/../..' . '/src/utils/class-queryparameters.php',
        'Leadin\\utils\\RequestUtils' => __DIR__ . '/../..' . '/src/utils/class-requestutils.php',
        'Leadin\\utils\\Versions' => __DIR__ . '/../..' . '/src/utils/class-versions.php',
        'Leadin\\wp\\FileSystem' => __DIR__ . '/../..' . '/src/wp/class-filesystem.php',
        'Leadin\\wp\\Options' => __DIR__ . '/../..' . '/src/wp/class-options.php',
        'Leadin\\wp\\Page' => __DIR__ . '/../..' . '/src/wp/class-page.php',
        'Leadin\\wp\\User' => __DIR__ . '/../..' . '/src/wp/class-user.php',
        'Leadin\\wp\\Website' => __DIR__ . '/../..' . '/src/wp/class-website.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit0cb47ca110ea44491a19afe15455199a::$classMap;

        }, null, ClassLoader::class);
    }
}
