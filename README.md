#Campaign Monitor integration plugin

Thanks to Alexey Bobkov and Samuel Georges who wrote the MailChimp plugin. All I've done is adapt their good work to use the Campaign Monitor API.

This plugin implements the Campaign Monitor subscription form functionality for the [OctoberCMS](http://octobercms.com).

## Configuring

If you're installing this plugin manually, simply copy the contents of this directory to:

/plugins/ctmh/campaignmonitor/

In order to use the plugin you need to get the API key from your [Campaign Monitor account](https://your-profile.createsend.com/admin/account/).

1. In the OctoberCMS back-end go to the System / Settings page and click the Campaign Monitor link. 
2. Paste the API key in the **Campaign Monitor API key** field.

## Creating the Signup form

You can put the Campaign Monitor signup form on any front-end page. Add the Campaign Monitor Signup Form component to a page or layout. Click the added component and paste your Campaign Monitor list identifier in the **MailChimp List ID** field. Close the Inspector and save the page. 

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

##PS

I'm using this in production, and haven't encountered any issues. If you have any problems, feel free to contact me (especially if you have to fix anything yourself).