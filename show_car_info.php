<?php
include "db.php";

// التحقق من استقبال IDs لسيارتين
if (isset($_POST['car_id1']) && isset($_POST['car_id2'])) {
    $car_id1 = $_POST['car_id1'];
    $car_id2 = $_POST['car_id2'];

    // جلب بيانات السيارة الأولى
    $stmt1 = $pdo->prepare("SELECT * FROM cars_data WHERE id = ?");
    $stmt1->execute([$car_id1]);
    $car1 = $stmt1->fetch(PDO::FETCH_ASSOC);

    // جلب بيانات السيارة الثانية
    $stmt2 = $pdo->prepare("SELECT * FROM cars_data WHERE id = ?");
    $stmt2->execute([$car_id2]);
    $car2 = $stmt2->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مقارنة السيارات</title>

    <!-- ربط ملف الـ CSS -->
    <link rel="stylesheet" href="style2.css"> <!-- تأكد أن المسار صحيح -->
</head>
<body>
    <div class="container">
        <?php
        if ($car1 && $car2) {

            // عناوين الحقول باللغة العربية
            $fields = [
                'car_name' => 'اسم السيارة',
                'car_type' => 'نوع السيارة',
                'company_name' => 'الشركة المصنعة',
                'year' => 'سنة الصنع',
                'model' => 'الطراز',
                'price' => 'السعر',
                'engine_type' => 'نوع المحرك',
                'engine_capacity' => 'سعة المحرك',
                'horsepower' => 'القوة الحصانية',
                'torque' => 'عزم الدوران',
                'drive_system' => 'نظام الدفع',
                'transmission_type' => 'نوع ناقل الحركة',
                'transmission_speeds' => 'عدد سرعات ناقل الحركة',
                'energy_consumption' => 'استهلاك الوقود',
                'battery_capacity' => 'سعة خزان الوقود/البطارية',
                'max_speed' => 'أقصى سرعة',
                'seats_count' => 'عدد المقاعد',
                'safety_systems' => 'أنظمة الأمان',
                'airbags_count' => 'عدد الوسائد الهوائية',
                'assistance_systems' => 'أنظمة المساعدة',
                'tech_features' => 'الميزات التقنية',
            ];

            // عرض بيانات السيارة الأولى
            echo "<div class='comparison'>";
            echo "<div class='car-selection'>";
            echo "<div class='car-info-header'>";
            echo "<h2>" . $car1['car_name'] . "</h2>";
            echo "</div>";
            echo "<div class='car-details'>";
            foreach ($fields as $key => $label) {
                if (isset($car1[$key])) {
                    echo "<p><strong>$label:</strong> " . $car1[$key] . "</p>";
                }
            }
            echo "</div>";
            echo "</div>";

            // عرض بيانات السيارة الثانية
            echo "<div class='car-selection'>";
            echo "<div class='car-info-header'>";
            echo "<h2>" . $car2['car_name'] . "</h2>";
            echo "</div>";
            echo "<div class='car-details'>";
            foreach ($fields as $key => $label) {
                if (isset($car2[$key])) {
                    echo "<p><strong>$label:</strong> " . $car2[$key] . "</p>";
                }
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p>لم يتم العثور على السيارات أو لم يتم اختيار سيارتين للمقارنة.</p>";
        }
        ?>
    </div>
</body>
</html>
