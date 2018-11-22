jQuery(document).ready(function () {
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    setCookie('time-zone', Intl.DateTimeFormat().resolvedOptions().timeZone, 1);


    $("#send_message").submit(function (event) {
        event.preventDefault();
        var post_url = $(this).attr("action");
        // console.log(post_url);
        var request_method = $(this).attr("method");
        var form_data = $(this).serialize();
        $.ajax({
            url: post_url,
            type: request_method,
            data: form_data,
        }).done(function (res) {
            $('.msg_card_body').append(res);
            $('[name="message"]').val('');
            $board.get(0).scrollTo(0, $board.get(0).scrollHeight)
        });
    });

    $('.msg_card_body').mouseenter(function () {
        var $board = $(this);
        if ($board.outerHeight() + $board.scrollTop() >= this.scrollHeight) {
            var friend = $('[name="friend_id"]').val();
            $.ajax({
                url: SITE_URL + '/chat/seen',
                type: 'get',
                data: {
                    friend_id: friend
                }
            })
        }
    });

    var $board = $('.msg_card_body')
    $board.get(0).scrollTo(0, $board.get(0).scrollHeight);


    setInterval(function () {
        $.ajax({
            url: SITE_URL + '/chat/new-messages',
            type: "GET",
            data: {
                friend_id: $('[name="friend_id"]').val()
            }
        }).done(function (res) {
            $('.msg_card_body').html(res);
            $board.get(0).scrollTo(0, $board.get(0).scrollHeight)
        });
    }, 1000 * 5);

    var ajax;
    $('#search').keyup(function (ev) {
        ev.preventDefault();
        var txt = $(this).val();
        // console.log(txt);
        if(ajax){
            ajax.abort()
        }
        ajax = $.ajax({
            url: SITE_URL + '/chat/search',
            method: "post",
            data: {
                search: txt
            },
            dataType: "text",
        }).done(function (data) {
            $('.contacts_body').html(data);
        });
    })
});