<?php foreach($items as $item): ?>
<li><?php echo $item['title'] ?> - <a class="task-list-options" onclick="fxDashboard.deleteTask(<?php echo $item['task_id'] ?>);">Delete</a> </li>    
<?php endforeach; ?>
