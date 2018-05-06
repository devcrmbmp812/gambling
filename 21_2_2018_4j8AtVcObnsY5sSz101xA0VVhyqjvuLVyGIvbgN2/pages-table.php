<?php require_once('includes/doc_head.php'); ?>

<section class="alert">
	<form method="link" action="page-new.html">
		 <button class="green">Create new page</button>
	</form>
</section>
<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#128196;</span>
			<hgroup>
				<h1>Data</h1>
				<h2>Put your data here</h2>
			</hgroup>
		</header>
		<div class="content">
			<div class="field-wrap">
				<input type="text" value="" placeholder="Title" />
				<input type="text" value="" placeholder="Name" />
				<input type="text" value="" placeholder="Keywords" />
				<input type="text" value="" placeholder="Description"/>
			</div>
			<div class="field-wrap wysiwyg-wrap">
				<textarea class="post" rows="5"></textarea>
			</div>
			<button type="submit" class="green">Post</button> <button type="submit" class="">Preview</button>
		</div>
	</section>
</section>
<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#128196;</span>
			<hgroup>
				<h1>Pages</h1>
				<h2>CMS content pages</h2>
			</hgroup>
		</header>
		<div class="content">
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th>Page title</th>
						<th >Date</th>
						<th>Child pages</th>
						<th>Link</th>
						<th>Comments</th>
						<th>Author</th>
					</tr>
				</thead>
					<tbody>
						<tr>
							<td><input type="checkbox" /> Home</td>
							<td>01/3/2013</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>John Doe</td>
						</tr>
						<tr>
							<td><input type="checkbox" /> Services</td>
							<td>01/3/2013</td>
							<td>4</td>
							<td>4</td>
							<td>0</td>
							<td>John Doe</td>
						</tr>
						<tr>
							<td><input type="checkbox" /> Portfolio</td>
							<td>02/3/2013</td>
							<td>4</td>
							<td>12</td>
							<td>0</td>
							<td>John Doe</td>
						</tr>
						<tr>
							<td><input type="checkbox" /> About us</td>
							<td>02/3/2013</td>
							<td>4</td>
							<td>2</td>
							<td>0</td>
							<td>John Doe</td>
						</tr>
						<tr>
							<td><input type="checkbox" /> Blog</td>
							<td>02/3/2013</td>
							<td>4</td>
							<td>32</td>
							<td>0</td>
							<td>John Doe</td>
						</tr>
						<tr>
							<td><input type="checkbox" /> Contact us</td>
							<td>03/3/2013</td>
							<td>4</td>
							<td>0</td>
							<td>0</td>
							<td>John Doe</td>
						</tr>
						<tr>
							<td><input type="checkbox" /> Our clients</td>
							<td>04/3/2013</td>
							<td>4</td>
							<td>1</td>
							<td>0</td>
							<td>John Doe</td>
						</tr>
						<tr>
							<td><input type="checkbox" /> Partnerships</td>
							<td>04/3/2013</td>
							<td>4</td>
							<td>0</td>
							<td>0</td>
							<td>John Doe</td>
						</tr>
						<tr>
							<td><input type="checkbox" />Jobs</td>
							<td>04/3/2013</td>
							<td>4</td>
							<td>0</td>
							<td>0</td>
							<td>John Doe</td>
						</tr>
					</tbody>
				</table>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>