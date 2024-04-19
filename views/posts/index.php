<div class="main">

  <?php
    array_multisort(array_column($data, 'created_at'), SORT_DESC, $data);
    foreach (array_slice($data, 0, 5) as $d): ?>
  <div class="hoverbox">
    <div class="box" id="results-list">
      <div class="user_card">
      <img src="../../resources/img/user.png" alt="" class="user-card-img">
        <p class="profile-card"><p><?= $d["username"] ?></p> .</p>
        <p class="date"><?= date('Y/m/d', strtotime($d["created_at"])) ?></p>
      </div>

      <div class="line"></div>

      <div class="vi">
        <a href="<?= redirect_to('posts', 'show') . '&id=' . $d["id"]; ?>">
          <div class="text">
            <h2><?= $d["title"] ?></h2>
            <p class="text-description"><?= $d["description"] ?></p>
          </div>
        </a>

        <div class="image">
          <?php foreach ($d["images"] as $image): ?>
            <img src="<?= get_home_url() . "assets/imgs/" . $image["image"] ?>" alt='Image from "<?= $d["title"] ?>"'  onclick="main.verFotos('<?= get_home_url() . "assets/imgs/" . $image["image"] ?>')">
          <?php endforeach; ?>
          <!--<img src="resources/img/example.png" alt="foto" onclick="main.verFotos('resources/img/example.png')">-->
        </div> 
      </div>

      <div>
        <div class="actions">
          <?php if(isset($_SESSION['user'])): ?>
            <p class="likes ">
          <?php else: ?>
            <p class="likes openModal">
          <?php endif; ?>
            <img src="../../resources/img/like.png" alt="">
            243K
          </p>
          <div class="info">
            <p>243K Visualization</p>
            <p>243k comments</p>
          </div>
        </div>

        <div class="line"></div>

        <div class="actions">
          <?php if(isset($_SESSION['user'])): ?>
          <p><i class='bx bxs-like' ></i>
          <?php else: ?>
          <p class="openModal"><i class='bx bxs-like' ></i>
          <?php endif; ?>
            Like
          </p>

          <a href="<?= redirect_to('posts', 'show') . '&id=' . $d["id"]; ?>">
            <p id="imagenDinamica" ><i class='bx bx-show-alt'></i>
              Vision
            </p>
          </a>
          <?php if(isset($_SESSION['user'])): ?>
            <p data-post-id="<?= $d["id"]; ?>">
          <?php else: ?>
          <a href="<?= redirect_to('posts', 'show') . '&id=' . $d["id"]; ?>">
            <p class="openModal" data-post-id="<?= $d["id"]; ?>">
          <?php endif; ?>
              <i class='bx bxs-chat'></i>
              Comment
            </p>
          </a>
        </div>
      </div>
        <a href="<?= redirect_to('posts', 'show') . '&id=' . $d["id"]; ?>">Show</a>
        <a href="<?= redirect_to('posts', 'edit') . '&id=' . $d["id"]; ?>">Edit</a>
        <a href="<?= redirect_to('posts', 'delete') . '&id=' . $d["id"]; ?>">Delete</a>
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

<!--"not found" function-->
<div class="not-found" style="display: none;">
  <p>No se encontraron resultados.</p>
</div>