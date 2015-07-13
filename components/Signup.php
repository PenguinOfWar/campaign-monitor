<?php namespace ctmh\CampaignMonitor\Components;

use Validator;
use Cms\Classes\ComponentBase;
use October\Rain\Support\ValidationException;
use ctmh\CampaignMonitor\Models\Settings;
use System\Classes\ApplicationException;

class Signup extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Signup Form',
            'description' => 'Sign up a new person to a mailing list.'
        ];
    }

    public function defineProperties()
    {
        return [
            'list' => [
                'title'       => 'Campaign Monitor List ID',
                'description' => 'You can find any list ID via running the "Getting Subscriber Lists" method, or by heading into any list in your account and clicking the "change name/type" link below your list name.',
                'type'        => 'string'
            ]
        ];
    }

    public function onSignup()
    {
        $settings = Settings::instance();
        if (!$settings->api_key)
            throw new ApplicationException('CampaignMonitor API key is not configured.');

        /*
         * Validate input
         */
        $data = post();

        $rules = [
            'email' => 'required|email|min:2|max:64',
            'name' => 'required|min:2|max:64',
        ];

        $validation = Validator::make($data, $rules);
        if ($validation->fails())
            throw new ValidationException($validation);

        /*
         * Sign up to CampaignMonitor via the API
         */
        require_once(plugins_path() . '/ctmh/campaignmonitor/vendor/campaignmonitor/csrest_subscribers.php');
        
        $auth = array('api_key' => $settings->api_key);

        $this->page['error'] = null;
        
        $wrap = new \CS_REST_Subscribers($this->property('list'), $auth);
        
        $result = $wrap->add(array(
		    'EmailAddress' => post('email'),
		    'Name' => post('name'),
		    'Resubscribe' => true
		));
		
		if( !$result->was_successful() ) {
		    $this->page['error'] = $result->response->Message;
		}

    }

}