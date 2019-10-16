<div class="container">
    <div class="row z-depth-2 profil-text">
        <div class="col s12">
            <h4>Ваши контактные данные</h4>
            <div class="row">
                <div class="col s4">
                    <p class="profil-content">Ваш логин:</p>
                </div>
                <div class="col s4 offset-s4">
                    <p class="profil-content"> <?php echo $admin->getElementsTable('login',$id) ?></p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col s4">
                    <p class="profil-content">Ваша дата рождения:</p>
                </div>
                <div class="col s4 offset-s4">
                    <p class="profil-content"> <?php echo $admin->getElementsTable('birth_date',$id) ?></p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col s4">
                    <p class="profil-content">Ваша почта:</p>
                </div>
                <div class="col s4 offset-s4">
                    <p class="profil-content"><?php echo $admin->getElementsTable('email',$id) ?></p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col s4">
                    <p class="profil-content">Ваша группа:</p>
                </div>
                <div class="col s4 offset-s4">
                    <p class="profil-content"><?php echo $admin->getElementsTable('group_id',$id) ?></p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col s4">
                    <p class="profil-content">Дата регистрации:</p>
                </div>
                <div class="col s4 offset-s4">
                    <p class="profil-content"><?php echo $admin->getElementsTable('registration_date',$id) ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <a href="edit/password?email=<?php echo $admin->getElementsTable('email',$id) ?>" class="btn waves-effect waves-light blue-grey darken-4 white-text" type="submit" name="action">Поменять пароль
                        <i class="material-icons right">send</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>