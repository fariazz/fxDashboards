<?php foreach($projects as $project): ?>
<div style="background-color: <?php echo $project->color ?>;"><?php echo $project->name; ?>  - <a class="task-list-options" onclick="fxDashboard.deleteProject(<?php echo $project->id ?>);">Delete</a> </div>    
<?php endforeach; ?>
