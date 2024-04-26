<main class="first-main">
    <div class="state">
        <div class="cover-profile">
        </div>
    </div>
    <div class="state2">
        <div class="info-user">
            <div class="position">
                <div>
                    <img src="/resources/img/login.svg" alt="photo" class="photo">
                </div>
                <div class="data-user">
                    <div class="username">
                        <h1>Comodo3000</h1>
                        <p class="ig">@LupitaNieves</p>
                    </div>
                    <div class="count">
                        <div class="caract">
                            <h3 class="ig">0</h3>
                            <h3>Followers</h3>
                            
                        </div>
                        <div class="caract">
                            <h3 class="ig">0</h3>
                            <h3>Following</h3>
                        </div>
                        <div class="caract">
                            <h3 class="ig">0</h3>
                            <h3>Post</h3>
                        </div>
                    </div>
                </div>
                <div class="edit-btn">
                    <button class="btn-conf"><i class="bi bi-gear-fill sh-icon"></i> Edit Profile</button>
                </div>
            </div>
            <div class="submenu">
                <a class="option" href="#section-post">Post</a>
                <a class="option" href="#section-media">Media</a>
                <a class="option" href="#section-comments">Comments</a>
            </div>
        </div>
    </div>

    <div class="profile">
        <div class="hobbies">
            <div class="info">
                <h3>LIFE BITS</h3>
                <div class="datas">
                    <h4 class="sh"><i class="bi bi-calendar3 sh-icon"></i> Joined 16 march 2016</h4>
                    <h4 class="sh"><i class="bi bi-geo-alt-fill sh-icon"></i> 742 Evergreen Terrace</h4>
                    <a class="link"><i class="bi bi-plus-lg"></i> Add a description about you</a>
                    <a class="link"><i class="bi bi-plus-lg"></i> Add your social networks</a>
                </div>
            </div>
        </div>
        <div>
        <?php if(isset($_SESSION['user'])): ?> 
            <a href="/posts/new">
                <div id="section-post" class="posting">
                    <div class="post-container hidden">
                        <!-- post -->
                    </div>
                    <div class="nopost-container">
                        <img src="/resources/img/add-photo.svg" class="add-photo" alt="">
                        <h3>Hello! Are you still there?</h3>
                        <p class="enun">Share what you want and spark the conversation</p>
                    </div>
                </div>
            </a> 
        <?php endif; ?>
        </div>
    </div>
</main>
