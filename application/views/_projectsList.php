<?php foreach($projects as $project): ?>
<li><?php echo $project->name; ?>  - <a class="task-list-options" onclick="fxDashboard.deleteProject(<?php echo $project->id ?>);">Delete</a> </li>    </li>    
<?php endforeach; ?>
