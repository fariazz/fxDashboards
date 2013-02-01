<?php foreach($items as $item): ?>
<div style="background-color: <?php echo $item['color'] ?>;"><?php echo $item['title'] ?> - <a class="task-list-options" onclick="fxDashboard.deleteTask(<?php echo $item['task_id'] ?>);">Delete</a> </div>    
<?php endforeach; ?>
