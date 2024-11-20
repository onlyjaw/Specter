<?php

include "db.php";

$query = $pdo->query("SELECT id, car_name FROM cars_data");
$cars = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مقارنة السيارات</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Compare cars</h1>
        <p>Choose two cars to compare side-by-side.</p>
        <div class="comparison">
            <!-- السيارة الأولى -->
            <div class="car-selection">
                <div class="image-container">
                    <div class="background">
                        <img src="car1.png" alt="Car 1">
                    </div>
                </div>
                <div class="dropdowns">
                    <label>
                        Choose a car
                        <select name="car_id1" form="compareform">
                            <option selected disabled>Car name</option>
                            <?php foreach ($cars as $car): ?>
                                <option value="<?= $car['id'] ?>"><?= $car['car_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
            </div>
            <!-- السيارة الثانية -->
            <div class="car-selection">
                <div class="image-container">
                    <div class="background">
                        <img src="car2.png" alt="Car 2">
                    </div>
                </div>
                <div class="dropdowns">
                    <label>
                        Choose a car
                        <select name="car_id2" form="compareform">
                            <option selected disabled>Car name</option>
                            <?php foreach ($cars as $car): ?>
                                <option value="<?= $car['id'] ?>"><?= $car['car_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
            </div>
        </div>
        <form id="compareform" action="show_car_info.php" method="POST">
            <button class="compare-button" type="submit" disabled>See the comparison</button>
        </form>
    </div>
    <script>
        const form = document.getElementById('compareform');
        const car1Select = document.querySelector('select[name="car_id1"]');
        const car2Select = document.querySelector('select[name="car_id2"]');
        const compareButton = document.querySelector('.compare-button');

        function toggleButton() {
            if (car1Select.value !== "Choose a car" && car2Select.value !== "Choose a car") {
                compareButton.disabled = false;
            } else {
                compareButton.disabled = true;
            }
        }

        car1Select.addEventListener('change', toggleButton);
        car2Select.addEventListener('change', toggleButton);
    </script>
</body>
</html>
