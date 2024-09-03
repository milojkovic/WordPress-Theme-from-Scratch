<form action="/" method="get">
	<label for="search">Search</label>
	<input type="hidden" name="cat" value="3">
<!--	When wont use specific category and post, put number in value of that post.-->
	<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" required>
	<button type="submit">Search posts!</button>
</form>
