<div class="chat-box-send m-2">
    <div class="row">
        <div class="col-6">
            <form data-target="file" data-order-id="<?php echo $order_id; ?>" data-href="<?php echo site_url('my-account/send-file?order_id=' . $order_id) ?>" data-type="chat" id="myform" class="form" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" id="order_id" name="order_id" value="<?php echo $order_id; ?>">
                <input style="display: none;" type="file" name="myfilefield" id="myfilefield" class="form-control" value="">
                <div onclick="$('#myfilefield').click()" class="btn btn-warning  col-12 mt-2">بارگذاری فایل </div>
                <div class="spinner-border" style="display:none ;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <!-- <button type="submit" class="btn btn-success mt-2">بارگذاری فایل</button> -->
                <?php wp_nonce_field('myuploadnonce', 'mynonce'); ?>
            </form>
        </div>
        <div class="col-6">
            <form action="<?php echo site_url('my-account/send-file?order_id=' . $order_id) ?>" method="post">
                <div class="row p-2">
                    <textarea id="chat-message-body" name="chat-message-body" class="col-12"></textarea>
                </div>
                <button onclick="send_chat_message_body()" class="btn btn-outline-primary m-2">ارسال متن</button>
            </form>
        </div>
    </div>
</div>
<div class="chat-box m-2">
    <?php

    foreach ($chats as $chat) {
        $class = "";

        $user_name = "";

        if ($me_type = 3) {
            $class = "left";
            if ($designer_id == $chat["user_id"]) {
                $user_name = "طراح";
            } else if ($sender_id == $chat["user_id"]) {
                $user_name = "سفارش دهنده";
            }
            else
            {
                $user_name = "من"; 
                $class = "right";
            }

         
        }

        if ($designer_id == $chat["user_id"] && $me_type = 1) {
            $user_name = "من";
            $class = "right";
        } else if ($designer_id != $chat["user_id"] && $me_type = 1) {
            $user_name = "سفارش دهنده";
            $class = "left";
        }else if ($sender_id == $chat["user_id"] && $me_type = 2) {
            $user_name = "من";
            $class = "right";
        } else if ($sender_id != $chat["user_id"] && $me_type = 2) {
            $user_name = "طراح";
            $class = "left";
        }

    


        if ($chat["type"] == "text") {
    ?>
            <div class="chat-text chat-message <?php echo $class; ?> m-2">
                <div class="chat-info">
                    <div class="chat-text-date"><?php echo gregorian_to_jalali($chat["date"]); ?></div>
                    <div class="chat-text-user"><?php echo $user_name; ?></div>
                </div>
                <div class="chat-text-body"><?php echo $chat["body"]; ?></div>
            </div>
        <?php
        } else {
        ?>
            <div class="chat-img chat-message <?php echo $class; ?> m-2">
                <div class="chat-info">
                    <div class="chat-text-date"><?php echo gregorian_to_jalali($chat["date"]); ?></div>
                    <div class="chat-text-user"><?php echo $user_name; ?></div>
                </div>
                <div class="chat-text-img"><a target="_blank" href="<?php echo wp_get_attachment_url($chat["img"]); ?>"><img src="<?php echo wp_get_attachment_url($chat["img"]); ?>" /></a></div>
            </div>
    <?php
        }
    }
    ?>
</div>