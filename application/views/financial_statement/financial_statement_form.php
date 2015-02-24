<style>
.nav a{
color: #777;
}
.nav-tabs.nav-justified>.active>a, .nav-tabs.nav-justified>.active>a:hover, .nav-tabs.nav-justified>.active>a:focus{border: 1px solid #999; border-bottom-color: #fff;color: Green;}
.nav-tabs.nav-justified>li>a {
border-bottom: 1px solid #999; border-radius: 4px 4px 0 0;}
</style>
<?php $body_tab = ''; ?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<i class="glyphicon glyphicon-list-alt"></i> <?php echo $this->lang->line('Fiancial Statement');?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo anchor('Home.html',$this->lang->line('HOME'));?></li>
			<li class="active"><?php echo $this->lang->line(@$Top_menu->menu_name);?></li>
			<li class="active"><?php echo $this->lang->line('Fiancial Statement');?></li>
		</ol>
	</div>
</div>
<!--Tabs -->
        <div class="row">
            
            <div class="col-lg-12">

                <ul id="myTab" class="nav nav-tabs nav-justified">
                <?php $i=0; foreach ($arr_fin as $row): $i++;?>
                	<!--Title Financial ------------------------------------------------------->
                	<li class="<?php echo ($i==1?'active':'')?>">
                		<a href="#tab<?php echo $i?>" data-toggle="tab">
                			<i class="glyphicon glyphicon-calendar"></i> <?php echo ($this->session->userdata('lang_id')!='th'?($row['year']-543):$row['year'])?>
                		</a>
                	</li>
                	<!--/Title Financial ------------------------------------------------------->
                	<?php 
                	//@set Body Financial ---------------------------------------------
                	$body_tab .= '<div class="tab-pane fade '.($i==1?'active in':'').'" id="tab'.$i.'" style="padding:15px;">';
                	$body_tab .= '<table class="table table-hover">';
                	$body_tab .= '<tbody>';
                	foreach ($row['financial_upload'] as $row2){
                		$body_tab .= '<tr>';
                		$body_tab .= '<td><i class="glyphicon glyphicon-list-alt"></i> '.$row2['text'].'</td>';
                		$body_tab .= '<td>'.anchor($row2['url_file'],'<i class="glyphicon glyphicon-download-alt"></i>'.$this->lang->line('download')).'</td>';
                		$body_tab .= '</tr>';
                	}
                	$body_tab .= '</tbody>';
                	$body_tab .= '</table>';
                	$body_tab .= '</div>';
                	//------------------------------------------------------------------
                	?>
                <?php endforeach;?>
                
                <!--Title Old Financial -->
                <?php if(count($arr_fin_archive)>0):?>
                    <li class=""><a href="#tab-archive" data-toggle="tab"><i class="glyphicon glyphicon-calendar"></i> <?php echo $this->lang->line('archive');?></a></li>
                <?php endif;?>
                <!--/Title Old Financial -->
                </ul>

                <div id="myTabContent" class="tab-content">
                	<!-- Body Financial -->
                	<?php echo $body_tab;?>
                	<!-- /Body Financial -->
                	
                	<!-- Old Financial -->
                	<?php if(count($arr_fin_archive)>0):?>
                    <div class="tab-pane fade" id="tab-archive" style="padding:15px;">
                    	<?php foreach ($arr_fin_archive as $row_a):?>
                    		<h4><?php echo ($this->session->userdata('lang_id')!='th'?($row_a['year']-543):$row_a['year'])?></h4>
                    		<table class="table table-hover">
								<tbody>
									<?php foreach ($row_a['financial_upload'] as $row_a2):?>
									<tr>
										<td><i class="glyphicon glyphicon-list-alt"></i> <?php echo $row_a2['text']?></td>
										<td><?php echo anchor($row_a2['url_file'],'<i class="glyphicon glyphicon-download-alt"></i>'.$this->lang->line('download')) ?></td>
									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
                    	<?php endforeach;?>
                        
                    </div>
                    <?php endif;?>
					<!-- /Old Financial -->
                </div>
                <!-- /myTabContent -->
            </div>
        </div>