#Campaign Monitor integration plugin

Thanks to Alexey Bobkov and Samuel Georges who wrote the MailChimp plugin. All I've done is adapt their good work to use the Campaign Monitor API.

This plugin implements the Campaign Monitor subscription form functionality for the [OctoberCMS](http://octobercms.com).

## Dependencies

This plugin requires the [OctoberCMS Framework Extras](https://octobercms.com/docs/cms/ajax) be included within your page or layout.

Add the following markup to your layout or page after the `{scripts}` declaration.

    {% framework extras %}

## Configuring

If you're installing this plugin manually, simply copy the contents of this directory to:

/plugins/ctmh/campaignmonitor/

In order to use the plugin you need to get the API key from your [Campaign Monitor account](https://your-profile.createsend.com/admin/account/).

1. In the OctoberCMS back-end go to the System / Settings page and click the Campaign Monitor link. 
2. Paste the API key in the **Campaign Monitor API key** field.

## Creating the Signup form

You can put the Campaign Monitor signup form on any front-end page. Add the Campaign Monitor Signup Form component to a page or layout. Click the added component and paste your Campaign Monitor list identifier in the **Campaign Monitor List ID** field. Close the Inspector and save the page. 

The simplest way to add the signup form is to use the component's default partial and the `{% component %}` tag. Add it to a page or layout where you want to display the form:

    {% component 'mailSignup' %}

If the default partial is not suitable for your website, replace the component tag with custom code, for example:

    <form
        id="subscribe-form"
        data-request="mailSignup::onSignup"
        data-request-update="'mailSignup::result': '#subscribe-form'"
    >
        <input type="text" name="email" placeholder="Newsletter subscription">
        <input type="submit" class="btn btn-default" value="Subscribe"/>
    </form>

The example uses the standard partial mailSignup::result for displaying the subscription confirmation message. If you don't like the standard message you can create your own partial in your theme and specify its name in the `data-request-update` attribute. The default partial is located in `plugins/ctmh/campaignmonitor/components/signup/result.htm`.

That's it!

##Gotchas
The plugin does not work from within a partial, it must be included in a layout. 

However you can work around this by adding the component to your parent layout, but not inserting the code into the page.

This will allow you to the in include the component again within your partial, and it will then work just fine.

**Please note that the latest version of this plugin has been updated to work with the October Release Candidate only. I cannot guarantee this will be backwards compatible with older versions.**

##PS

This plugin uses [semantic versioning](http://semver.org/).