<?php include("_header.php") ?>
<script>
    var fxDashboard = new Object();
    
    //load days
    fxDashboard.loadCalendar = function() {
        $.post("<?php echo site_url('dashboard/getDays') ?>", { startDate: "<?php echo $startDate->format('Y-m-d') ?>", endDate: "<?php echo $endDate->format('Y-m-d') ?>" },
            function(data){
              $('#days_area').html(data);
            }, "html");
    };

    //load project list
    fxDashboard.loadProjects = function() {
        $.post("<?php echo site_url('Project/getAll') ?>", {},
            function(data){
            $('#projects_list').html(data);
            }, "html");
    };
    
    //load task list
    fxDashboard.loadTasks = function() {
        $.post("<?php echo site_url('task/getAll') ?>", {},
            function(data){
            $('#tasks_list').html(data);
            }, "html");
    };
    
    $(document).ready(function() {
        //project form
        $('#project_form').ajaxForm({
            target: '#project_form_output',
            success: fxDashboard.loadProjects
            
        });
        //task form
        $('#task_form').ajaxForm({
            target: '#task_form_output',
            success: function() {
                fxDashboard.loadTasks;
                fxDashboard.loadCalendar();
            }
        });
        
        $( "#due_date" ).datepicker({
            dateFormat: 'yy-mm-dd'
        });
        
        fxDashboard.loadCalendar();
        fxDashboard.loadProjects();
        fxDashboard.loadTasks();
    });
</script>
<div id="days_area"></div>

<div style="clear:both;padding-top:30px;"></div>

<h2>Tasks</h2>
<li id="tasks_list"></li>

<h2>New Task</h2>
<div id="task_form_output"></div>
<?php 
$attributes = array('class' => '', 'id' => 'task_form');
echo form_open('task', $attributes); ?>
<p>
    <label for="title">title <span class="required">*</span></label>
    <?php echo form_error('title'); ?>
    <br /><input id="title" type="text" name="title" maxlength="255" value="<?php echo set_value('title'); ?>"  />
</p>
<p>
    <label for="description">description</label>
    <?php echo form_error('description'); ?>
    <br />							
    <?php echo form_textarea( array( 'name' => 'description', 'rows' => '5', 'cols' => '80', 'value' => set_value('description') ) )?>
</p>
<p>
    <label for="due_date">date</label>
    <?php echo form_error('due_date'); ?>
    <br /><input id="due_date" type="text" name="due_date"  value="<?php echo set_value('due_date'); ?>"  />
</p>
<p>
    <label for="project">project</label>
    <?php echo form_error('project'); ?>
    <br />
    <select id="project" name="project">
        <?php foreach($projects as $project): ?>
        <option value="<?php echo $project->id ?>" selected="<?php echo set_value('project') == $project->id ? 'selected' : '' ?>"><?php echo $project->name ?></option>
        <?php endforeach; ?>
    </select>
</p>

<p>
    <?php echo form_submit( 'submit', 'Submit'); ?>
</p>
<?php echo form_close(); ?>

<h2>Projects</h2>
<li id="projects_list">
</li>

<h2>New Project</h2>
<div id="project_form_output"></div>
<?php
$attributes = array('class' => '', 'id' => 'project_form');
echo form_open('Project', $attributes); ?>
<p>
    <label for="name">name <span class="required">*</span></label>
    <?php echo form_error('name'); ?>
    <br /><input id="name" type="text" name="name" maxlength="255" value="<?php echo set_value('name'); ?>"  />
</p>

<p>
    <label for="color">color <span class="required">*</span></label>
    <?php echo form_error('color'); ?>
    <br /><input id="color" type="color" name="color" maxlength="255" value="<?php echo set_value('color'); ?>"  />
</p>


<p>
    <?php echo form_submit( 'submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>

<?php include("_footer.php") ?>