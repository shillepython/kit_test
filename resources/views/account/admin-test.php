<div class="container ">
    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s3"><a class="active" href="#test1">Список всех пользователей</a></li>
                <li class="tab col s3"><a href="#test2">Test 2</a></li>
                <li class="tab col s3"><a href="#test3">Disabled Tab</a></li>
                <li class="tab col s3"><a href="#test4">Test 4</a></li>
            </ul>
        </div>
        <div id="test2" class="col s12">
            <table class="highlight">
                <thead>
                <tr>
                    <th>Имя</th>
                    <th>Описание</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $atricles = $connection->query("SELECT * FROM `article_tests`");
                while ($art = $atricles->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?  echo $art['title']; ?></td>
                        <td><?  echo $art['short_text']; ?></td>
                        <td><a class="waves-effect waves-light btn"><i class="material-icons left">edit</i></a></td>
                        <td><a href="?del_art=<? echo $art['id']; ?>" class="waves-effect waves-light btn"><i class="material-icons left">remove_circle_outline</i></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div id="test3" class="col s12">Test 3</div>
        <div id="test4" class="col s12">Test 4</div>
    </div>
</div>