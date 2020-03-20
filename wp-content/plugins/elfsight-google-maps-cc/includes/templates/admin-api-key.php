<article class="elfsight-admin-page-api-key elfsight-admin-page" data-elfsight-admin-page-id="api-key">
    <div class="elfsight-admin-page-api-key-container">
        <form class="elfsight-admin-page-api-key-form">
            <div class="elfsight-admin-page-api-key-form-image"></div>

            <h4 class="elfsight-admin-page-api-key-form-title-connect elfsight-admin-page-api-key-form-title">Set your Google Maps API Key</h4>
            <h4 class="elfsight-admin-page-api-key-form-title-success elfsight-admin-page-api-key-form-title">Your Google Maps API Key</h4>
            <h4 class="elfsight-admin-page-api-key-form-title-fail elfsight-admin-page-api-key-form-title">Your Google Maps API Key is not valid</h4>

            <div class="elfsight-admin-page-api-key-form-description-wrapper">
                <span class="elfsight-admin-page-api-key-form-description elfsight-admin-page-api-key-form-description-connect">
                    Setting your own Google Maps API Key is neccessary due to the changes of Google Maps policy that come into effect on July 16, 2018. Find out more at <a href="https://mapsplatform.googleblog.com/2018/05/introducing-google-maps-platform.html" target="_blank" rel="nofollow">link</a>.<br><br>
                    The following tutorial explains how to get your API Key in an easy way: <a target="_blank" href="https://elfsight.com/blog/2018/06/how-to-get-google-maps-api-key-guide/">How to get Google Maps API Key</a>
                </span>
                <span class="elfsight-admin-page-api-key-form-description elfsight-admin-page-api-key-form-description-success">You have set a valid Google Maps API Key and your plugin is working correctly now.</span>
                <span class="elfsight-admin-page-api-key-form-description elfsight-admin-page-api-key-form-description-fail">
                    Please make sure that you've set a valid Google Maps API Key. <br><br>
                    Follow the steps of this tutorial to get your API Key: <a target="_blank" href="https://elfsight.com/blog/2018/06/how-to-get-google-maps-api-key-guide/">How to get Google Maps API Key</a>
                </span>
            </div>

            <input class="elfsight-admin-page-api-key-form-input" value="<?php echo elfsight_google_maps_get_api_key(); ?>" data-nonce="<?php echo wp_create_nonce('elfsight_google_maps_update_api_key_nonce'); ?>" type="text" placeholder="Google Maps API Key">

            <a class="elfsight-admin-button elfsight-admin-button-large elfsight-admin-button-green elfsight-admin-page-api-key-form-button elfsight-admin-page-api-key-form-button-connect" href="javascript:void(0)">Save API key</a>

            <div class="elfsight-admin-page-api-key-form-error-empty">Google Maps API Key is not specified</div>
            <div class="elfsight-admin-page-api-key-form-reload">This page will be reload at few seconds..</div>
        </form>
    </div>
</article>