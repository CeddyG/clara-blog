@extends('abricot/main')
@section('breadcrumbs')
<aside id="colorlib-breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-md-12 breadcrumbs text-center">
						<h2>Blog detail</h2>
						<p><span><a href="index.html">Home</a></span> / <span><a href="blog.html">Blog </a></span> / <span>Blog Single</span></p>
					</div>
				</div>
			</div>
		</aside>
@stop
@section('content')
				<div class="row">
					<div class="col-md-9 content">
						<div class="row row-pb-lg">
							<div class="col-md-12">
								<div class="blog-entry">
									<div class="blog-img blog-detail">
										<img src="{{ asset('img/abricot/blog-4.jpg') }}" class="img-responsive" alt="html5 bootstrap template">
									</div>
									<div class="desc">
										<p class="meta">
											<span class="cat"><a href="#">Events</a></span>
											<span class="date">20 March 2018</span>
											<span class="pos">By <a href="#">Rich</a></span>
										</p>
										<h2><a href="blog.html">Recipe for your site</a></h2>
										<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way. </p>
										<blockquote>
											A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.
										</blockquote>
										<p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>
										<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way. </p>
									</div>
								</div>
							</div>
						</div>
						<div class="row row-pb-lg">
							<div class="col-md-12">
								<h2 class="heading-2">23 Comments</h2>
								<div class="review">
						   		<div class="user-img" style="background-image: url({{ asset('img/abricot/person1.jpg') }})"></div>
						   		<div class="desc">
						   			<h4>
						   				<span class="text-left">Jacob Webb</span>
						   				<span class="text-right">24 March 2018</span>
						   			</h4>
						   			<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
						   			<p class="star">
					   					<span class="text-left"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
						   			</p>
						   		</div>
						   	</div>
						   	<div class="review">
						   		<div class="user-img" style="background-image: url({{ asset('img/abricot/person2.jpg') }})"></div>
						   		<div class="desc">
						   			<h4>
						   				<span class="text-left">Jacob Webb</span>
						   				<span class="text-right">24 March 2018</span>
						   			</h4>
						   			<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
						   			<p class="star">
					   					<span class="text-left"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
						   			</p>
						   		</div>
						   	</div>
						   	<div class="review">
						   		<div class="user-img" style="background-image: url({{ asset('img/abricot/person3.jpg') }})"></div>
						   		<div class="desc">
						   			<h4>
						   				<span class="text-left">Jacob Webb</span>
						   				<span class="text-right">24 March 2018</span>
						   			</h4>
						   			<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
						   			<p class="star">
					   					<span class="text-left"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
						   			</p>
						   		</div>
						   	</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h2 class="heading-2">Dites nous quelques chose</h2>
								<form action="#">
									<div class="row form-group">
										<div class="col-md-6">
											<!-- <label for="fname">First Name</label> -->
											<input type="text" id="fname" class="form-control" placeholder="Nom">
										</div>
										<div class="col-md-6">
											<!-- <label for="lname">Last Name</label> -->
											<input type="text" id="lname" class="form-control" placeholder="Prénom">
										</div>
									</div>

									<div class="row form-group">
										<div class="col-md-12">
											<!-- <label for="email">Email</label> -->
											<input type="text" id="email" class="form-control" placeholder="Votre Email">
										</div>
									</div>

									<div class="row form-group">
										<div class="col-md-12">
											<!-- <label for="subject">Subject</label> -->
											<input type="text" id="subject" class="form-control" placeholder="Sujet">
										</div>
									</div>

									<div class="row form-group">
										<div class="col-md-12">
											<!-- <label for="message">Message</label> -->
											<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Votre message..."></textarea>
										</div>
									</div>
									<div class="form-group">
										<input type="submit" value="Publier commentaire" class="btn btn-primary">
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="sidebar">
							<div class="side">
								<div class="form-group">
									<input type="text" class="form-control" id="search" placeholder="Rechercher...">
									<button type="submit" class="btn btn-primary"><i class="icon-search3"></i></button>
								</div>
							</div>
							<div class="side">
								<h2 class="sidebar-heading">Catégories</h2>
								<p>
									<ul class="category">
										<li><a href="#"><i class="icon-check"></i> Home</a></li>
										<li><a href="#"><i class="icon-check"></i> About Me</a></li>
										<li><a href="#"><i class="icon-check"></i> Blog</a></li>
										<li><a href="#"><i class="icon-check"></i> Travel</a></li>
										<li><a href="#"><i class="icon-check"></i> Lifestyle</a></li>
										<li><a href="#"><i class="icon-check"></i> Fashion</a></li>
										<li><a href="#"><i class="icon-check"></i> Health</a></li>
									</ul>
								</p>
							</div>
							<div class="side">
								<h2 class="sidebar-heading">Derniers articles</h2>
								<div class="f-blog">
									<a href="blog.html" class="blog-img" style="background-image: url({{ asset('img/abricot/blog-1.jpg') }});">
									</a>
									<div class="desc">
										<h3><a href="blog.html">Be a designer</a></h3>
										<p class="admin"><span>25 March 2018</span></p>
									</div>
								</div>
								<div class="f-blog">
									<a href="blog.html" class="blog-img" style="background-image: url({{ asset('img/abricot/blog-2.jpg') }});">
									</a>
									<div class="desc">
										<h3><a href="blog.html">How to build website</a></h3>
										<p class="admin"><span>24 March 2018</span></p>
									</div>
								</div>
								<div class="f-blog">
									<a href="blog.html" class="blog-img" style="background-image: url({{ asset('img/abricot/blog-3.jpg') }});">
									</a>
									<div class="desc">
										<h3><a href="blog.html">Create website</a></h3>
										<p class="admin"><span>23 March 2018</span></p>
									</div>
								</div>
							</div>

							<div class="side">
								<div class="form-group">
									<input type="text" class="form-control form-email text-center" id="email" placeholder="Entrez votre Email">
									<button type="submit" class="btn btn-primary btn-subscribe">S'inscrire</button>
								</div>
							</div>
						</div>
					</div>
				</div>
		@stop
