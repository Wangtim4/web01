<div style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
    <span class="t" style="line-height:123px;">
        <?php
        $button = new DB('button');
        echo $button->find(1)['button'];
        ?>
    </span>
</div>