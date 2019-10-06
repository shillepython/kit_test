<div class="container">
    <div class="row z-depth-2 profil-text">
        <div class="col s12">
            <h4>Ваши контактные данные</h4>
            <div class="row">
                <div class="col s6">
                    <p class="profil-content">Ваш логин: <?php echo $admin->getElementsTable('login',$id) ?></p>
                </div>
                <div class="col s6">
                    <p class="profil-content">Ваш пароль: <?php echo $admin->getElementsTable('password',$id) ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <p class="profil-content">Ваша дата рождения: <?php echo $admin->getElementsTable('birth_date',$id) ?></p>
                </div>
                <div class="col s6">
                    <p class="profil-content">Ваша почта: <?php echo $admin->getElementsTable('email',$id) ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <p class="profil-content">Ваша группа: <?php echo $admin->getElementsTable('group_id',$id) ?></p>
                </div>
                <div class="col s6">
                    <p class="profil-content">Дата регистрации: <?php echo $admin->getElementsTable('registration_date',$id) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>