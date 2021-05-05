<?php include('header.php')?>

<h1 class="text-center">Mark's Quotes INF653 FINAL</h1>
  <br>
  <form action="." method="post" id="select">
  <input type="hidden" name="author" value="author">
  <select class="form-select" aria-label="Default select">
  <option selected>Filter By Author</option>
  <option value="1">Author</option>
  <option value="2">Category</option>
  <option value="3">Both</option>
  <option value="2">Category</option>
  <option value="3">Both</option>
</select>

  </form>

<h2 class="text-center">Current Quotes</h4>
  <div class="table-responsive">
    <table id="publictable">
      <tr>
        <th>Author</th>
        <th>Category</th>
        <th>Quote</th>
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
  </div>
</div>
<br><br>

<?php include('footer_admin.php'); ?>