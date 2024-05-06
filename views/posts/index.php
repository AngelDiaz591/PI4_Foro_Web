<div class="main">

  <?php
    array_multisort(array_column($data, 'created_at'), SORT_DESC, $data);
    foreach (array_slice($data, 0, 5) as $d): ?>
  <div class="hoverbox">
    <div class="box" id="results-list">
      <a href="/users/show/id:<?= $d["user_id"]; ?>">
        <div class="user_card">
          <img src="/resources/img/user.png" alt="user" class="user-card-img">
          <p class="profile-card"><p><?= $d["username"] ?></p> .</p>
          <p class="date"><?= date('Y/m/d', strtotime($d["created_at"])) ?></p>
        </div>
      </a>

      <div class="line"></div>

      <div class="vi">
        <a href="/posts/show/id:<?= $d["id"]; ?>">
          <div class="text">
            <h2><?= $d["title"] ?></h2>
            <p class="text-description"><?= $d["description"] ?></p>
          </div>
        </a>

        <div class="image">
          <?php foreach ($d["images"] as $image): ?>
            <img src="<?= IMAGES . $image["image"] ?>" alt='Image from "<?= $d["title"] ?>"' onclick="main.verFotos('<?= IMAGES . $image['image'] ?>')">
          <?php endforeach; ?>
        </div> 
      </div>

      <div>
        <div class="actions">
          <p class="likes <?= isset($_SESSION['user']) ? '' : 'openModal' ?>">
            <img src="/resources/img/like.png" alt="like">
            243K
          </p>
          <div class="info">
            <p>243K Visualization</p>
            <p>243k comments</p>
          </div>
        </div>

        <div class="line"></div>

        <div class="actions">
          <a href="/posts/show/id:<?= $d["id"]; ?>">
            <p><i class='bx bxs-like' ></i>
              Like
            </p>
          </a>
          <a href="/posts/show/id:<?= $d["id"]; ?>">
            <p id="imagenDinamica" ><i class='bx bx-show-alt'></i>
              Vision
            </p>
          </a>
          <a href="/posts/show/id:<?= $d["id"]; ?>">
            <p><i class='bx bxs-chat'></i>
              Comment
            </p>
          </a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<div id="modal" class="modal-container">
  <div class="modal-header">
    <i class='bx bx-error'></i>
    <h2>You have to log in</h2>
  </div>
  <span class="close-modal" onclick="closeModal()">&times;</span>
</div>

<div class="not-found" style="display: none;">
  <p>No se encontraron resultados.</p>
</div>
