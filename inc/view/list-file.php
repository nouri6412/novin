<div class="chat-order">
    <table>
        <thead>
            <tr>
                <td>شماره سفارش</td>
                <td>فایل ها</td>
            </tr>
        </thead>
        <tbody>

            <?php
            while ($the_query->have_posts()) :
                $the_query->the_post();
            ?>
                <tr>
                    <td><?php echo get_the_ID() ?></td>
                    <td>
                        <a class="btn btn-outline-primary" href="<?php echo site_url('my-account/send-file?order_id=' . get_the_ID()) ?>">انتخاب</a>
                    </td>
                </tr>
            <?php
            endwhile;

            ?>
            <?php wp_reset_query(); ?>
        </tbody>
    </table>
</div>