<x-guest-layout>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="post" action="{{ route('u_register') }}" class="auth_form">
		@csrf

		<br/>
		<label for="name" class="tet">Name</label><br/>
		<input type="text" id="name" name="name" class="champ"><br/>

		<br/>
		<label for="firstname" class="tet">Firstname</label><br/>
		<input type="text" id="firstname" name="firstname" class="champ"><br/>

		<br/>
		<label for="password" class="tet">Password</label><br/>                  							<!-- LE FORMULAIRE POUR UN NOUVEAU PRODUIT-->
		<input type="text" id="password" name="password" class="champ"><br/>

		<br/>
		<label for="age" class="tet">Age</label><br/>
		<input type="number" id="age" name="age" class="champ"><br/>

		<br/>
		<label for="login" class="tet">Login</label><br/>
		<input type="text" id="login" name="login" class="champ"><br/>

        <br/>
		<label for="email" class="tet">E-mail</label><br/>
		<input type="text" id="email" name="email" class="champ"><br/>

		<br/>
		<input type="submit" value="Ajouter" class="butt">

		<br/>
	</form>

</x-guest-layout>
