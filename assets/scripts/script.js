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

    setCookie('time-zone', Intl.DateTimeFormat().resolvedOptions().timeZone, 1)


    $("#send_message").submit(function (event) {
        event.preventDefault();
        var post_url = $(this).attr("action");
        var request_method = $(this).attr("method");
        var form_data = $(this).serialize();
        $.ajax({
            url: post_url,
            type: request_method,
            data: form_data,
        }).done(function (res) {
            $('.msg_card_body').append(res)
            $('[name="message"]').val('')
            $board.get(0).scrollTo(0, $board.get(0).scrollHeight)
        });
    });

    $('.msg_card_body').mouseenter(function () {
        var $board = $(this)
        if ($board.outerHeight() + $board.scrollTop() >= this.scrollHeight) {
            var friend = $('[name="friend_id"]').val()
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
    $board.get(0).scrollTo(0, $board.get(0).scrollHeight)


    setInterval(function () {
        $.ajax({
            url: SITE_URL + '/chat/new-messages',
            type: "GET",
            data: {
                friend_id: $('[name="friend_id"]').val()
            }
        }).done(function (res) {
            $('.msg_card_body').html(res)
            $board.get(0).scrollTo(0, $board.get(0).scrollHeight)
        });
    }, 1000 * 5)

});

var input = document.getElementById("search");
var li = document.querySelectorAll(".active");
var spanName = document.querySelectorAll(".user-name");
var firstDiv = document.querySelector(".card-body");
var ul = document.querySelector(".contacts");
var p = document.createElement("p");
p.textContent = "No results";
p.id = 'p';
p.style.color = "black";

input.onkeyup =  function () {
    var a =  input.value.toUpperCase();
    var pTag = document.querySelector('#p');

    if(pTag){
        pTag.remove();
    }

    var q = true;

    for (var i = 0; i < li.length; i++) {
        if (spanName[i].innerText.toUpperCase().indexOf(a) !== -1) {
            li[i].style.display = "block";
            q = false;

        } else {
            li[i].style.display = "none";

        }
    }

    if(q){
        firstDiv.insertBefore(p,ul);
    }
};