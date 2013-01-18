<div class="day_block">
    <div class="date_div"><?php echo $day['date']->format('l d/m'); ?></div>
    <div class="tasks">
    <?php foreach($tasks as $task): ?>
        <div class="day_task_item" id="task-name-<?php echo $task['task_id'] ?>" onclick="fxDashboard.toggleTaskOptions(<?php echo $task['task_id'] ?>);" style="background-color:<?php echo $task['is_completed'] ?'#00FF00' : $task['color'] ?>"><?php echo $task['title'] ?></div>
        <div class="task-options" id="task-options-<?php echo $task['task_id'] ?>">
            <a class="task-option-delete" onclick="fxDashboard.deleteTask(<?php echo $task['task_id'] ?>);">Delete</a>
            <a class="task-option-complete" onclick="fxDashboard.toggleTaskCompletion(<?php echo $task['task_id'] ?>);"><?php echo $task['is_completed'] ? 'Reopen' : 'Close' ?></a></div> 
    <?php endforeach; ?>
    </div>
</div>
