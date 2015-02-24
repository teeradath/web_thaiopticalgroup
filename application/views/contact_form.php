<style>
.title-contact{
	font-family:"Fjalla One";
	font-weight:normal;
	text-decoration: underline;
}
</style>
<div class="alert alert-success alert-top" role="alert" id="text-pop" style="display: none;"><span class="glyphicon glyphicon-ok"></span> Send Email Success! </div>
<div class="alert alert-danger alert-top" role="alert" id="text-pop-err" style="display: none;"><span class="glyphicon glyphicon-remove"></span> <?php echo $msg;?> </div>
<script>
$(document).ready(function() {
	if('<?php echo $success;?>'=='success'){
		jQuery('#text-pop').fadeIn("1500");
	}else if('<?php echo $err;?>'=='Error'){
		jQuery('#text-pop-err').fadeIn("1500");
	}
	setTimeout(function () {
        jQuery('#text-pop').fadeOut("1500")
    }, 3000);
	setTimeout(function () {
        jQuery('#text-pop-err').fadeOut("3000")
    }, 3000);
});
</script>
<section class="no-margin" style="background-color: #f5f5f5;">
	<iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.co.th/maps/ms?hl=th&amp;gl=th&amp;ptab=2&amp;ie=UTF8&amp;oe=UTF8&amp;msa=0&amp;msid=107016769811457953704.000478109cb8cdb8a8117&amp;ll=13.84227,100.451426&amp;spn=0.243223,0.101795&amp;output=embed"></iframe>
</section>
<?php echo form_open('contact')?>
<div class="bg-content" style="min-height: 400px;background-color: #f5f5f5;">
	<div class="container">
	<div class="row">
		<div class="col-md-8" style="margin-bottom: 70px;">
			<h4 class="title-contact">Contact Form</h4>
                <div class="row">
                	<div class="col-md-5">
                		<div class="form-group <?php echo (form_error("fname")!=""?"has-error":"");?>">
	                		<label><?php echo $this->lang->line('First Name')?></label>
	                        <input type="text" name="fname" class="form-control" required="required"  placeholder="<?php echo $this->lang->line('Your First Name')?>" value="<?php echo $success==''?$this->input->post('fname'):''?>">
	                        <?php echo form_error("fname","<font color='error'>","</font>");?>
	                    </div>
	                    <div class="form-group <?php echo (form_error("lname")!=""?"has-error":"");?>">
	                    	<label><?php echo $this->lang->line('Last Name')?></label>
	                        <input type="text" name="lname" class="form-control" required="required"   placeholder="<?php echo $this->lang->line('Your Last Name')?>" value="<?php echo $success==''?$this->input->post('lname'):''?>">
	                        <?php echo form_error("lname","<font color='error'>","</font>");?>
	                    </div>
	                    <div class="form-group <?php echo (form_error("email")!=""?"has-error":"");?>">
	                    	<label><?php echo $this->lang->line('Email Address')?></label>
	                        <input type="text" name="email" class="form-control" required="required"  placeholder="<?php echo $this->lang->line('Your email address')?>" value="<?php echo $success==''?$this->input->post('email'):''?>">
	                        <?php echo form_error("email","<font color='error'>","</font>");?>
	                    </div>
                	</div>
                	<div class="col-md-7">
                		<div class="form-group <?php echo (form_error("message")!=""?"has-error":"");?>">
                			<label><?php echo $this->lang->line('Message')?></label>
                			<textarea name="message" id="message" required="required" class="form-control" rows="9" style="height: 180px;"><?php echo $success==''?$this->input->post('email'):''?></textarea>
                			<?php echo form_error("message","<font color='error'>","</font>");?>
                		</div>
                	</div>
                </div>

                <input type="submit" value="<?php echo $this->lang->line('Send Message')?>" class="btn btn-success btn-large pull-right" name="send">
		</div>
		<div class="col-md-4">
			<h4 class="title-contact">Our Address</h4>
			<?php if($this->session->userdata('lang_id')=='en'):?>
				<label>Head Office</label>
				<p>15/5 Moo 6 Bangbuathong-Suphanburi Road, Laharn, Bangbuathong, Nonthaburi 11110 -Thailand </p>
				<p><i class="fa fa-phone"></i> : +66 2 194 1145-50</p>
				
				<label>Sale and Customer Service</label>
				<p>77/141-142 ,33rd Fl., Sinn Sathorn Tower, Krungthonburi Road, Klongtonsai, Klongsan, Bangkok 10600 </p>
				<p><i class="fa fa-phone"></i> : +66 2 440 0506-7<br><i class="glyphicon glyphicon-print"></i> : +66 2 862 0705 <a href="<?php echo base_url()?>upload/images/TOG-SST.jpg" target="_blank">(Map)</a></p>
			
				<label>Trainning Centre</label>
				<p>77/59 ,16th Fl., Sinn Sathorn Tower, Krungdhonburi Road, Klongtonsai, Klongsan, Bangkok 10600-Thailand </p>
				<p><i class="fa fa-phone"></i> : +66 2440 0506-7</p>
				
				<p>
					<i class="glyphicon glyphicon-envelope"></i> : <a href="mailto:ir@thaiopticalgroup.com">ir@thaiopticalgroup.com</a><br/>
	 				<i class="glyphicon glyphicon-envelope"></i> : <a href="mailto:info@thaiopticalgroup.com">info@thaiopticalgroup.com</a>
	 			</p>
			<?php else:?>
				<label>สำนักงานใหญ่</label>
				<p>15/5 หมู่ 6 ถนนบางบัวทอง-สุพรรณบุรี ตำบลละหาร อำเภอบางบัวทอง จังหวัดนนทบุรี 11110- ประเทศไทย</p>
				<p><i class="fa fa-phone"></i> : +66 2 194 1145-50 <a href="<?php echo base_url()?>upload/images/TOG-RE.jpg" target="_blank">(แผนที่)</a></p>
				
				<label>ลูกค้าสัมพันธ์</label>
				<p>77/141-142 ชั้น33 อาคารสินสาธร ทาวเวอร์ ถนนกรุงธนบุรี แขวงคลองต้นไทร เขตคลองสาน กรุงเทพฯ 10600-ประเทศไทย</p>
				<p><i class="fa fa-phone"></i> : +66 2 440 0506-7<br><i class="glyphicon glyphicon-print"></i> : +66 2 862 0705 <a href="<?php echo base_url()?>upload/images/TOG-SST.jpg" target="_blank">(แผนที่)</a></p>
			
				<label>สำนักงานฝึกอบรม</label>
				<p>77/59 ชั้น16 อาคารสินสาธร ทาวเวอร์ ถนนกรุงธนบุรี แขวงคลองต้นไทร เขตคลองสาน กรุงเทพฯ 10600-ประเทศไทย</p>
				<p><i class="fa fa-phone"></i> : +66 2440 0506-7</p>
				
				<p>
					<i class="glyphicon glyphicon-envelope"></i> : <a href="mailto:ir@thaiopticalgroup.com">ir@thaiopticalgroup.com</a><br/>
	 				<i class="glyphicon glyphicon-envelope"></i> : <a href="mailto:info@thaiopticalgroup.com">info@thaiopticalgroup.com</a>
	 			</p>
			<?php endif;?>
		</div>
	</div>
	</div>
</div>
<?php echo form_close()?>
