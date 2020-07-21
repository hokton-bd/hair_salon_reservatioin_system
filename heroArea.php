    <!-- Hero Area Section Begin -->
    <div class="hero-area set-bg other-page" data-setbg="img/top.jpg">
        <h2 id="owner_name" class="text-uppercase">Welcome <a id="login-name" href="update_ownerProfile.php?id=<?= $retrieve->getStaffId($_SESSION['login_id']); ?>"><?= $retrieve->getNameById($_SESSION['login_id']); ?></a></h2>
    </div>
    <!-- Hero Area Section End -->