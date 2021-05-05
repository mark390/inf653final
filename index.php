<?php include('view/header.php'); ?>
<?php
    require('./config/Database.php');
    require('./models/Quote.php');
    require('./models/Author.php');
    require('./models/Category.php');

    $database = new Database();
    $db = $database->connect();

    $authors = new Author($db);
    $quotes = new Quote($db);
    $cat = new Category($db);

    $author = filter_input(INPUT_POST, 'author', FILTER_VALIDATE_INT);
    $category = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
    $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
    if (!$limit) {
        $limit = 30;
    }

    if ($author && $category) {
        $quote = $quotes->getQuotesMulti($author, $category);
    } elseif ($author && !$category) {
        $quote = $quotes->getQuotesbyAuthor($author);
    } elseif (!$author && $category) {
        $quote = $quotes->getQuotesbyCategory($category);
    } elseif (!$author && !$category) {
        $quote = $quotes->getQuotes();
    }

    $author_res = $authors->getAuthors();
    $cat_res = $cat->getCategories();

    ?>

    <h1 class="text-center">Mark's Quotes INF653 FINAL</h1>
    <br>
  
  <div class="search-box">
      <form action="." method="post" id="select">
      <div class="form-group">
	<select class="form-control" name="author">
		<option value="">All Authors</option>
		<?php foreach($author_res as $author) { ?>
			<option value="<?php echo $author['id']; ?>"<?php if(isset($_GET['author']) && $_GET['author'] == $author['id']) { echo ' selected="selected"'; } ?>><?php echo $author['author']; ?></option>
		<?php } ?>
	</select>
</div>
      <div class="form-group">
	<select class="form-control" name="category">
		<option value="">All Categories</option>
		<?php foreach($cat_res as $category) { ?>
			<option value="<?php echo $category['id']; ?>"<?php if(isset($_GET['category']) && $_GET['category'] == $category['id']) { echo ' selected="selected"'; } ?>><?php echo $category['category']; ?></option>
		<?php } ?>
	</select>
</div>
      <button id="Filter">Search</button>
      </form>
  
  <h2 class="text-center">Current Quotes</h4>
    <div class="table" style="table, th, td { border: 1px solid black; }">
      <table id="publictable">
        <tr>
          <th scope="col">Author</th>
          <th scope="col">Category</th>
          <th scope="col">Quote</th>
        </tr>
        <?php foreach ($quote as $q) : ?>
        <tr>
          <td><?php echo $q['author']; ?></td>
          <td><?php echo $q['category']; ?></td>
          <td><?php echo $q['quote']; ?></td>
        </tr>
        </form>
        <?php endforeach; ?>  
      </table>
    </div>
  <br><br>
  
  <?php include('view/footer.php'); ?>
    

    
