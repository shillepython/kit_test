<div class="container">
    <style>
        .row{
            margin: 0;
        }
    </style>
    <div class="row z-depth-2" style="margin-top: 20px; border-radius: 5px">
        <div class="col s12">
            <h4 style="margin: 20px;">Ваши контактные данные</h4>
            <div class="row" style="color: #fff; font-weight: bold; font-size: 20px; background-color: #263238; border-bottom: 1px solid #000; border-top: 1px solid #000;  padding-bottom: 20px; padding-top: 20px">
                <div class="col l4 s6">
                    <p class="profil-content">Ваш логин:</p>
                </div>
                <div class="col l4 s6 offset-l4">
                    <p class="profil-content"> <?php echo $admin->getElementsTable('login',$id) ?></p>
                </div>
            </div>


            <div class="row" style="color: #fff; font-weight: bold; font-size: 20px; background-color: #263238; border-bottom: 1px solid #000;   padding-bottom: 20px; padding-top: 20px">
                <div class="col l4 s6">
                    <p class="profil-content">Ваш пароль:</p>
                </div>
                <div class="col l4 s6 offset-l4">
                    <p class="profil-content"> <?php echo $_SESSION['user'][2]?></p>
                </div>
            </div>

            <div class="row"  style="color: #fff; font-weight: bold; font-size: 18px; background-color: #263238; border-bottom: 1px solid #000;   padding-bottom: 20px; padding-top: 20px">
                <div class="col l4 s6">
                    <p class="profil-content">Ваша почта:</p>
                </div>
                <div class="col l4 s6 offset-l4">
                    <p class="profil-content"><?php echo $admin->getElementsTable('email',$id) ?></p>
                </div>
            </div>


            <div class="row" style="color: #fff; font-weight: bold; font-size: 20px; background-color: #263238; border-bottom: 1px solid #000;  padding-bottom: 20px; padding-top: 20px">
                <div class="col l4 s6">
                    <p class="profil-content">Ваша группа:</p>
                </div>
                <div class="col l4 s6 offset-l4">
                    <p class="profil-content"><?php echo $admin->getElementsTable('group_id',$id) ?></p>
                </div>
            </div>


            <div class="row" style="color: #fff; font-weight: bold; font-size: 20px; background-color: #263238; border-bottom: 1px solid #000;   padding-bottom: 20px; padding-top: 20px">
                <div class="col l4 s6">
                    <p class="profil-content">Дата регистрации:</p>

                </div>
                <div class="col l4 s6 offset-l4">
                    <p class="profil-content"><?php echo $admin->getElementsTable('registration_date',$id) ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <a href="password?email=<?php echo $admin->getElementsTable('email',$id) ?>" style="margin: 30px 0 30px 50px;" class="btn waves-effect waves-light blue-grey darken-4 white-text" type="submit" name="action">Поменять пароль
                        <i class="material-icons right">send</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>