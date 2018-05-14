<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Push Notification</title>

    <link rel="manifest" href="/manifest.json">
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(["init", {
            appId: "{{ env("ONESIGNAL_APP_ID") }}",
            autoRegister: false,
            notifyButton: {
                enable: true
            },
            promptOptions: {
                siteName: "Webpush Notification",
                actionMessage: "Bật thông báo?",
                acceptButtonText: "ĐỒNG Ý",
                cancelButtonText: "KHÔNG, CẢM ƠN",
            }
        }]);
        OneSignal.push(function() {
            OneSignal.showHttpPrompt();
        });
    </script>
</head>
<body>

</body>
</html>
