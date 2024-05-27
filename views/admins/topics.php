<div class="body_wrapper">
  <div class="header">
    <h1>THEMES</h1>
    <div class="menu-user">
      <button class="buttonGreen" type="button" onclick="topics.create(event)">
        <i class="bi bi-plus-lg"></i> Add theme
      </button>
    </div>
  </div>
  <table class="content-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Theme</th>
        <th>icon</th>
        <th>Date</th>
        <th>Options</th>
      </tr>
    </thead>
    <tbody>
      <?php $index = 1 ?>
      <?php foreach ($data->data as $row): ?>
        <tr>
          <td><?= $index++; ?></td>
          <td><?= $row->theme; ?></td>
          <td><i class="<?= $row->icon; ?>"></i></td>
          <td><?= empty($row->updated_at) ? $row->created_at : "$row->updated_at edited" ?></td>
          <td class="content-table-actions">
            <button class="buttonGreen" type="button" onclick="topics.edit(event, <?= $row->id ?>)">
              <i class="bi bi-pencil-fill"></i>
            </button>
            <button class="buttonRed" type="button" onclick="topics.delete(event, <?= $row->id ?>)">
              <i class="bi bi-trash-fill"></i>
            </button>
          </td>
        </tr>
      <?php endforeach; ?> 
    </tbody>
  </table>
</div>

<script src="/resources/js/topics.js"></script>
