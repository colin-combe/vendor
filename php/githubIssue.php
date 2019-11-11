<?php
    session_start();
    include('utils.php');

    // validate captcha
    $captcha = validatePostVar ("g-recaptcha-response", '/.{1,}/', false, "recaptchaWidget");
    validateCaptcha ($captcha);

    if (isset($_POST["issueName"]) && isset($_POST["issueText"])) {
        $json = sendGithubIssue ($_POST["issueName"], $_POST["issueText"]);
        echo ($json);
    } else {
        echo (json_encode(array ("error" => "issueName and issueText not populated")));
    }
?>