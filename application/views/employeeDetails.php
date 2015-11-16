<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="<?php echo base_url(); ?>css/homepageCSS.css" type="text/css" rel="stylesheet">    
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>

<body style="background-color: white;">
    <div class="outer-div">
	<div class="actual-body">
            <div class="header">
                <h2> Project Management </h2>
                <div class="setting">
                    <a href="<?php echo site_url("Welcome/setting"); ?>" > <span style="color:#666666;"><span class="glyphicon glyphicon-cog "></span> Settings</span></a>
                </div>
            </div>
            <div class="left-pane">
                <h4><center>Project Members</center></h4>   
                <div class="set-margin"></div>
                <?php
                     foreach($names as $row){
                ?>
                <div  class="list-group-item backcolor ">
                    <a href="<?php echo site_url("Welcome/getTaskDetails/$row->member_id");?>">
                    <?php echo $row->member_fname." ".$row->member_lastname; ?>
                    </a>
                </div>
                <?php }   ?>
            </div>
            
            <?php
                if($member!=null){
                     foreach($member as $row){       
            ?>
            
                <div class="photo">
                    <img src="<?php echo base_url(); ?>imgs/<?php echo $row->member_id ?>.jpg"  style="height: 100%;width: 100%;" alt=""/>
                </div>
                <div class="name-section">
                    <h3>
                        <?php echo $row->member_lastname ?>,
                        <?php echo $row->member_fname ?>
                    </h3>
                </div>
                <?php
                    }
                ?>

                <div class="report-button">
                    <input type="button"  value="Create Report" style="background-color:#666666;color:white;"/>
                </div>
            
            <?php
                }
                if($member!=null){
            ?>
                <div class="table-section">
                    <?php 
                        if($tasks==null){
                            echo " <strong> <h3> No tasks assigned!! </h3> </strong>";
                        }
                        else{
                    ?>
                    <table class="table table-striped table-bordered table-hover table-condensed fixed_width">
                        <col width="40%" />
                        <tr>
                            <th><center>Task</center></th>
                            <th><center>Start Date</center></th>
                            <th><center>End Date</center></th>
                            <th><center>Estimated Hours</center></th>
                            <th><center>Hours Spend</center></th>
                            <th><center>Schedule Variance</center></th>
                        </tr>
                        <?php
                           foreach($tasks as $row){  
                               $variance = (($row->EstimatedHours - $row->HoursSpent)/$row->HoursSpent);
                        ?>
                        <tr>
                            <td> <?php echo $row->Task;?> </td>
                            <td> <?php echo $row->StartDate;?> </td>
                            <td> <?php echo $row->EndDate;?> </td>
                            <td> <?php echo $row->EstimatedHours;?> </td>
                            <td> <?php echo $row->HoursSpent;?> </td>
                            <td> <?php echo round($variance,2);?>% </td>
                        </tr>     
                        <?php 

                            }
                        ?>  
                    </table>
                                
                    <div>


                        </div>
                        <div  class="pagination-adjust" id="pagination">
                            <div class="tsc_pagination">
                                <?php foreach ($links as $row) {
                                echo  $row ."\r";
                                } ?>
                            </div>
                        </div>

                </div>


                <?php
                        }
                    }
                ?>
			
        </div>
    </div>
    
</body>

</html>
