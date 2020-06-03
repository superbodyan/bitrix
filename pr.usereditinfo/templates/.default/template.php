<?php
CJSCore::Init(array('ajax'));

printer($arResult);
?>

<form id="send-form" action="javascript:void(null);" onsubmit="call()" method="post">
    <input type="hidden" name="ajax_task" value="UpdateInfo">
    <input type="text" id="name" name="U_NAME" value="<?=$arResult['NAME']?>">
    <input type="text" id="name" name="U_FAMILY" value="<?=$arResult['FAMILY']?>">
    <input type="text" id="name" name="U_PHOTO" value="<?=$arResult['PERSONAL_PHOTO']?>">
    <input type="submit">
</form>

<script>
    function call() {
        var msg   = $('#send-form').serialize();
        BX.ready(function () {

            BX.ajax.post(
                '/bitrix/components/hashit/pr.usereditinfo/ajax.php',
                msg,
                function (data) {
                    console.log(data);
                }
            );


        });
    }


</script>
