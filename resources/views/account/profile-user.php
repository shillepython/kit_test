<div class="container">
    <div class="row z-depth-2 profil-text">
        <div class="col s12">
            <h4>Ваши контактные данные</h4>
            <div class="row">
                <div class="col s6">
                    <p class="profil-content">Ваш логин: <?php echo $user->dateUser($id,1) ?></p>
                </div>
                <div class="col s6">
                    <p class="profil-content">Ваш пароль: <?php echo $user->dateUser($id,2) ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <p class="profil-content">Ваша дата рождения: <?php echo $user->dateUser($id,5) ?></p>
                </div>
                <div class="col s6">
                    <p class="profil-content">Ваша почта: <?php echo $user->dateUser($id,6) ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <p class="profil-content">Ваша группа: <?php echo $user->dateUser($id,9) ?></p>
                </div>
                <div class="col s6">
                    <p class="profil-content">Дата регистрации: <?php echo $user->dateUser($id,8) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>