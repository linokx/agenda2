
	<div class="connect">
		<?php
			echo form_open('member/login',array('method'=>'post'));
			echo form_label('Login','nom');
			$loginInput = array(
						'name' => 'nom',
						'id' => 'nom'
						);
			echo form_input($loginInput);
			echo '<br />';
			echo form_label('mot de passe','mpd');
			$mdpInput = array(
						'name' => 'mdp',
						'id' => 'mdp'
						);
			echo form_password($mdpInput);
			echo '<br />';
			echo form_submit('check','Connexion');
			echo form_close();
		?>
	</div>