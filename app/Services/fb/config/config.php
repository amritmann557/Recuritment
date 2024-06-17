<?php
$appDetails = Helper::getAppDetails();
$fb_app_id = $appDetails[0]->fbAppId;
$fb_app_secret = $appDetails[0]->fbAppSecret;
$fb_api_version = $appDetails[0]->fbApiVersion;
$fb_scope = $appDetails[0]->fbScope;
$fb_access_token=$appDetails[0]->fbAccessToken;
