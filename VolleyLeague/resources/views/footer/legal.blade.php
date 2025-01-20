<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>CupApp</title>
	@vite('resources/css/app.css')
	@vite('resources/css/legal.css')
	<link rel="stylesheet" href="{{ asset('css/iconStyles.css') }}">
	
	
	
</head>



<body>

	<x-web.header />

	<main>
		
		<div class="to-do main-section">
			This section must be done in the future with a legal 
		</div>
		
		<div class="notes-todo-web main-section">
			
			<h3>
				Some sources to check in order to do the legal part of the web:
			</h3>
			
			<ul class="to-do-list">
			
				<li class="to-do-list-item">
					<h4>
						Cookie Policy
					</h4>
					<a href="https://termly.io/resources/guides/how-to-add-a-cookie-policy-to-your-website/">
						How to Add a Cookie Policy to the website - Termly.io
					</a>
				</li>
				<li class="to-do-list-item">
					<h4>
						Cookie Policy Template
					</h4>
					<a href="https://termly.io/resources/templates/cookie-policy-template/">
						Cookie Policy Template - Termly.io
					</a>
				</li>
				<li class="to-do-list-item">
					<h4>
						How to create an effective cookie policy for your website
					</h4>
					<a href="https://www.cookiebot.com/en/cookie-policy/">
						Cookie Policy  - cookiebot.io
					</a>
				</li>
				<li class="to-do-list-item">
					<h4>
						Aspectos legales de una web: ¿qué debemos tener en cuenta?
					</h4>
					<a href="https://protecciondatos-lopd.com/empresas/aspectos-legales-pagina-web/">
						Aspectos Legales Pagina Web - protecciondatos-lodp.com
					</a>
				</li>
				
				
			</ul>
		</div>
  
	</main>
  
  
  <x-footer/>
  
  
  
</body>


</html>
