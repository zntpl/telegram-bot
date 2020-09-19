<?php

$style = '';
$style = 'style="display: none !important;"';

?>

<div class="col-md-8">
    <form id="form1">
        <div class="form-group">
            <label></label>
            <ul>
                <li><a href="?user_id=377819118&bot_id=773713470">user123</a></li>
                <li><a href="?user_id=456&bot_id=773713470">user456</a></li>
            </ul>
        </div>

        <?php if ($userId): ?>


                <!--<iframe id="messages" src="/message.php?user_id=<?/*= $userId */?>&bot_id=<?/*= $botId */?>" width="800" height="500">
                    Ваш браузер не поддерживает плавающие фреймы!
                </iframe>
                <br/>-->
            <div class="form-group">
                <div id="messageList" style="height: 500px; overflow-y: scroll;">

                </div>
            </div>



            <!--<div class="form-group">
                <label>From user</label>
                <p><?/*= $userName */?></p>
            </div>-->

            <div <?= $style ?> class="form-group">
                <label>update_id</label>
                <input name="update_id" value="<?= $updateId ?>" type="text" class="form-control">
            </div>

            <div <?= $style ?> class="form-group">
                <label>message.message_id</label>
                <input name="message[message_id]" value="<?= $messageId ?>" type="text" class="form-control">
            </div>
            <div <?= $style ?> class="form-group">
                <label>message.date</label>
                <input name="message[date]" value="<?= $date ?>" type="text" class="form-control">
            </div>
            <div class="form-group">
                <!--<label>message.text</label>-->
                <input id="messageField" name="message[text]" value="" type="text" class="form-control">
            </div>

            <div <?= $style ?> class="form-group">
                <label>message.from.id</label>
                <input name="message[from][id]" value="<?= $userId ?>" type="text" class="form-control">
            </div>
            <div <?= $style ?> class="form-group">
                <label>message.from.is_bot</label>
                <input name="message[from][is_bot]" type="checkbox" class="">
            </div>
            <div <?= $style ?> class="form-group">
                <label>message.from.first_name</label>
                <input name="message[from][first_name]" value="<?= $userName ?>" type="text" class="form-control">
            </div>
            <div <?= $style ?> class="form-group">
                <label>message.from.username</label>
                <input name="message[from][username]" value="<?= $userName ?>" type="text" class="form-control">
            </div>
            <div <?= $style ?> class="form-group">
                <label>message.from.language_code</label>
                <select name="message[from][language_code]" class="form-control">
                    <option value="ru">ru</option>
                    <option value="en">en</option>
                </select>
            </div>

            <div <?= $style ?> class="form-group">
                <label>message.chat.id</label>
                <input name="message[chat][id]" value="<?= $chatId ?>" type="text" class="form-control">
            </div>
            <div <?= $style ?> class="form-group">
                <label>message.chat.first_name</label>
                <input name="message[chat][first_name]" value="<?= $chatName ?>" type="text" class="form-control">
            </div>
            <div <?= $style ?> class="form-group">
                <label>message.chat.username</label>
                <input name="message[chat][username]" value="<?= $userName ?>" type="text" class="form-control">
            </div>
            <div <?= $style ?> class="form-group">
                <label>message.chat.type</label>
                <input name="message[chat][type]" value="<?= $chatType ?>" type="text" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary mb-2">Send</button>
        <?php endif; ?>
    </form>
</div>

<div class="col-md-4">

</div>

<script>

    (function ($) {

        var updateMessageList = function() {
            $.ajax({
                type: "GET",
                url: '/message.php?user_id=<?= $userId ?>&bot_id=<?= $botId ?>',
                success: function (data, textStatus, jqXHR) {
                    $('#messageList').html(data);
                    var element = document.getElementById("messageList");
                    element.scrollTop = element.scrollHeight;
                    /*if (data == '' && jqXHR.status == 200) {
                        toastr.success('OK');
                        $('#messages').attr('src', $('#messages').attr('src'));
                        //$("#messages").contentWindow.scrollTo(10000,0);
                        $('#messageField').val('');
                    } else {
                        toastr.error("<h4>Error</h4>" + data);
                    }*/
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                    toastr.error('<h4>' + textStatus + ': ' + errorThrown + '</h4>' + jqXHR.responseText);
                }
            });
        };

        $('#form1').submit(function (e) {
            //toastr.info('Sending...');
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                type: "POST",
                data: data,
                url: '/bot.php?token=<?= $botConfig['token'] ?>',
                success: function (data, textStatus, jqXHR) {
                    if (data == '' && jqXHR.status == 200) {
                        toastr.success('OK');
                        $('#messages').attr('src', $('#messages').attr('src'));
                        //$("#messages").contentWindow.scrollTo(10000,0);
                        $('#messageField').val('');
                        updateMessageList();
                    } else {
                        toastr.error("<h4>Error</h4>" + data);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                    toastr.error('<h4>' + textStatus + ': ' + errorThrown + '</h4>' + jqXHR.responseText);
                }
            });

        });

        updateMessageList();

    })(jQuery);

</script>
