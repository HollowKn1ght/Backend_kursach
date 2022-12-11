<?php
use App\Models\DataBase;

$upload = DataBase::connToDB()->query("SELECT up.*,concat(u.firstname,' ',u.lastname) as name,u.avatar FROM uploads up inner join users u on u.id =up.user_id where up.code = '{$_GET['code']}' ");
foreach ($upload->fetch_array() as $k => $v) {
	$$k = $v;
}
?>

<style>
ul {
	list-style-type: none;
}

.comment-row {
	border-bottom: #e0dfdf 1px solid;
	margin-bottom: 15px;
	padding: 10px;
}

.outer-comment {
	background: #F0F0F0;
	padding: 10px;
	border: #dedddd 1px solid;
	border-radius: 4px;
}

.comment-info {
	font-size: 0.9em;
	padding: 0 0 10px 0;
}

#comment-message {
	margin-left: 20px;
	color: #005e00;
	display: none;
}
</style>

<hr>
<div class="col-md-12">
    <div class="row">
        <div style="width:50px">
            <?php if (!empty($avatar)): ?>
            <img src="assets/uploads/<?php echo $avatar ?>" class="rounded-circle" width="50px" height="50px" alt="">
            <?php else: ?>
            <span class="d-flex justify-content-center bg-primary align-items center rounded-circle border py-2 px-3">
                <h3 class="text-white m-0"><b>
                        <?php echo substr($name, 0, 1) ?>
                </h3></b>
            </span>
            <?php endif; ?>
        </div>
        <div class="col">
            <form id="frm-comment" style="margin-bottom:20px">
                <div class="form-group">
                    <textarea class="form-control" name="comment" id="comment" style="min-height:35px"
                        placeholder="Your comment here"></textarea>
                </div>
                <div class="d-flex">
                    <input type="button" id="submitButton" value="Publish"/>
                    <div class="my-auto" id="comment-message" style="margin-left: 10px">Comment added successfully.</div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="output"></div>
<script>
    $("#submitButton").click(function () {
        $("#comment-message").css('display', 'none');

        $.ajax({
            url: "../../app/Controllers/comment-add.php",
            data: {
                "user_id": "<?php echo $_SESSION['login_id']?>",
                "comment": $("#comment").val(), 
                "comment_sender_name": "<?php echo $_SESSION['login_firstname'] . " " . $_SESSION['login_lastname']?>",
                "upload_id": <?php echo $id ?>
            },
            type: 'post',
            success: function (resp) {
                $("#comment-message").css('display', 'inline-block');
                $("#comment").val("");
                $("#commentId").val("");
                listComment();
            },
            error: function (resp) {
                alert("Failed to add comments !");
                return false;
            }
        });
    });

    $(document).ready(function () {
        listComment();
    });

    function listComment() {
        $.post("../../app/Controllers/comment-list.php", {"upload_id": <?php echo $id ?>},
            function (data) {
                if(data != null){
                    data = JSON.stringify(data);
                    var data = JSON.parse(data);

                    var comments = "";
                    var replies = "";
                    var item = "";
                    var parent = -1;
                    var results = new Array();

                    var list = $("<ul class='outer-comment'>");
                    var item = $("<li>").html(comments);

                    for (var i = 0; (i < data.length); i++) {
                        var commentId = data[i]['comment_id'];

                        comments = "<div class='comment-row'>" +
                            "<div class='comment-info'><span class='comment-row-label'>from</span> <span class='posted-by'><b>" + data[i]['comment_sender_name'] + " </b></span> <span class='comment-row-label'>at</span> <span class='posted-at'>" + data[i]['comment_at'] + "</span></div>" +
                            "<div class='comment-text'>" + data[i]['comment'] + "</div>" +
                            "</div>";

                        var item = $("<li>").html(comments);
                        list.append(item);
                        var reply_list = $('<ul>');
                    }
                    $("#output").html(list);
                }
                
        }, "json");
    }
</script>