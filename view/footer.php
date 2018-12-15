</div>

<script src="<?= SITE_URL ?>/assets/scripts/jquery.min.js"></script>
<script src="<?= SITE_URL ?>/assets/scripts/emojionearea.min.js"></script>


<script src="<?= SITE_URL ?>/assets/scripts/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '<?= FACEBOOK_APP_ID ?>',
            cookie: true,
            xfbml: true,
            version: 'v3.2'
        });

        FB.AppEvents.logPageView();
    };

    function checkLoginState() {
        FB.getLoginStatus((response) => {
            if (response.status === 'connected') {
                const accessToken = response.authResponse.accessToken
                window.location.href = window.location.pathname + '?fb_token=' + accessToken
            } else if (response.status === 'not_authorized') {
                console.warn(`Auth error ${response.status}`)
            }
        })
        return false
    }

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>



<script>
    var GoogleAuth;
    var SCOPE = 'https://www.googleapis.com/auth/drive.metadata.readonly';
    function handleClientLoad() {
        // Load the API's client and auth2 modules.
        // Call the initClient function after the modules load.
        gapi.load('client:auth2', initClient);
    }

    function initClient() {
        // Retrieve the discovery document for version 3 of Google Drive API.
        // In practice, your app can retrieve one or more discovery documents.
        var discoveryUrl = 'https://www.googleapis.com/discovery/v1/apis/drive/v3/rest';

        // Initialize the gapi.client object, which app uses to make API requests.
        // Get API key and client ID from API Console.
        // 'scope' field specifies space-delimited list of access scopes.
        gapi.client.init({
            'apiKey': '<?= GOOGLE_SECRET?>',
            'discoveryDocs': [discoveryUrl],
            'clientId': '<?= GOOGLE_CLIENT_ID ?>',
            'scope': SCOPE
        }).then(function () {
            GoogleAuth = gapi.auth2.getAuthInstance();

            // Listen for sign-in state changes.
            GoogleAuth.isSignedIn.listen(updateSigninStatus);

            // Handle initial sign-in state. (Determine if user is already signed in.)
            var user = GoogleAuth.currentUser.get();
            setSigninStatus();

            // Call handleAuthClick function when user clicks on
            //      "Sign In/Authorize" button.
        });
    }

    GoogleAuth.signIn();
    GoogleAuth.isSignedIn.listen(updateSigninStatus);


    function handleAuthClick() {
        if (GoogleAuth.isSignedIn.get()) {
            // User is authorized and has clicked 'Sign out' button.
            GoogleAuth.signOut();
        } else {
            // User is not signed in. Start Google auth flow.
            GoogleAuth.signIn();

        }
    }

    function revokeAccess() {
        GoogleAuth.disconnect();
    }

</body>
</html>