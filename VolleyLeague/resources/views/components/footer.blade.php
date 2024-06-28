<footer>
    @vite('resources/css/comp_footer.css')
    <div class="footer-link-container">
		
		<a class="link-footer" href={{ route('footer.home') }}>
			<img class="footer-img" src="{{ asset('img/home.png') }}"> 
			Home
		</a>
		
		<a class="link-footer" href={{ route('footer.about-us') }}>
			<img class="footer-img" src="{{ asset('img/about-us.png') }}">
			About Us
		</a>
		
		<a class="link-footer" href={{ route('footer.contact') }}>
			<img class="footer-img" src="{{ asset('img/contact.png') }}">
			Contact
		</a>
		
		<a class="link-footer" href={{ route('footer.legal') }}>
			<img class="footer-img" src="{{ asset('img/legal.png') }}">
			Legal
		</a>
		
		
    </div>
    
    
    
</footer>
