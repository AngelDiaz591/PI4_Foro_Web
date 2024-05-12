


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
                <div class="box" id="results-list-<?= $d["id"]; ?>">
                    <div class="text">
                        <h2><?= $d["title"] ?></h2>
                        <p class="text-description"><?= $d["description"] ?></p>
                    </div>
                </a>
                </div>

        <div class="image">
          <?php foreach ($d["images"] as $image): ?>
            <img src="/assets/imgs/<?= $image["image"] ?>" alt='Image from "<?= $d["title"] ?>"' onclick="main.verFotos('/assets/imgs/<?= $image['image'] ?>')">
          <?php endforeach; ?>
        </div> 
      </div>

            <div>
                <div class="actions">
                    <p class="likes <?= isset($_SESSION['user']) ? '' : 'openModal' ?>" id="reactions-count-<?= $d['id'] ?>">
                        <img src="/resources/img/like.png" alt="like"> reactions: <?= $d['total_reactions'] ?? 0 ?>
                    </p>

                    <div class="info">
                        <p>243K Visualization</p>
                        <p>243k comments</p>
                    </div>
                </div>

                <?php if(isset($_SESSION['user']['id'])): ?>
                <div class="all-reaction" id="react_<?php echo $d["id"]?>">
                    <img src="resources/img/thumb.gif" class="reaction" id="thumb_<?php echo $d["id"]?>"> 
                    <img src="resources/img/haha.gif" class="reaction" id="haha_<?php echo $d["id"]?>">
                    <img src="resources/img/love.gif" class="reaction" id="love_<?php echo $d["id"]?>">
                    <img src="resources/img/wow.gif" class="reaction" id="wow_<?php echo $d["id"]?>">
                    <img src="resources/img/sad.gif" class="reaction" id="sad_<?php echo $d["id"]?>">
                    <img src="resources/img/angry.gif" class="reaction" id="angry_<?php echo $d["id"]?>">
                </div>
                <?php endif; ?>
                <div class="line"></div>
                <div class="actions">
                    <div class="react-con" align="center" id="<?php echo $d["id"];?>">
                    <?php if ($d['total_reactions'] > 0 || isset($_SESSION['user']['id'])): ?>
                        <?php if (isset($_SESSION['user']['id']) && !empty($d['user_reactions'])): ?>
                            <img src="resources/img/<?php echo $d['user_reactions'];?>.png" class="reaction">
                        <?php else: ?>
                            <p><i class='bx bxs-like' onclick='checkSession()'></i></p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p><i class='bx bxs-like' onclick='checkSession()'></i></p>
                    <?php endif; ?>
                    </div>
                    <a href="/posts/show/id:<?= $d["id"]; ?>">
                        <p id="imagenDinamica" ><i class='bx bx-show-alt'></i> Vision</p>
                    </a>
                    <a href="/posts/show/id:<?= $d["id"]; ?>">
                        <p><i class='bx bxs-chat'></i> Comment</p>
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
<script>
    var postId = <?= $d["id"] ?>;
</script>
<script src="/resources/js/reaction.js"></script>
