<div class="day_block">
    <div class="date_div"><?php echo $day['date']->format('l d/m'); ?></div>
    <div class="tasks">
    <?php foreach($tasks as $task): ?>
        <div class="day_task_item" style="background-color:<?php echo $task['color'] ?>"><?php echo $task['title'] ?></div>
    <?php endforeach; ?>
    </div>
</div>
