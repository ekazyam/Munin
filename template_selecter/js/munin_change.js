$(document).ready(function()
{
	var MSG_ASK = "テンプレートを変更しますか？";
	var MSG_INFO = "テンプレートを更新しました。";
	var MSG_ERR = "更新に失敗しました。";

        $('#change').click(function() {
		var select_template = $("input[name='munin_radio']:checked").val();
                alertify.confirm(MSG_ASK , function (e) {
                if (e) {
                        $.post("cmd_exe.php",
                        {
                                "munin_radio": select_template
                        },function(response){
                                alertify.success( MSG_INFO);
                        });
                }
                });
                // ボタンを押してからフォーカスを外す
                this.blur();
                return false;
        });
});
