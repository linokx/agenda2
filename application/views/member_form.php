<div id="connexion">
		<?php
			echo form_open('member/login',array('method'=>'post'));
			echo form_fieldset('');
			$loginInput = array(
						'name' => 'nom',
						'id' => 'nom'
						);
			echo form_input($loginInput);
			echo '<br />';
			$mdpInput = array(
						'name' => 'mdp',
						'id' => 'mdp'
						);
			echo form_password($mdpInput);
			$data = array(
    			'name'        => 'remember',
    			'id'          => 'remember',
    			'value'       => 'accept',
    			'checked'     => TRUE,
    		);
			echo form_checkbox('remember', 'accept', TRUE);
			echo form_label('Se souvenir de moi','remember').'<br />';
			echo anchor('profil/membre/mdp','Mot de passe oublié', 'title="Retrouver le mot de passe"');
			echo form_fieldset_close(); 
			echo form_fieldset('','id=social');
			echo 'Se connecter avec';
			echo form_fieldset_close(); 
			echo form_fieldset('','id=envoi');
			echo form_submit('check','Connexion');
			echo '<span style="font-size:14px;margin:0 12px;padding:10px 0;display:inline-block">ou</span> <a href="#">Me créer un compte</a>';
			echo form_fieldset_close(); 
			echo form_close();
		?>
	</div>