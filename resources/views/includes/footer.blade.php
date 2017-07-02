<footer class="footer">
	<div class="container">

		<div class="row">
			<div class="col-md-3 footer-left-column text-muted">
				<h4>Oficiali kolekcija</h4>
				<p><a href="{{ route('categories.index') }}">Aforizmai pagal temą</a></p>
				<p><a href="{{ route('authors.index') }}">Aforizmai pagal autorių</a></p>
				<p>Naujausi aforizmai</p>
			</div>
			<div class="col-md-3 footer-left-column text-muted">
				<h4>Nepatvirtinti aforizmai</h4>
				<p><a href="{{ route('submissions.index') }}">Atranka į oficialią kolekciją</a></p>
				<p><a href="{{ route('submissions.create') }}">Pridėk naują aforizmą...</a></p>
			</div>

			<div class="col-md-3 col-md-offset-2 footer-right-column text-muted">
				<p>Sukurta:<a href="#"> m i n d { i / o }</a></p>
			</div>
		</div>

	</div>
</footer>
