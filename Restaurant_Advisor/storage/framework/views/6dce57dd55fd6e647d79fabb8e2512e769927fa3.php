
    <form method="post" action="<?php echo e(route('r_create')); ?>" class="auth_form">
		<?php echo csrf_field(); ?>

		<br/>
		<label for="name" class="tet">Name Create</label><br/>
		<input type="text" id="name" name="name" class="champ"><br/>

		<br/>
		<label for="description" class="tet">description</label><br/>
		<input type="text" id="description" name="description" class="champ"><br/>

		<br/>
		<label for="localization" class="tet">localization</label><br/>                  							<!-- LE FORMULAIRE POUR UN NOUVEAU PRODUIT-->
		<input type="text" id="localization" name="localization" class="champ"><br/>

		<br/>
		<label for="grade" class="tet">grade</label><br/>
		<input type="number" step=0.01 id="grade" name="grade" class="champ"><br/>

		<br/>
		<label for="phone_number" class="tet">phone_number</label><br/>
		<input type="text" id="phone_number" name="phone_number" class="champ"><br/>

        <br/>
		<label for="website" class="tet">website</label><br/>
		<input type="text" id="website" name="website" class="champ"><br/>

        <br/>
		<label for="hours" class="tet">hours</label><br/>
		<input type="text" id="hours" name="hours" class="champ"><br/>

		<br/>
		<input type="submit" value="Ajouter" class="butt">

		<br/>
	</form>

    <form  action="<?php echo e(route('r_update',['id'=>1])); ?>" class="auth_form">
		<?php echo csrf_field(); ?>

		<br/>
		<label for="name" class="tet">Name Update</label><br/>
		<input type="text" id="name" name="name" class="champ"><br/>

		<br/>
		<label for="description" class="tet">description</label><br/>
		<input type="text" id="description" name="description" class="champ"><br/>

		<br/>
		<label for="localization" class="tet">localization</label><br/>                  							<!-- LE FORMULAIRE POUR UN NOUVEAU PRODUIT-->
		<input type="text" id="localization" name="localization" class="champ"><br/>

		<br/>
		<label for="grade" class="tet">grade</label><br/>
		<input type="number" step=0.01 id="grade" name="grade" class="champ"><br/>

		<br/>
		<label for="phone_number" class="tet">phone_number</label><br/>
		<input type="text" id="phone_number" name="phone_number" class="champ"><br/>

        <br/>
		<label for="website" class="tet">website</label><br/>
		<input type="text" id="website" name="website" class="champ"><br/>

        <br/>
		<label for="hours" class="tet">hours</label><br/>
		<input type="text" id="hours" name="hours" class="champ"><br/>

		<br/>
		<input formmethod="put" type="submit" value="Ajouter" class="butt">

		<br/>
	</form>
    </body>
<?php /**PATH /home/benoit/Restaurant_Advisor/resources/views/restaurant.blade.php ENDPATH**/ ?>