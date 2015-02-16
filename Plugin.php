<?php namespace ctmh\CampaignMonitor;

/**
 * The plugin.php file (called the plugin initialization script) defines the plugin information class.
 */

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'Campaign Monitor',
            'description' => 'Provides Campaign Monitor integration services.',
            'author'      => 'Darryl Walker (thanks to Alexey Bobkov, Samuel Georges)',
            'icon'        => 'icon-envelope'
        ];
    }

    public function registerComponents()
    {
        return [
            '\ctmh\CampaignMonitor\Components\Signup' => 'mailSignup'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Campaign Monitor',
                'icon'        => 'icon-envelope',
                'description' => 'Configure Campaign Monitor API access.',
                'class'       => 'ctmh\CampaignMonitor\Models\Settings',
                'order'       => 600
            ]
        ];
    }

}