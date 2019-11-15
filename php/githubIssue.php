<?php
    session_start();
    include('utils.php');

    // validate captcha
    $captcha = validatePostVar ("g-recaptcha-response", '/.{1,}/', false, "recaptchaWidget");
    validateCaptcha ($captcha);

    if (isset($_POST["issueName"]) && isset($_POST["issueText"])) {
        $json = json_decode (sendGithubIssue ($_POST["issueName"], $_POST["issueText"]));
        if (isset($json->url)) {
            echo (json_encode (array ("success" => true, "msg" => "<A href='".$json->html_url."'>Issue Posted</a>")));
        } else {
            echo (json_encode (array ("fail" => true, "msg" => $json)));
        }
    } else {
        echo (json_encode(array ("fail" => true, "msg" => "issueName and issueText not populated")));
    }
?>