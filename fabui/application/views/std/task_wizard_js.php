<?php
/**
 * 
 * @author Daniel Kesler
 * @version 0.1
 * @license https://opensource.org/licenses/GPL-3.0
 * 
 */

/* variable initialization */
$this->load->helper('std_helper');
if( !isset($steps) ) $steps = array();
$steps = initializeSteps($steps);

if( !isset($wizard_finish) ) $wizard_finish = end($steps)['number'];

?>
<script type="text/javascript">

	var wizard; //wizard object
	
	$(document).ready(function() {
		console.log('task_wizard_js: ready');
		initWizard();
	});
	
	//init wizard flow
	function initWizard()
	{
		wizard = $('.wizard').wizard();

		disableButton('.button-prev');
		disableButton('.button-next');
		
		$('#myWizard').on('changed.fu.wizard', function (evt, data) {
			checkWizard();
		});
		
		$('#myWizard').on('clicked.fu.wizard', function (evt, data) {
		});
		
		$('.button-prev').on('click', function(e) {
			$('#myWizard').wizard('previous');
		});
		
		$('.button-next').on('click', function(e) {
			var step = $('#myWizard').wizard('selectedItem').step;
			/*if(step == 3){
				//doSpoolAction();
				return;
			}else{
				$('#myWizard').wizard('next');
			}*/
			if( handleStep() )
			{
				$('#myWizard').wizard('next');
			}
		});
		
		
		/*$('#myWizard').on('changed.fu.wizard', function (evt, data) {
			checkWizard();
		});
		
		$('#myWizard').on('clicked.fu.wizard', function (evt, data) {
			console.log('clicked.fu.wizard');
			return false;
		});
		
		$('.btn-prev').on('click', function() {
			console.log('prev');
			if(canWizardPrev()){
			}
		});
		$('.btn-next').on('click', function() {
			console.log('next');
			//if(canWizardNext()){
			//}
			//if( !handleStep() )
			//return true;
			//checkWizard();
			return false;
		});*/
		
		<?php if(isset($wizard_jump_to)): ?>
			$('.wizard').wizard('selectedItem', {
				step: <?php echo $wizard_jump_to?>
			});
			gotoWizardStep(<?php echo $wizard_jump_to?>);
			enableButton('.btn-prev');
		<?php else: ?>
			//checkWizard();
		<?php endif; ?>
	}
	
	// check if i can move to previous step
	function canWizardPrev()
	{
		var step = $('.wizard').wizard('selectedItem').step;
		return false;
	}
	
	//check if i can move to next step
	function canWizardNext()
	{
		var step = $('.wizard').wizard('selectedItem').step;
		console.log('Can Wizard Next: ' + step);
		return false;
	}
	
	function gotoWizardStep(step)
	{
		$('.wizard').wizard('selectedItem', { step: step });
	}
	
	function gotoWizardFinish()
	{
		$('.wizard').wizard('selectedItem', { step: <?php echo $wizard_finish; ?> });
	}
	
</script>
